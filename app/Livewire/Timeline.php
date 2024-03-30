<?php

namespace App\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class Timeline extends Component
{
    // This will listen for the event `tweet::created` and refresh the component
    protected $listeners = ['tweet::created' => '$refresh'];

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.timeline', [
            'tweets' => Tweet::query()->latest()->paginate($this->perPage)
        ]);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
