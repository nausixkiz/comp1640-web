<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('contents.dashboard', [
            'total_users_per_month' => User::count(),
        ]);
    }
}
