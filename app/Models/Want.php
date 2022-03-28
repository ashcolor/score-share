<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Want extends Model
{
    use HasFactory;

    protected $fillable = [
        'score_id',
        'user_id',
    ];

    public function score()
    {
        return $this->belongsToMany(Score::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
