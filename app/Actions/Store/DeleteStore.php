<?php

declare(strict_types=1);

namespace App\Actions\Store;

use App\Models\Store;
use App\Models\User;

class DeleteStore
{
    /**
     * Delete the user's store.
     *
     * @param  array<string, mixed>  $data
     */
    public function handle(User $user, Store $store): void
    {
        $user->stores()->delete($store);
    }
}
