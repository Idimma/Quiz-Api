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
                <div class="form-group">
                    <label for="name">Your Name <span style="font-size: 70%; font-style: italic">(Surname First)</span></label>
                    <input required id="name" name="name" class="form-control">
                </div>

                <div class="form-group pt-3">
                    <label for="zone">Select Your Zone</label>
                    <select  id="zone" name="zone" class="form-control">
                        @forelse(\App\Zone::get() as $zone)
                            <option>{{$zone->name}}</option>
                        @empty
                            <option disabled>No Zone Added Yet..</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group pt-3">
                    <label for="class">Select Your Age Group</label>
                    <select id="class" name="class" class="form-control">
                        <option>6 - 8</option>
                        <option>9 - 12</option>
                        <option>Teens</option>
                    </select>
                </div>
                <div class="text-center pt-3">
                    <button type="submit" style="width: 120px" class="btn-primary btn  btn-round ">Proceed</button>
                </div>

            </div>
        </form>
    </div>

</div>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=mWhii7gw"></script>
</body>
</html>

