<?php

declare(strict_types=1);

use App\Models\Store;

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
