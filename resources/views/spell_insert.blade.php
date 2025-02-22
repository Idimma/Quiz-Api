@extends('layouts.master')

@section('content')
    <main class="w-full max-w-[1200px] px-4 mx-auto pt-4 pb-[100px] mb-8">

        <div class="d-flex justify-content-between">
            <h1>Spellings</h1>
            <a href="{{url('/')}}" class="text-primary " style="font-size: 16px">
                <span>Home</span>
            </a>
        </div>

        <div class="flex flex-col  md:flex-row gap-4">
            <div class="w-full md:w-8/12" style="max-height: 60vh; overflow-y: auto">
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
                                <td>
                                    <button onclick="playAudio('{{ $spell->audio }}')">🔊 Play</button>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-full md:w-4/12">
                <div class="card">
                    <div class="card-body  p-lg-4 p-md-3 p-xl-5">
                        <form method="post" action="{{url('spellings')}}">
                            {{csrf_field()}}
                            <div>
                                <label>Word</label>
                                <input required type="text" class="form-control w-100" name="word"
                                       placeholder="Word: Genesis"/>
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

        <audio id="audioPlayer"></audio>

        <script>
			    function playAudio(base64Audio) {
				    const audio = document.getElementById('audioPlayer');
				    audio.src = "data:audio/mp3;base64," + base64Audio;
				    audio.play();
			    }
        </script>
    </main>
@stop