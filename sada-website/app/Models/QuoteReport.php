<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteReport extends Model
{
    protected $guarded = [];
    public function quote() { return $this->belongsTo(Quote::class); }
    public function user() { return $this->belongsTo(User::class); }
}
