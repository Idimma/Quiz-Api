@extends('layouts.master')
@section('content')
    <div class="row row-no-gutter">
        <div class="card radius-10 ml-auto mr-auto mt-4 col-md-5">

            <form action="{{url('/')}}" class="p-lg-4 p-xs-2 p-3 p-xl-5" method="post">
                @csrf
                <div class="card-body ">
                    <h1 class="text-center">Welcome to Bible Quiz Portal</h1>

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
@stop