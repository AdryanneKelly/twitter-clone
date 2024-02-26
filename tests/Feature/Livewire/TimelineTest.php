<?php

use App\Livewire\Timeline;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Timeline::class)
        ->assertStatus(200);
});
