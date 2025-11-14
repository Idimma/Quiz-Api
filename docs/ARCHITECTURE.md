# Quiz API – Architecture and Usage Guide

This document provides a backend engineer–level overview of the Quiz API codebase, including architecture, data models, controllers, routing, AI evaluation pipeline, and frontend integration. It also covers environment configuration and usage examples to help you run and extend the system confidently.

## Tech Stack and Conventions

- Framework: Laravel (5.x generation conventions; includes Blade views and Livewire components)
- Persistence: Eloquent ORM (MySQL or compatible SQL DB configured via `.env`)
- Views/UI: Blade templates with Tailwind CSS; localized assets under `public/` and `resources/`
- Background/AI: Local LLM via Ollama with optional OpenAI fallback
- Authentication: API routes include `auth:api`-protected endpoints
- IDE Helper: `barryvdh/laravel-ide-helper` for improved tooling
- Entry points: [`public/index.php`](public/index.php)

Reference setup doc: [`readme.md`](readme.md)

## High-Level Architecture

The application follows a standard MVC pattern:

- Models
  - Student records and profile metadata
  - Question bank for multiple-choice
  - Spelling items with optional TTS audio assets
  - Paragraph (blank) questions for free-form answers evaluated by AI
  - Player submission capturing quiz result sets
- Controllers
  - Public web flow: welcome → register → instructions → quiz → process → correction → leaderboard
  - API endpoints for programmatic quiz retrieval, AI marking, and CRUD for articles (auth)
- Services
  - AIService: prompt building, LLM request/response handling, color coding, batch recalculation
- Views
  - Blade templates under `resources/views` rendered by controllers, with a shared layout

Key files:
- Routes (HTTP): [`routes/web.php`](routes/web.php), [`routes/api.php`](routes/api.php)
- Core controller: [`app/Http/Controllers/QuizController.php`](app/Http/Controllers/QuizController.php)
- AI service: [`app/Services/AIService.php`](app/Services/AIService.php)
- Models: [`app/Student.php`](app/Student.php), [`app/Question.php`](app/Question.php), [`app/Spelling.php`](app/Spelling.php), [`app/BlankParagraph.php`](app/BlankParagraph.php), [`app/Player.php`](app/Player.php)
- Layout: [`resources/views/layouts/master.blade.php`](resources/views/layouts/master.blade.php)

## Data Model Overview

- Student
  - Fields: name, user_id, level, type, tiers (array)
  - File: [`app/Student.php`](app/Student.php)

- Question (Multiple-choice)
  - Fields: question, a, b, c, d, e (hidden), answer (one of a/b/c/d), type, class, meta (array)
  - Hidden: meta, e, class, timestamps, id
  - File: [`app/Question.php`](app/Question.php)

- Spelling
  - Fields: word, type, level, audio (base64 from Google TTS)
  - Hidden: created_at, updated_at, type, level
  - File: [`app/Spelling.php`](app/Spelling.php)
  - Audio generation: [`php.Spelling::fixAudio()`](app/Spelling.php:33)

- BlankParagraph (Free-text)
  - Fields: question, answer, level, type, meta (array), student_instruction, ai_instruction
  - Hidden: created_at, updated_at, type, level, meta
  - File: [`app/BlankParagraph.php`](app/BlankParagraph.php)

- Player (Submission)
  - Captures quiz attempt and computed results
  - Fillable: user_id, name, questions (array), score (float), percent (float), seconds_used, type, level, question_type, ai_marked
  - Casts: questions (array), score (float), percent (float), seconds_used (float), ai_marked (bool)
  - Derived attributes:
    - [`php.Player::getMarksAttribute()`](app/Player.php:91)
    - [`php.Player::getScoresAttribute()`](app/Player.php:96)
    - [`php.Player::getMarkAttribute()`](app/Player.php:101)
  - File: [`app/Player.php`](app/Player.php)

## Controller Responsibilities

### QuizController

Primary orchestrator for the quiz UX and result processing.

Key actions:
- Landing and registration flow
  - [`php.QuizController::welcome()`](app/Http/Controllers/QuizController.php:16): Renders the welcome page.
  - [`php.QuizController::store(Request $request)`](app/Http/Controllers/QuizController.php:26): Validates and creates/updates a Student, persists phone in session, redirects to instructions.
  - [`php.QuizController::instructions(mixed $phone = '')`](app/Http/Controllers/QuizController.php:46): Loads Student and renders dashboard, or redirects to `/`.

