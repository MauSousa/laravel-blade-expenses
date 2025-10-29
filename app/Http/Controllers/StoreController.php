<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Store\CreateStore;
use App\Actions\Store\UpdateStore;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('store.index', [
            'stores' => Auth::user()->stores,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request, CreateStore $action): RedirectResponse
    {
        $action->handle($request->validated(), $request->user());

        return to_route('store.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store): View
    {
        return view('store.edit', [
            'store' => $store,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store, UpdateStore $action): RedirectResponse
    {
        $action->handle($request->user(), $store, $request->validated());

        return to_route('store.edit', $store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store): void
    {
        //
    }
}
