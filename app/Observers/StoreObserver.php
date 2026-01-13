<?php

namespace App\Observers;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class StoreObserver
{
    public function created(): void
    {
        /**
         * @var Store
         */
        $store = session('store');
        
        $this->refreshStoreInSession($store);
    }

    public function updated(): void
    {
        /**
         * @var Store
         */
        $store = session('store');
        
        $this->refreshStoreInSession($store);
    }

    private function refreshStoreInSession(Model $store): void
    {
        // Set session first
        session(['store' => $store->fresh(['settings'])]);

        $can = request()->user() ? [
            'manageUsers' => Gate::allows('manageUsers'),
            'updateStore' => request()->user()->can('update', session('store')),
            'manageProducts' => request()->user()->can('create', \App\Models\Product::class),
        ] : [];

        // Share data to inertia
        Inertia::share(['auth' => ['can' => $can], 'store' => session('store')]);
    }
}
