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
        'payment_method',
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

describe('create expense', function () {
    test('user can create expense', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'name' => 'Test Expense',
            'price' => 100,
            'payment_method' => 'cash',
        ]);
        $response->assertRedirect(route('expense.index'));
    });

    test('user can not create expense if store does not exist', function () {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => 123,
            'name' => 'Test Expense',
            'price' => 100,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('store_id');
    });

    test('user can not create expense if name is empty', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'name' => '',
            'price' => 100,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('name');
    });

    test('user can not create expense if price is empty', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'price' => 100,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('name');
    });

    test('user can not create expense if price is not a number', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'name' => 'Test Expense',
            'price' => 'abc',
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('price');
    });

    test('user can not create expense if payment method is empty', function () {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'name' => 'Test Expense',
            'price' => 100,
            'payment_method' => '',
        ]);

        $response->assertSessionHasErrors('payment_method');
    });

    test('user can not create expense if store is not created by user', function () {
        $user = User::factory()->create();
        $fakeUser = User::factory()->create();
        $store = Store::factory()->create([
            'user_id' => $fakeUser->id,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('expense.store'), [
            'store_id' => $store->id,
            'name' => 'Test Expense',
            'price' => 100,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('store_id');
    });
});
