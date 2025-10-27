<?php

declare(strict_types=1);

namespace App\Actions\Store;

use App\Models\Store;
use App\Models\User;

class CreateStore
{
    /**
     * Create a new store.
     *
     * @param  array<string, mixed>  $data
     */
    public function handle(array $data, User $user): Store
    {
        return $user->stores()->create($data);
    }
}
