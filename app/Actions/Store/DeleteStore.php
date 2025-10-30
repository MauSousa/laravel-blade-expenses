<?php

declare(strict_types=1);

namespace App\Actions\Store;

use App\Models\Store;

class DeleteStore
{
    /**
     * Delete the store.
     */
    public function handle(Store $store): void
    {
        $store->delete();
    }
}
