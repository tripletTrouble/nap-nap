<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function edit()
    {
        return Inertia::render('stores/Info');
    }

    public function update(Store $store, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:20',
        ]);

        $store->name = $data['name'];
        $store->address = $data['address'];
        $store->tagline = $data['tagline'];
        $store->code = $data['code'];
        $store->save();

        Inertia::flash('success', 'Informasi toko berhasil diperbarui.');

        return back();
    }
}