- Quiz execution
  - [`php.QuizController::quiz(Request $request, Student $student, $type = '')`](app/Http/Controllers/QuizController.php:63): Dispatches to multiple-choice, blank paragraph (currently rendered via `multiple-options`), or spelling-bee view based on type string.
  - [`php.QuizController::quizTest(Request $request, Student $student)`](app/Http/Controllers/QuizController.php:85): Builds a mixed test set (multiple-choice + spelling + paragraph) with marks/timers.

- Local processing (web)
  - [`php.QuizController::process(Request $request)`](app/Http/Controllers/QuizController.php:120): Parses posted JSON payloads, computes per-question correctness for simple types, delegates AI evaluation for paragraphs via AIService, creates Player, redirects to completed.

- AI pipeline (API and web)
  - [`php.QuizController::processQuestions(Request $request)`](app/Http/Controllers/QuizController.php:133): Iterates questions, evaluates MC/spelling locally, triggers AI evaluation for paragraphs via [`php.AIService::evaluate()`](app/Services/AIService.php:10), computes totals, creates Player, redirects to correction.
  - [`php.QuizController::processQuestionsAi(Request $request)`](app/Http/Controllers/QuizController.php:199): Pre-scores answers (MC/spelling) with [`php.AIService::calculateScores()`](app/Services/AIService.php:163), persists Player, then attempts an AI recalculation with [`php.AIService::recalculate()`](app/Services/AIService.php:201) when `ai_marked` is false, updates Player aggregates and sets `ai_marked = true`, returns the Player (JSON).

- Results and boards
  - [`php.QuizController::completed(Player $player)`](app/Http/Controllers/QuizController.php:251): Renders the correction view with Player details.
  - [`php.QuizController::leaderBoard()`](app/Http/Controllers/QuizController.php:257): Renders table/leaderboard view.
  - [`php.QuizController::result(Request $request, $userId)`](app/Http/Controllers/QuizController.php:294): Finds latest Player by user_id, runs AI recalculation if needed, renders correction.

- Spelling creation
  - [`php.QuizController::storeSpelling(Request $request)`](app/Http/Controllers/QuizController.php:264): Generates Google TTS audio for a spelling word, stores Spelling, redirects to listing.
  - [`php.QuizController::spellings(Request $request)`](app/Http/Controllers/QuizController.php:287): Renders spelling insertion/listing view.

### QuestionsController

- API and admin creation/edit of multiple-choice questions:
  - [`php.QuestionsController::index(Request $request)`](app/Http/Controllers/QuestionsController.php:15): Fetches 15 random questions by `type` and returns JSON.
  - [`php.QuestionsController::create(Request $request)`](app/Http/Controllers/QuestionsController.php:21): Validates and creates a new bible-type question (level/class metadata optionally set), redirects to insert page.
  - [`php.QuestionsController::update(Request $request, Question $question)`](app/Http/Controllers/QuestionsController.php:41): Validates and updates a question.
  - [`php.QuestionsController::edit(Question $question)`](app/Http/Controllers/QuestionsController.php:62), [`php.QuestionsController::insert()`](app/Http/Controllers/QuestionsController.php:68): Render insertion UI.

### ParagraphController

- CRUD for paragraph (free-text) questions:
  - [`php.ParagraphController::index()`](app/Http/Controllers/ParagraphController.php:11): List and render insertion form.
  - [`php.ParagraphController::store(Request $request)`](app/Http/Controllers/ParagraphController.php:18): Validates and creates bible-type free-text question.
  - [`php.ParagraphController::show(Request $request, $blankParagraph)`](app/Http/Controllers/ParagraphController.php:39)
  - [`php.ParagraphController::edit(Request $request, BlankParagraph $blankParagraph)`](app/Http/Controllers/ParagraphController.php:47)
  - [`php.ParagraphController::update(Request $request, $id)`](app/Http/Controllers/ParagraphController.php:54): Validates and updates, merges meta bible_ref if present.

### SpellingController

- JSON listing for spelling items:
  - [`php.SpellingController::index()`](app/Http/Controllers/SpellingController.php:15): Returns 10 random spelling items; POST may filter by `class`.

### AIModelCheckerController

