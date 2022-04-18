<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period as CyrildeWitPeriod;
use Spatie\Analytics\Period;
use Analytics;

class DashboardController extends Controller
{
    public function index()
    {
;
        return view('contents.dashboard', [
            'user_data' => self::getUserDataAnalytics(),
            'view_idea_data' => self::getViewIdeaDataAnalytics(),
            'top_browsers' => self::getTopBrowsersDataAnalytics(),
            'top_ideas' => Post::orderByViews()->take(5)->get(),
            'visitor_data' => self::getVisitorDataAnalytics(),
            'total_visitors' => \Analytics::performQuery(Period::months(1), 'ga:sessions')->rows[0][0],
            'user_and_category_data' => self::getUserAndCategoryDataAnalytics(),
            'idea_and_category_data' => self::getIdeaAndCategoryDataAnalytics(),
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
        $data = Analytics::fetchTopBrowsers(Period::months(1));

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
                    $item['browser_icon'] = '<i class="ri ri-gradienter-fill"></i>';
                    break;
            }
            $response[] = $item;
        }
        return $response;
    }

    protected function getVisitorDataAnalytics()
    {
        $response = [];

        $data = Analytics::fetchUserTypes(Period::months(1));
        foreach ($data as $item) {
            if ($item['type'] == 'Returning Visitor') {
                $item['type_icon'] = '<i class="ri ri-user-received-fill"></i>';
                $response['returning_visitors'] = $item;
            }

            if ($item['type'] == 'New Visitor') {
                $item['type_icon'] = '<i class="ri ri-user-add-fill"></i>';
                $response['new_visitors'] = $item;
            }
        }

        return $response;
    }

    protected function getUserAndCategoryDataAnalytics()
    {
        $users_count = User::count();

        $response = [];

        foreach (Category::all() as $category) {
            $response[] = [
                $category->name,
                ceil($category->posts()->leftJoin('users', 'posts.user_id', '=', 'users.id')
                        ->distinct('users')
                        ->select('users.name as user_name')
                        ->groupBy('user_name')
                        ->get()->count() / $users_count * 100),
            ];
        }

        return $response;
    }

    protected function getIdeaAndCategoryDataAnalytics()
    {
        $ideas_count = Post::count();
        $response = [];

        foreach (Category::all() as $category) {
            $response[] = [
                $category->name,
                ceil($category->posts()->get()->count() / $ideas_count * 100),
            ];
        }

        return $response;
    }
}
