<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Common\CommonApiController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DevController extends CommonApiController
{
    public function bumpData(): JsonResponse
    {
//        if (!Auth::guard('api')->user()->hasRole('Super Administrator'))
//        {
//            return $this->respondForbidden();
//        }

        Post::factory()->count(50)
            ->for(User::factory()->createOne())
            ->for(Category::factory()->createOne())
            ->create()
            ->each(fn(Post $post) => Comment::factory()
                ->count(5)
                ->for(User::factory()->createOne())
                ->create([
                    'post_id' => $post->id
                ])
                ->each(fn(Comment $comment) => $post->comments()->save($comment)));

        return $this->respondOk('Bumped data');
    }
}
