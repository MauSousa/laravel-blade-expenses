<?php

declare(strict_types=1);

namespace App\Actions\Expenses;

use App\Models\Expense;

class UpdateExpense
{
    /**
     * Update the specified expense.
     *
     * @param  array <string, mixed>  $data
     */
    public function handle(Expense $expense, array $data): void
    {
        $expense->update([
            'name' => $data['name'] ?? $expense->name,
            'price' => $data['price'] ?? $expense->price,
            'payment_method' => $data['payment_method'] ?? $expense->payment_method,
            'store_id' => $data['store_id'] ?? $expense->store_id,
        ]);

        $expense->refresh();
    }
}