- Single-question AI evaluation endpoint:
  - [`php.AIModelCheckerController::evaluate(Request $request)`](app/Http/Controllers/AIModelCheckerController.php:10): Returns `similarity_percentage` and a simple correctness flag (>= 80 → Correct).

## Service: AIService

Centralized AI scoring logic for free-text answers and post-processing.

- Single-question scoring:
  - [`php.AIService::evaluate($question, $answer, $userAnswer, $instructions = '')`](app/Services/AIService.php:10)
    - Builds a JSON-only prompt emphasizing semantic similarity over exact wording.
    - Sends to Ollama: `POST {OLLAM_LINK or http://localhost:11434}/api/generate` with `model=llama3.2`.
    - Parses `{"similarity_score": 0..100}` from the `response` field; returns number or 0 on failure.

- Batch OpenAI fallback:
  - [`php.AIService::openAIGenerate($aiQuestions)`](app/Services/AIService.php:63)
    - Constructs a consolidated prompt for multiple indices; calls `gpt-4` chat completions, expects JSON mapping `{index: score}`.

- Player-level analysis helper:
  - [`php.AIService::analyze(Player $player)`](app/Services/AIService.php:119)
    - Scores only paragraph-type questions then updates Player when `ai_marked` is false.

- Color coding (UX):
  - [`php.AIService::getColor($score = null)`](app/Services/AIService.php:151)
    - Returns semantic colors for score buckets, `null` → gray. Used to annotate question outcomes.

- First-pass scoring and post-AI recalculation:
  - [`php.AIService::calculateScores(mixed $questions)`](app/Services/AIService.php:163)
    - For MC/spelling: marks correct when `expected_answer == given_answer` (case-insensitive); sets `ai_score=100`, color green.
    - Paragraph: flags as `pending` with neutral color.
  - [`php.AIService::recalculate(mixed $questions)`](app/Services/AIService.php:201)
    - Re-evaluates paragraphs via OpenAI batch, updates `ai_score`, `score`, `color` per mark allocation.

- Leaderboard decorations:
  - [`php.AIService::getPositionDetails($position)`](app/Services/AIService.php:259)
    - Returns medal/color/ordinal suffix for a given rank.

## Routing Map

### Web routes

File: [`routes/web.php`](routes/web.php)

- Landing/dashboard and main quiz flow
  - [`php.Route::get('/', [QuizController::class, 'welcome'])`](routes/web.php:18)
  - [`php.Route::get('/instructions', [QuizController::class, 'instructions'])`](routes/web.php:19)
  - [`php.Route::get('/instructions/{phone}', [QuizController::class, 'instructions'])`](routes/web.php:20)
  - [`php.Route::post('/create', [QuizController::class, 'store'])`](routes/web.php:21)

- Quiz pages
  - [`php.Route::any('/quiz-test/{student:user_id}', [QuizController::class, 'quizTest'])`](routes/web.php:22)
  - [`php.Route::post('/quiz', [QuizController::class, 'quiz'])`](routes/web.php:26)
  - [`php.Route::any('/quiz/{student:user_id}', [QuizController::class, 'quiz'])`](routes/web.php:27)
  - [`php.Route::any('/quiz/{student:user_id}/{type}', [QuizController::class, 'quiz'])`](routes/web.php:28)
  - [`php.Route::get('/quiz', fn() => redirect('/'))`](routes/web.php:35)

- Processing and results
  - [`php.Route::get('/process', [QuizController::class, 'process'])`](routes/web.php:29)
  - [`php.Route::get('/process-questions', [QuizController::class, 'processQuestions'])`](routes/web.php:30)
  - [`php.Route::get('/completed/{player}', [QuizController::class, 'completed'])`](routes/web.php:31)
  - [`php.Route::get('/result/{student:user_id}', [QuizController::class, 'result'])`](routes/web.php:32)

- Leaderboard and admin insertions
  - [`php.Route::get('/table', [QuizController::class, 'leaderBoard'])`](routes/web.php:36)
  - [`php.Route::get('/insert', [QuestionsController::class, 'insert'])`](routes/web.php:37)
  - [`php.Route::post('/insert', [QuestionsController::class, 'create'])`](routes/web.php:38)
  - [`php.Route::get('/insert/edit/{question}', [QuestionsController::class, 'edit'])`](routes/web.php:39)
  - [`php.Route::post('/insert/edit/{question}', [QuestionsController::class, 'update'])`](routes/web.php:40)
  - [`php.Route::resource('paragraphs', 'ParagraphController')`](routes/web.php:41)

