<?php

namespace App\Models;

use App\Contracts\Dislikeable;
use App\Contracts\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JetBrains\PhpStorm\ArrayShape;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'address',
        'avatar',
        'birth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'date',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function like(Likeable $likeable): self
    {
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        (new Like())
            ->user()->associate($this)
            ->likeable()->associate($likeable)
            ->save();

        return $this;
    }

    public function hasLiked(Likeable $likeable): bool
    {
        if (!$likeable->exists) {
            return false;
        }

        return $likeable->likes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->exists();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function removeLike($likeable): self
    {
        if (!$this->hasLiked($likeable)) {
            return $this;
        }

        $likeable->likes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->delete();

        return $this;
    }

    public function dislike(Dislikeable $dislikeable)
    {
        if ($this->hasDisliked($dislikeable)) {
            return $this;
        }

        (new Dislike())
            ->user()->associate($this)
            ->dislikeable()->associate($dislikeable)
            ->save();

        return $this;
    }

    public function hasDisliked(Dislikeable $dislikeable)
    {
        if (!$dislikeable->exists) {
            return false;
        }

        return $dislikeable->dislikes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->exists();
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(Dislike::class);
    }

    public function removeDislike($dislikeable): self
    {
        if (!$this->hasDisliked($dislikeable)) {
            return $this;
        }

        $dislikeable->dislikes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->delete();

        return $this;
    }

    public function getRoleName()
    {
        return $this->getRoleNames()[0];
    }

    #[ArrayShape(['slug' => "string[]"])] public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
