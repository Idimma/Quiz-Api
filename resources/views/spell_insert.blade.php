@extends('layouts.master')

@section('content')
    <div class=" radius-10 ml-auto mr-auto mt-4 col-md-11 " style="min-height: 70vh">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h1>Spellings</h1>
                <a href="{{url('/')}}" class="text-primary " style="font-size: 16px">
                    <span>Home</span>
                </a>
            </div>

            <div class="row">
                <div class="col-md-8" style="max-height: 60vh; overflow-y: auto">
                    <div class="table-responsive">
                        <table class="table mb-0 radius-5 ">
                            <thead class="bg-primary text-white radius-5  ">
                            <tr class="radius-5">
                                <th scope="col">#</th>
                                <th scope="col">Word</th>
                                <th scope="col">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($spellings as $index => $spell )
                                <tr>
                                    <td>#{{$index+ 1}}</td>
                                    <td>{{$spell->word}}</td>
                                    <td>{{$spell->level}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body  p-lg-4 p-md-3 p-xl-5">
                            <form method="post" action="{{url('spellings')}}">
                                {{csrf_field()}}
                                <div>
                                    <label>Word</label>
                                    <input required type="text" class="form-control w-100" name="word"
                                           placeholder="Word: Habakuku"/>
                                </div>
                                <div class="mt-3">
                                    <label>Level</label>
                                    <select required class="form-control" name="level">
                                        <option>Level 1</option>
                                        <option>Level 2</option>
                                        <option>Level 3</option>
                                        <option>Level 4</option>
                                        <option>Level 5</option>
                                    </select>
                                    <input hidden value="Bible" name="type"/>
                                </div>
                                <div class="row">
                                    <div style="margin-top: 20px" class="d-flex">
                                        <button class="btn-primary  mx-auto btn btn-round " title="SUBMIT"
                                                type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop