<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Player;
use Carbon\Carbon;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    protected $listeners = ['playerUpdated' => 'refreshPlayers'];

    public function refreshPlayers()
    {
        $this->emitSelf('refreshComponent');
    }

    public function render()
    {

        $players = Player::orderBy('percent', 'desc')->get();
        return view('livewire.leaderboard', compact('players'));
    }
}
