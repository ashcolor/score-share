<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'score_created_at',
        'score_created_by',
        'score_updated_at',
        'genre',
        'url',
    ];


    public function score_created_user()
    {
        return $this->belongsTo(User::class, 'score_created_by');
    }

    public function ownerships()
    {
        return $this->belongsToMany(User::class, 'ownerships', 'score_id', 'user_id');
    }

    public function wants()
    {
        return $this->belongsToMany(User::class, 'wants', 'score_id', 'user_id');
    }

}
