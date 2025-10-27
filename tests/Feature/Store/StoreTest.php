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

describe('eloquent relations', function () {
    test('store belongs to a user', function () {
        $store = Store::factory()->create();

        expect($store->user)->toBeInstanceOf(User::class);
    });

    test('user has many stores', function () {
        $user = User::factory()->create();
        Store::factory()->create(['user_id' => $user->id]);

        expect($user->stores)->toHaveCount(1);
    });
});

describe('store pages', function () {
    test('user can view index store page', function () {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('store.index'));
        $response->assertOk();
    });

    test('user can view create store page', function () {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('store.create'));
        $response->assertOk();
    });

    test('user can view edit store page', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('store.edit', $store));
        $response->assertOk();
    });
});

test('store can be created', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post(route('store.store'), [
        'name' => 'Test Store',
    ]);

    $response->assertRedirect(route('store.index'));
});
