<?php

declare(strict_types=1);

namespace App\Actions\Store;

use App\Models\Store;
use App\Models\User;

class UpdateStore
{
    /**
     * Create a new store.
     *
     * @param  array<string, mixed>  $data
     */
    public function handle(User $user, Store $store, array $data): void
    {
        $user->stores()->update([
            'name' => $data['name'] ?? $store->name,
        ]);

        $store->refresh();
    }
}
