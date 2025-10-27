<?php

declare(strict_types=1);

use App\Models\Store;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('to array', function () {
    $store = Store::factory()->create()->refresh();

    expect(array_keys($store->toArray()))
        ->toBe([
            'id',
            'user_id',
            'name',
            'created_at',
            'updated_at',
        ]);
});

it('belongs to a user', function () {
    $store = Store::factory()->create();

    expect($store->user)->toBeInstanceOf(User::class);
});

test('user can view store page', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get(route('stores.index'));
    $response->assertOk();

});
