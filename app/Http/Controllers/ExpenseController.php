<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Expenses\CreateExpense;
use App\Actions\Expenses\DeleteExpense;
use App\Actions\Expenses\UpdateExpense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request, CreateExpense $action): RedirectResponse
    {
        $action->handle($request->user(), $request->validated());

        return to_route('expense.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense, UpdateExpense $action): RedirectResponse
    {
        $action->handle($expense, $request->validated());

        return to_route('expense.edit', $expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense, DeleteExpense $action): RedirectResponse
    {
        $action->handle($expense);

        return to_route('expense.index');
    }
}
