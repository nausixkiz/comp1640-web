<?php

namespace App\Transformers;


use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post): array
    {
        return [
            'id' => $post->id,
            'name' => $post->name,
            'description' => $post->description,
            'slug' => $post->slug,
            'contents' => $post->contents,
            'status' => $post->status,
            'is_featured' => $post->is_featured,
            'start_date' => $post->birth != null ? Carbon::createFromFormat('Y-m-d H:m:i', $post->start_date)->toDateString() : null,
            'end_date' => $post->birth != null ? Carbon::createFromFormat('Y-m-d H:m:i', $post->end_date)->toDateString() : null,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
        ];
    }
}


