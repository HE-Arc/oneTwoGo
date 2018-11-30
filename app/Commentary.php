<?php

namespace App;

use App\User;
use App\Story;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    protected $table = 'commentaries';
    protected $fillable = [
        'user_id', 'story_id', 'comment'
    ];

    public function getId()
    {
        return $this->id;
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
