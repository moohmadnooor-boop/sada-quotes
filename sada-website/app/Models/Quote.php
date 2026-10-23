<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['content', 'category', 'mood', 'source', 'source_url', 'source_title', 'author_name', 'challenge_on'])]
class Quote extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() { return $this->belongsToMany(User::class, 'quote_likes')->withTimestamps(); }
    public function favorites() { return $this->belongsToMany(User::class, 'quote_favorites')->withTimestamps(); }
    public function comments() { return $this->hasMany(QuoteComment::class)->latest(); }
    public function collections() { return $this->belongsToMany(Collection::class)->withTimestamps(); }
}
