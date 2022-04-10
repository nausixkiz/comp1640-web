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
            'short_description' => $post->short_description,
            'slug' => $post->slug,
            'contents' => $post->contents,
            'thump_image_url' => $post->getFirstMediaUrl('thump'),
            'status' => $post->status,
            'start_date' => $post->birth != null ? Carbon::createFromFormat('Y-m-d H:m:i', $post->start_date)->toDateString() : null,
            'end_date' => $post->birth != null ? Carbon::createFromFormat('Y-m-d H:m:i', $post->end_date)->toDateString() : null,
            'documents' => $post->getMedia('document-file'),
            'author_name' => $post->user->name,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
        ];
    }
}


