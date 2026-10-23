<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Collection extends Model
{
    public function user() { return $this->belongsTo(User::class); }
    public function quotes() { return $this->belongsToMany(Quote::class)->withTimestamps(); }
}
