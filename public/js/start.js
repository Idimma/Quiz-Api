function loadQuiz(stage){

    localStorage.setItem("stage", stage)
    window.location.href = "./quiz.php?s=" + stage;
}
