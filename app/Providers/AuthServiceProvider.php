<?php

namespace App\Providers;

use App\Contracts\Dislikeable;
use App\Contracts\Likeable;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('like', function (User $user, Likeable $likeable) {
            if (!$likeable->exists) {
                return Response::deny("Cannot like an object that doesn't exists");
            }

            if ($user->hasLiked($likeable)) {
                return Response::deny("Cannot like the same thing twice");
            }

            return Response::allow();
        });

        Gate::define('remove-like', function (User $user, Likeable $likeable) {
            if (!$likeable->exists) {
                return Response::deny("Cannot remove this like an object that doesn't exists");
            }

            if (!$user->hasLiked($likeable)) {
                return Response::deny("Cannot remove this like without liking first");
            }

            return Response::allow();
        });

        Gate::define('dislike', function (User $user, Dislikeable $dislikeable) {
            if (!$dislikeable->exists) {
                return Response::deny("Cannot like an object that doesn't exists");
            }

            if ($user->hasDisliked($dislikeable)) {
                return Response::deny("Cannot like the same thing twice");
            }

            return Response::allow();
        });

        Gate::define('remove-dislike', function (User $user, Dislikeable $dislikeable) {
            if (!$dislikeable->exists) {
                return Response::deny("Cannot remove this like an object that doesn't exists");
            }

            if (!$user->hasDisliked($dislikeable)) {
                return Response::deny("Cannot remove this like without liking first");
            }

            return Response::allow();
        });
    }
}
