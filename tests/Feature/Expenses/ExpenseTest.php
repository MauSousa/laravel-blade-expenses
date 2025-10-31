<?php

declare(strict_types=1);

use App\Models\Expense;
use App\Models\Store;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('to array', function () {
    $expense = Expense::factory()->create()->refresh();

    expect(array_keys($expense->toArray()))->toEqual([
        'id',
        'user_id',
        'store_id',
        'name',
        'price',
        'created_at',
        'updated_at',
    ]);
});

describe('eloquent relations', function () {
    it('belongs to user', function () {
        $expense = Expense::factory()->create();

        expect($expense->user)->toBeInstanceOf(User::class);
    });

    it('belongs to store', function () {
        $expense = Expense::factory()->create();

        expect($expense->store)->toBeInstanceOf(Store::class);
    });
});

describe('expense pages', function () {
    test('user can view index expense page', function () {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('expense.index'));
        $response->assertOk();
    });

    test('user can view create expense page', function () {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('expense.create'));
        $response->assertOk();
    });
});
