<?php

namespace App\Transformers;


use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class CommentTransfermer extends TransformerAbstract
{
    public function transform(Comment $comment): array
    {
        return [
            'id' => $comment->id,
            'contents' => $comment->contents,
            'like_count' => $comment->like_count,
            'dislike_count' => $comment->dislike_count,
            'user_name' => $comment->user->name,
            'post_name' => $comment->post->name,
            'created_at' => $comment->created_at,
            'updated_at' => $comment->updated_at,
        ];
    }
}