- Spelling creation/listing (UI)
  - [`php.Route::post('/spellings', [QuizController::class, 'storeSpelling'])`](routes/web.php:42)
  - [`php.Route::get('/spellings', [QuizController::class, 'spellings'])`](routes/web.php:43)

### API routes

File: [`routes/api.php`](routes/api.php)

- Auth and session
  - [`php.Route::middleware('auth:api')->get('/user', ... )`](routes/api.php:18)
  - [`php.Route::post('login', 'Auth\LoginController@login')`](routes/api.php:22)
  - [`php.Route::post('logout', 'Auth\LoginController@logout')`](routes/api.php:28)
  - [`php.Route::post('register', 'Auth\RegisterController@register')`](routes/api.php:29)

- Quiz data
  - [`php.Route::post('quiz', 'QuestionsController@index')`](routes/api.php:23)
  - [`php.Route::get('quiz', 'QuestionsController@index')`](routes/api.php:25)

- Spelling data
  - [`php.Route::post('spelling', 'SpellingController@index')`](routes/api.php:26)
  - [`php.Route::get('spelling', 'SpellingController@index')`](routes/api.php:27)

- AI evaluation
  - [`php.Route::post('process-questions', [QuizController::class, 'processQuestionsAi'])`](routes/api.php:24)
  - [`php.Route::post('ai-evaluation', [AIModelCheckerController::class, 'evaluate'])`](routes/api.php:31)

- Articles (protected)
  - Group: [`php.Route::group(['middleware' => 'auth:api'], ...)`](routes/api.php:33)
  - Endpoints (index/show/store/update/delete) via `ArticleController`

## Frontend Integration

The frontend uses Blade templates under `resources/views` with a shared layout:

- Layout: [`resources/views/layouts/master.blade.php`](resources/views/layouts/master.blade.php)
  - Tailwind via CDN, local CSS (`css/index.css`, `css/style.css`)
  - Toast and loading helpers:
    - [`php.master.blade::startQuiz(cb, sec = 100)`](resources/views/layouts/master.blade.php:89)
    - [`php.master.blade::showLoading(message)`](resources/views/layouts/master.blade.php:68)
    - [`php.master.blade::hideLoading()`](resources/views/layouts/master.blade.php:76)
    - [`php.master.blade::showFaded()`](resources/views/layouts/master.blade.php:81)
    - [`php.master.blade::closeToast(target)`](resources/views/layouts/master.blade.php:57)

Representative views (rendered by QuizController):
- Welcome: [`resources/views/welcome.blade.php`](resources/views/welcome.blade.php)
- Dashboard: [`resources/views/dashboard.blade.php`](resources/views/dashboard.blade.php)
- Multiple-choice UI: [`resources/views/multiple-options.blade.php`](resources/views/multiple-options.blade.php)
- Spelling UI: [`resources/views/spelling-bee.blade.php`](resources/views/spelling-bee.blade.php)
- Mixed quiz test: [`resources/views/quiz-test.blade.php`](resources/views/quiz-test.blade.php)
- Correction/results: [`resources/views/correction.blade.php`](resources/views/correction.blade.php)
- Leaderboard: [`resources/views/tables.blade.php`](resources/views/tables.blade.php)

Livewire leaderboard components (optional):
- [`resources/views/livewire/leaderboard.blade.php`](resources/views/livewire/leaderboard.blade.php)
- [`resources/views/livewire/leaders.blade.php`](resources/views/livewire/leaders.blade.php)
- Component classes: [`app/Http/Livewire/Leaderboard.php`](app/Http/Livewire/Leaderboard.php), [`app/Http/Livewire/Leaders.php`](app/Http/Livewire/Leaders.php)

## Execution Flow

1. Student registration
   - User submits phone and name to [`php.QuizController::store()`](app/Http/Controllers/QuizController.php:26).
   - Student is created/updated, phone is session-persisted, redirect to instructions.

2. Quiz selection and render
   - Dashboard determines which quiz path to take (`multiple`, `blank`, or default spelling) via [`php.QuizController::quiz()`](app/Http/Controllers/QuizController.php:63).
   - View renders questions and captures user input and timing.

