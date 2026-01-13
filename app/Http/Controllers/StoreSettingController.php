<?php

namespace App\Http\Controllers;

use App\Enums\StoreSettingEnum;
use App\Models\Store;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreSettingController extends Controller
{
    public function index()
    {
        return Inertia::render('stores/Setting', [
            'settings' => StoreSettingEnum::list(),
            'settingValues' => StoreSetting::all(),
        ]);
    }

    public function upsert(Store $store, Request $request)
    {
        $rules = [];

        // Generate validation rules based on StoreSettingEnum
        foreach (StoreSettingEnum::cases() as $value) {
            $rules[$value->value] = 'required|boolean';
        }

        $validated = $request->validate($rules);

        $store->load('settings');

        foreach ($validated as $key => $value) {
            $setting = $store->settings->firstWhere('key', $key);
            if ($setting) {
                if ($setting->value != $value) {
                    $setting->update(['value' => $value]);
                }
            } else {
                // In case a new setting is added in the future
                $store->settings()->create([
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }

        Inertia::flash('success', 'Pengaturan toko berhasil diperbarui.');

        return back();
    }
}
