<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Gidicodes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- app favicon -->
    <link rel="shortcut icon" href="{{asset('images/rccg_img.png')}}">
    <title>RCCG LP 69 Quiz Portal</title>
    <link href="{{asset('css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>
<body class="d-flex  flex-column">

<header style=" background: #0E1558 !important;" class="text-center text-white mb-3 py-2 ">
    <div class="d-flex justify-content-center align-items-center">
        <img height="45" width="45" src="{{asset('images/rccg_img.png')}}">
        <h1 class="ml-3 bold text-white">R.C.C.G LP 69</h1>
    </div>
    <p class="text-white">Web based quiz portal for children department</p>
</header>

<div class="pt-2">

    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-6">
        <form action="{{url('/')}}" method="post">
            @csrf
            <div class="card-body p-lg-4 p-xs-2 p-xl-5">
                @isset($error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="text-white"><strong>Error !</strong> {{$error}}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endisset
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p><strong>Error !</strong> {{session('error')}}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                        </button>
                    </div>
                @endif

                <div class="form-group pt-4">
                    <label for="name">Enter your Registered ID </label>
                    <input required id="name" name="user_id" class="form-control">
                </div>


                <div class="text-center pt-3">
                    <button type="submit" style="width: 120px" class="btn-primary btn  btn-round ">Proceed</button>
                </div>

            </div>
        </form>
    </div>

</div>

</body>
</html>