3. Submission and initial scoring
   - Frontend posts collected data either to web processing [`php.QuizController::process()`](app/Http/Controllers/QuizController.php:120) or to API processing [`php.QuizController::processQuestionsAi()`](app/Http/Controllers/QuizController.php:199).
   - MC/Spelling correctness is resolved by simple equality on `expected_answer` vs `given_answer` (case-insensitive).

4. AI evaluation for free-text
   - Paragraph answers are evaluated with `AIService`:
     - Immediate single-question calls: [`php.AIService::evaluate()`](app/Services/AIService.php:10)
     - Batch/fallback recalculation: [`php.AIService::recalculate()`](app/Services/AIService.php:201), [`php.AIService::openAIGenerate()`](app/Services/AIService.php:63)
   - Color coding applied via [`php.AIService::getColor()`](app/Services/AIService.php:151).

5. Persistence and result views
   - Player records are created with totals (`score`, `percent`, `seconds_used`, `question_type`) then passed to correction view via [`php.QuizController::completed()`](app/Http/Controllers/QuizController.php:251) or reloaded by [`php.QuizController::result()`](app/Http/Controllers/QuizController.php:294).

## Payload Shapes

While not fully formalized, key fields used across the pipeline:

- Multiple-choice question item (server-provided)
  - `question_type`: "multiple_choice"
  - `question`: string
  - `a|b|c|d`: string options
  - `answer`: field key pointing to the correct option (e.g., `"a"`)
  - `expected_answer`: concrete value of correct option (populated for scoring)
  - `timer`: seconds per question
  - `mark`: numeric mark

- Spelling item
  - `question_type`: "spelling"
  - `word`: string
  - `answer` and `expected_answer`: the same `word`
  - `mark`, `timer`
  - Optional: `audio` base64 MP3 (Google TTS)

- Paragraph item
  - `question_type`: "paragraph"
  - `question`: string (context)
  - `answer`: canonical correct answer
  - `given_answer`: user’s free-text response
  - `mark`, `timer`
  - Optional: `instruction` for AI prompt

- Submission (Player creation, summarized)
  - `user_id`, `name`, `type`, `level`, `question_type`
  - `questions`: array of items including computed `score`, `ai_score`, `color`, `second_spent`
  - Derived: `score`, `percent`, `seconds_used`

## Environment Configuration

Set DB credentials per [`readme.md`](readme.md) and add AI/TTS keys:

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_password

# Local LLM (Ollama)
OLLAM_LINK=http://localhost:11434/api/generate

# OpenAI fallback (optional)
OPENAI_API_KEY=sk-...

# Google Text-to-Speech (for spelling audio)
GOOGLE_TTS_API_KEY=...
```

## Running the Application

1. Composer install, migrate, seed, serve:
   - `composer install`
   - `php artisan migrate`
   - `php artisan db:seed` (if seeds exist)
   - `php artisan serve` → `http://localhost:8000`

2. Visit the web flow:
   - `/` → welcome
   - `/instructions` → dashboard (after registration)
   - `/quiz/{student:user_id}/{type?}` → quiz page
   - `/completed/{player}` → correction
   - `/table` → leaderboard

## API Usage Examples

- Fetch multiple-choice questions by type:
  - POST or GET `/api/quiz` with JSON `{ "type": "bible" }`
  - Handler: [`php.QuestionsController::index()`](app/Http/Controllers/QuestionsController.php:15)

- Process questions with AI (preferred API entrypoint):
  - POST `/api/process-questions`
  - Body:
    ```
    {
      "user_id": "01234567890",
      "name": "John Doe",
      "type": "bible",
      "level": "level 1",
      "questions": [
        {
          "question_type": "multiple_choice",
          "question": "Sample?",
          "expected_answer": "Yes",
          "given_answer": "Yes",
          "mark": 3,
          "timer": 20
        },
        {
          "question_type": "paragraph",
          "question": "Explain ...",
          "answer": "Canonical answer",
          "given_answer": "User text",
          "mark": 10,
          "timer": 60,
          "instruction": "Optional prompt hints"
        }
      ]
    }
    ```
  - Handler: [`php.QuizController::processQuestionsAi()`](app/Http/Controllers/QuizController.php:199)
  - Returns: Player JSON with updated `questions`, totals (`score`, `percent`, `seconds_used`), and `ai_marked` status.

