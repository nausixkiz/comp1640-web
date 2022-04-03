<?php

namespace App\Transformers;


use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'phone' => $user->phone,
            'address' => $user->address,
            'birth' => $user->birth != null ? Carbon::createFromFormat('Y-m-d H:m:i', $user->birth)->toDateString() : null,
            'role' => $user->getRoleNames()->first(),
        ];
    }
}


