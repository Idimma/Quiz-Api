<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Gidicodes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="shortcut icon" href="{{asset('images/rccg_img.png')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Quiz Portal</title>
    @yield('js')
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <style>
        .form-control{
            color: black;
            font-family: "Avenir Next Medium", fantasy;
            padding: 10px 20px;
        }
        .form-control::placeholder{
            color: gray;
            font-family: "Avenir Next Italic", fantasy;
        }
        label{
            color: black;
            font-family: "Avenir Next Italic", fantasy;
        }
    </style>
</head>
<body>
<div id="loadingIndicator">
    <div class="spinner"></div>
    <div id="loadingMessage"></div>
</div>
@if(!isset($no_header))
    <header style=" background: #0E1558 !important;" class="text-center text-white py-3 ">
        <a href="{{url('/')}}" class="centered">
            <img height="45" width="45" src="{{asset('images/rccg_img.png')}}">
            <div class="ml-3 text-left">
                <h1 class="title-text mb-0 bold text-white">BIBLE QUIZ PORTAL</h1>
                <p class="text-white m-0">Web based quiz portal for all</p>
            </div>
        </a>
    </header>
@endif
<main class="app-content">
    @yield('content', 'Default Content')
</main>
{{--<div class="credit text-center">--}}
{{--    Powered by <code class="d-inline">LSC The Bridge</code> Copyright &copy {{now()->year}}--}}
{{--</div>--}}
@include('partial.notify')
<script>
	function closeToast(target) {
		const toast = target.parentElement.parentElement
		if(toast){
			toast.style.animation = "fadeOut 0.5s ease-in-out";
			setTimeout(() => {
				toast.classList.remove("show");
				toast.style.animation = "";
			}, 500);
    }
	}

	function showLoading(message = '') {
		document.querySelectorAll('.fade-in').forEach(element => {
			element.classList.remove("show");
		});
		document.getElementById("loadingIndicator").style.display = "flex";
		document.getElementById("loadingMessage").innerHTML = message;
	}

	function hideLoading() {
		document.getElementById("loadingIndicator").style.display = "none";
		document.getElementById("loadingMessage").innerHTML = "";
	}

	function showFaded() {

		document.querySelectorAll('.fade-in').forEach((element, i) => {
			setTimeout(() => element.classList.add("show"), (i + 1) * 100);
		});

	}

	function startQuiz(cb, sec = 100) {
		showLoading();
		setTimeout(() => {
			setTimeout(cb, 200);
			hideLoading();
			showFaded()
			// setTimeout(cb, 600);

		}, sec);
	}
</script>
@yield('script')
</body>
</html>

