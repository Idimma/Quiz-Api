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

    <div class="card radius-10 ml-auto mr-auto mt-4 col-md-8" style="min-height: 70vh">
        <div class="card-body p-lg-4 p-xs-2 p-xl-5">
            <h3 class="bold">Instructions</h3>
            <p class="mb-3">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vestibulum ac diam
                sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor
                volutpat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo
                eget malesuada. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Donec
                sollicitudin molestie malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
            </p>
            <form action="{{url('quiz')}}" method="post">
                @csrf
                <input name="name" hidden value="{{$name ?? ''}}">
                <input name="zone" hidden value="{{$zone ?? ''}}">
                <input name="class" hidden value="{{$class ?? ''}}">
                <div class="py-3">
                    <p>Select Quiz Type</p>
                    <select name="type" class="form-control col-5">
                        <option>Multiple Options</option>
                        <option>Spelling Bee</option>
                    </select>

                    <p class="pt-4">
                        I <span class="bold text-primary">{{$name ?? ''}},</span> from
                        <span class="underline">
                        {{$zone ?? 'Selected Zone '}}
                    </span> confirm that I am in the age group <span
                                class="medium text-black-50"> {{$class ?? ''}}</span>
                        and I have read and understood the instructions stated above
                    </p>
                </div>

                <div class="row text-right px-5">

                    <button type="submit" class="btn-primary ml-auto btn btn-round"
                            style="width: 120px;">
                        Start Quiz
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>


</body>
</html>

