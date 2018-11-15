<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
  protected $table = 'commentaries';
  protected $fillable = [
    'user_id', 'story_id', 'comment'
  ];

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
}
