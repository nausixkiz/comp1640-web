<?php

namespace App\Http\Controllers;

use Analytics;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period as CyrildeWitPeriod;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{
    public function index()
    {

        return view('contents.dashboard', [
            'user_data' => self::getUserDataAnalytics(),
            'view_idea_data' => self::getViewIdeaDataAnalytics(),
            'top_browsers' => self::getTopBrowsersDataAnalytics(),
            'top_ideas' => Post::orderByViews()->take(5)->get(),
            'visitor_data' => self::getVisitorDataAnalytics(),
        ]);
    }

    protected function getUserDataAnalytics()
    {
        return [
            'total_users' => User::count(),
            'total_users_in_month' => User::whereMonth('created_at', '=', Carbon::now()->month)->count(),
            'total_users_in_previous_month' => User::whereMonth('created_at', '<', Carbon::now()->month)
                ->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)
                ->count(),
        ];
    }

    protected function getViewIdeaDataAnalytics()
    {
        return [
            'total_views' => views(Post::class)->count(),
            'total_views_in_month' => views(Post::class)->period(CyrildeWitPeriod::subMonths(1))->count(),
        ];
    }

    protected function getTopBrowsersDataAnalytics()
    {
        $response = [];
        $data = Analytics::fetchTopBrowsers(Period::months(1))->take(3);

        foreach ($data as $item) {
            switch ($item['browser']) {
                case 'Chrome':
                    $item['browser_icon'] = '<i class="ri ri-chrome-fill"></i>';
                    break;
                case 'Edge':
                    $item['browser_icon'] = '<i class="ri ri-edge-fill"></i>';
                    break;
                case 'Opera':
                    $item['browser_icon'] = '<i class="ri ri-opera-fill"></i>';
                    break;
                case 'Android Webview':
                    $item['browser_icon'] = '<i class="ri ri-android-fill"></i>';
                    break;
                case 'Safari':
                    $item['browser_icon'] = '<i class="ri ri-safari-fill"></i>';
                    break;
                default:
                    $item['browser_icon'] = '<i class="ri ri-gradienter-line"></i>';
                    break;
            }
            $response[] = $item;
        }
        return $response;
    }

    protected function getVisitorDataAnalytics()
    {
        return Analytics::fetchUserTypes(Period::months(1));
    }
}
