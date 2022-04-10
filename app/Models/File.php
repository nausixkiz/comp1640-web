<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'local_name',
        'original_name',
        'mime_type',
        'size',
        'md5',
        'product_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
