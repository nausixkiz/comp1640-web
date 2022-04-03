<?php

namespace App\Transformers\Api;


use App\Models\Category;
use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    #[ArrayShape(['name' => "mixed", 'description' => "mixed"])] public function transform(Category $category): array
    {
        return [
            'name' => $category->name,
            'description' => $category->description,
        ];
    }
}


