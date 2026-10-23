<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'bio'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function quotes() {
        return $this->hasMany(Quote::class);
    }

    public function likedQuotes() { return $this->belongsToMany(Quote::class, 'quote_likes')->withTimestamps(); }
    public function favoriteQuotes() { return $this->belongsToMany(Quote::class, 'quote_favorites')->withTimestamps(); }
    public function following() { return $this->belongsToMany(self::class, 'user_follows', 'follower_id', 'followed_id')->withTimestamps(); }
    public function followers() { return $this->belongsToMany(self::class, 'user_follows', 'followed_id', 'follower_id')->withTimestamps(); }
    public function quoteCollections() { return $this->hasMany(Collection::class); }
}
