<?php

use App\Livewire\Timeline;
use App\Livewire\Tweet\Create;
use App\Models\Tweet;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

it('should be able to create a tweet', function ($tweet) {
    $user = User::factory()->create();
    actingAs($user);
    livewire(Create::class)
        ->set('body', $tweet)
        ->call('tweet')
        ->assertDispatched('tweet::created');

    assertDatabaseCount('tweets', 1);

    expect(Tweet::first())->body->toBe($tweet)->created_by->toBe($user->id);
})->with([
            'This is my first tweet',
            'This is my second tweet',
            'This is my third tweet',
        ]);

it('should make sure that only authenticated users can tweet', function () {
    livewire(Create::class)
        ->set('body', 'This is my first tweet')
        ->call('tweet')
        ->assertForbidden();

    actingAs(User::factory()->create());

    livewire(Create::class)
        ->set('body', 'This is my first tweet')
        ->call('tweet')
        ->assertDispatched('tweet::created');
});

test('body is required', function () {
    actingAs(User::factory()->create());
    livewire(Create::class)
        ->set('body', null)
        ->call('tweet')
        ->assertHasErrors(['body' => 'required']);
});

test('the tweet body should have a max length of 140 characters', function () {
    actingAs(User::factory()->create());
    livewire(Create::class)
        ->set('body', str_repeat('a', 141))
        ->call('tweet')
        ->assertHasErrors(['body' => 'max']);
});

it('should show the tweet on the timeline', function () {
    $user = User::factory()->create();
    actingAs($user);
    livewire(Create::class)
        ->set('body', 'This is my first tweet')
        ->call('tweet')
        ->assertDispatched('tweet::created');

    livewire(Timeline::class)->assertSee('This is my first tweet');
});

it('should set body as null after tweeting', function () {
    actingAs(User::factory()->create());
    livewire(Create::class)
        ->set('body', 'This is my first tweet')
        ->call('tweet')
        ->assertDispatched('tweet::created')
        ->assertSet('body', null);
});
