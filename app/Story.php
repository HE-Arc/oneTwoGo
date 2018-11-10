<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
  /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'stories';
    protected $fillable = [
      'user_id', 'theme_id', 'title', 'text', 'deleteVoted'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getId()
    {
      return $this->id;
    }

    public function getCommentaries()
    {
      return DB::table('commentaries')->where('story_id', $this->id)->get();
    }

    public function getCommentariesCount()
    {
      return getCommentaries()->count();
    }

    public function getUpvotesCount()
    {
      return DB::table('votes')->where([
          ['story_id', '=', $this->id],
          ['vote', '=', '1'],
      ])->count();
    }

    public function getDownvotesCount()
    {
      return DB::table('votes')->where([
          ['story_id', '=', $this->id],
          ['vote', '=', '-1'],
      ])->count();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
