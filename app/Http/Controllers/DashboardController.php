<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('contents.dashboard', [
            'user_data' => self::getUserDataAnalyst(),
            'view_idea_data' => self::getViewIdeaDataAnalyst(),
        ]);
    }

    protected function getUserDataAnalyst()
    {
        return [
            'total_users' => User::count(),
            'total_users_in_month' => User::whereMonth('created_at', '=', Carbon::now()->month)->count(),
            'total_users_in_previous_month' => User::whereMonth('created_at', '<', Carbon::now()->month)
                ->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)
                ->count(),
        ];
    }

    protected function getViewIdeaDataAnalyst()
    {
        return [];
    }
}
