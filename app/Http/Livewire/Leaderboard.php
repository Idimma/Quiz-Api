<?php

namespace App\Http\Livewire;

use App\Player;
use Livewire\Component;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    protected $listeners = ['playerUpdated' => 'refreshPlayers'];
    public $players = [];

    public function refreshPlayers()
    {
        $this->emitSelf('refreshComponent');
    }

    public function mount()
    {
        $this->updateLeaderboard();
    }

    public function updateLeaderboard()
    {
        $this->players = Player::orderBy('percent', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.leaderboard');
    }
}
