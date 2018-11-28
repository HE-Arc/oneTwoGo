<?php

namespace App;

use App\User;
use App\Story;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
  public const UPVOTE = 1;
  public const DOWNVOTE = -1;

  public function getStory()
  {
      return DB::table('stories')->where('id', $this->story_id)->get()->first();
  }

  public function getOwner()
  {
      return DB::table('users')->where('id', $this->user_id)->get()->first();
  }

  public function getId()
  {
      return $this->id;
  }

  public function story()
  {
      return $this->belongsTo(Story::class);
  }

  public function owner()
  {
      return $this->belongsTo(User::class);
  }
}
