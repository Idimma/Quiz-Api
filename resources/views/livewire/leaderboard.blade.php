<div class="card radius-10 ml-auto mr-auto mt-4 col-md-11 " style="min-height: 70vh">
    <div class="card-body p-lg-4 p-md-3 p-xl-5">
        <div class="flex justify-between">
            <h1 class="text-[24px]">Leader Board</h1>
            <a href="{{ url('/') }}" class="text-primary" style="font-size: 16px">
                <span>Home</span>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table mb-0 radius-5">
                <thead class="bg-primary text-white radius-5">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Player</th>
                    <th scope="col">Score</th>
                    <th scope="col">Percent</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                @php

                        @endphp

                @foreach($players as $index => $player)
                        <?php
                        $details = \App\Services\AIService::getPositionDetails($index + 1); // Get position details
                        ?>
                    <tr style="background-color: {{ $details['background'] }};color: {{ $details['color'] }};">
                        <td>
                            <span><span style="font-size: 40px!important;"> {{ $details['medal'] }}</span> {{'  '}} {{ $details['position_text'] }}</span>
                        </td>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->score }}/{{ $player->mark }}</td>
                        <td>{{ number_format($player->percent * 100, 1) }}%</td>
                        <td>{{ $player->seconds_used }} Sec</td>
                        <td>{{ Carbon\Carbon::parse($player->created_at)->diffForHumans() }}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            @if(!count($players))
                <div class="centered text-center h-[500px]">
                    <h1 class="text-2xl">Waiting....</h1>
                </div>
            @endif

            <div wire:poll.5s="updateLeaderboard"></div>
        </div>
    </div>
</div>