- Single-question AI evaluation:
  - POST `/api/ai-evaluation`
  - Body: `{ "question": "...", "answer": "...", "user_answer": "...", "instruction": "..." }`
  - Handler: [`php.AIModelCheckerController::evaluate()`](app/Http/Controllers/AIModelCheckerController.php:10)
  - Response: `{ "similarity_percentage": 0..100, "evaluation_result": "Correct|Incorrect" }`

## Scoring and Color Coding

- MC/Spelling
  - Equality check on lowercase-trimmed `expected_answer` vs `given_answer`
  - Correct → full `mark`, `ai_score = 100`, color `#008000` (green)

- Paragraph
  - AI returns `similarity_score` 0–100
  - Score = `percent * mark / 100` (rounded by PHP float semantics)
  - Colors via [`php.AIService::getColor()`](app/Services/AIService.php:151):
    - `null` → gray
    - `< 1` → red
    - 1–20 → orange-red
    - 21–50 → orange
    - 41–60 → yellow
    - 61–80 → light green
    - 81–90 → lime green
    - ≥ 90 → deep green

## Error Handling and Idempotency

- AIService returns `0` on exceptions or non-success HTTP responses, ensuring non-fatal behavior.
- `processQuestionsAi` wraps recalculation in try/catch and logs errors (`AI ERROR ...`) without breaking the request lifecycle.
- Player `ai_marked` prevents duplicate recalculations; recalculation sets `ai_marked = true` after success.

## Extensibility Notes

- Add new quiz types:
  - Extend dispatch in [`php.QuizController::quiz()`](app/Http/Controllers/QuizController.php:63).
  - Create associated Eloquent model and Blade view.
  - Update scoring in [`php.AIService::calculateScores()`](app/Services/AIService.php:163) and AI batch handling in [`php.AIService::recalculate()`](app/Services/AIService.php:201).

- Formalize payloads and validation:
  - Introduce FormRequests for `process` and `processQuestionsAi` to enforce payload shapes.
  - Consider per-item DTOs to reduce loose arrays and implicit fields.

- Stable AI scoring:
  - Pin AI model and version; add structured schema validation for AI responses.
  - Add confidence thresholds per level/type.

- Performance:
  - Offload AI recalculation to queue workers; mark `ai_marked` async and notify on completion (Broadcast events exist but are disabled in [`php.Player::booted()`](app/Player.php:81)).

## Security Considerations

- Validate and sanitize all user-provided fields (names, free-text answers).
- Lock AI endpoints to internal usage or add rate limiting to avoid abuse.
- Ensure `.env` secrets (DB, OpenAI, Google TTS) are not exposed via views or logs.

## File Map (Selected)

- Routing
  - [`routes/web.php`](routes/web.php)
  - [`routes/api.php`](routes/api.php)

- Controllers
  - [`app/Http/Controllers/QuizController.php`](app/Http/Controllers/QuizController.php)
  - [`app/Http/Controllers/QuestionsController.php`](app/Http/Controllers/QuestionsController.php)
  - [`app/Http/Controllers/ParagraphController.php`](app/Http/Controllers/ParagraphController.php)
  - [`app/Http/Controllers/SpellingController.php`](app/Http/Controllers/SpellingController.php)
  - [`app/Http/Controllers/AIModelCheckerController.php`](app/Http/Controllers/AIModelCheckerController.php)

- Models
  - [`app/Student.php`](app/Student.php)
  - [`app/Question.php`](app/Question.php)
  - [`app/Spelling.php`](app/Spelling.php)
  - [`app/BlankParagraph.php`](app/BlankParagraph.php)
  - [`app/Player.php`](app/Player.php)

- Services
  - [`app/Services/AIService.php`](app/Services/AIService.php)

- Views & Layout
  - [`resources/views/layouts/master.blade.php`](resources/views/layouts/master.blade.php)
  - [`resources/views/*.blade.php`](resources/views)

## Summary

This codebase implements a complete quiz pipeline: student registration, question rendering, result processing, and AI-based evaluation for free-text responses. The architecture is modular with clear separation across Eloquent models, controllers, and the centralized AIService. Frontend integration leverages Blade for server-rendered views and simple JS helpers, while API routes provide programmatic access to quiz data and scoring. With environment keys configured, the system can operate entirely locally using Ollama, or optionally rely on OpenAI for batch evaluation and recalculation.