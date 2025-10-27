<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;

class StoreController extends Controller
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
    public function store(StoreStoreRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store): void
    {
        //
    }
}
