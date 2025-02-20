@extends('layouts.master', ['no_header' => true])
@section('content')
    <div class="mobile-content centered flex-col  ">
        <div class="w-full px-3 ">
            <img src="{{asset('images/lsc.png')}}" alt="RCCG Logo" class="mx-auto"
                 style=" height: 140px"/>
            <h1 class="text-center text-[24px] mt-[20px] mb-[100px]">Welcome to Bible Quiz Portal</h1>
            <form action="{{url('/create')}}" method="post">
                @csrf
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
                <div class="form-group">
                    <label for="name">Student Name <span
                                style="font-size: 70%; font-style: italic">(Surname First)</span></label>
                    <input required id="name" placeholder="Oyewunmi Oluwafemi" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Phone number</label>
                    <input required id="phone" placeholder="08123456789" name="phone" class="form-control">
                    <input hidden name="type" value="bible">
                    <input hidden name="tiers" value="[]">
                    <input hidden name="level" value="level5">
                </div>


                {{--                    <div class="form-group pt-4">--}}
                {{--                        <label for="name">Enter your Registered ID </label>--}}
                {{--                        <input required id="name" name="user_id" class="form-control">--}}
                {{--                    </div>--}}


                <div class="text-center pt-3">
                    <button type="submit" style="width: 140px" class="btn-primary btn btn-round ">Proceed</button>
                </div>

            </form>
        </div>
    </div>
@stop