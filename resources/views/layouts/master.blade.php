<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Gidicodes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{asset('images/rccg_img.png')}}">
    {{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    <title>Quiz Portal</title>
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <style>
        body {
            min-height: 100vh;
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }


        .credit {
            padding: 20px 10px;
            font-size: 10px;
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0
        }

        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        #loadingIndicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none; /* Initially hidden */
        }

        /* Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @media screen and (max-width: 768px) {
            .row-no-gutter {
                margin-right: 20px;
                margin-left: 20px;
            }

            .title-text {
                font-size: 20px;
            }
            .card-body{
                padding: 1rem;
            }
        }

    </style>
</head>
<body class="d-flex position-relative flex-column">
<div id="loadingIndicator">
    <div class="spinner"></div>
</div>
<header style=" background: #0E1558 !important;" class="text-center text-white mb-3 py-2 ">
    <a href="{{url('/')}}" class="d-flex justify-content-center align-items-center">
        <img height="45" width="45" src="{{asset('images/rccg_img.png')}}">
        <div class="ml-3">
            <h1 class="title-text mb-0 bold text-white">BIBLE QUIZ PORTAL</h1>
            <p class="text-white m-0">Web based quiz portal for all</p>
        </div>
    </a>
</header>

<div class="pt-2">
    @yield('content', 'Default Content')
</div>
<div class="credit text-center">
    Powered by <code class="d-inline">GIDICODES</code> Copyright &copy {{now()->year}}
</div>
<script>
	function showLoading() {
		document.querySelectorAll('.fade-in').forEach(element => {
			element.classList.remove("show");
		});
		document.getElementById("loadingIndicator").style.display = "flex";
	}

	function hideLoading() {
		document.getElementById("loadingIndicator").style.display = "none";
	}

	function startQuiz(cb, sec = 100) {
		showLoading();
		setTimeout(() => {
			hideLoading();
			document.querySelectorAll('.fade-in').forEach((element, i) => {
				// element.classList.add("show");
				setTimeout(() => {
					element.classList.add("show");
				}, (i + 1) * 100);

			});

			setTimeout(cb, 600);

		}, sec);
	}
</script>
@yield('script')
</body>
</html>

