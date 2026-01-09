<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('users/Index', [
            'users' => fn () => User::withTrashed()->paginate(10),
        ]);
    }

    public function deactivate(string $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        Inertia::flash('success', 'User berhasil dinonaktifkan');

        return back();
    }

    public function activate(string $user_id)
    {
        $user = User::withTrashed()->findOrFail($user_id);
        $user->restore();

        Inertia::flash('success', 'User berhasil diaktifkan');

        return back();
    }
}
