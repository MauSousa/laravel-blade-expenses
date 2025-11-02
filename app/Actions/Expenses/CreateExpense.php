<?php

declare(strict_types=1);

namespace App\Actions\Expenses;

use App\Models\Expense;
use App\Models\User;

class CreateExpense
{
    /**
     * Create a new expense.
     *
     * @param  array<string, mixed>  $data
     */
    public function handle(User $user, array $data): Expense
    {
        return Expense::create([
            'user_id' => $user->id,
            'store_id' => $data['store_id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'payment_method' => $data['payment_method'],
        ]);
    }
}
