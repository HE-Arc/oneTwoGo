<?php

namespace App;

use DB;
use Auth;
use App\Vote;
use App\Commentary;
use App\User;
use App\Theme;
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

    public function getCommentariesCount()
    {
      return $this->commentaries()->count();
    }

    public function getUpvotesCount()
    {
      return $this->votes()->where('vote', '=', '1')->count();
    }

    public function getDidIVote($v)
    {
      if(Auth::user() == null)
        return false;
      return $this->votes()->where('vote', '=', $v)->where('user_id', Auth::user()->getId())->count() == 1;
    }

    public function getDownvotesCount()
    {
      return $this->votes()->where('vote', '=', '-1')->count();
    }

    public function like()
    {
      // Get user id
      $userID = Auth::user()->getId();

      // Get user's vote for this story
      $userVote = Vote::where([
          ['user_id', '=', $userID],
          ['story_id', '=', $this->id],
        ])->get()->first();

      $userVoteValue = null;
      // Get user's vote value
      if(isset($userVote))
        $userVoteValue = $userVote->vote;

      // Remove the positive vote
      if($userVoteValue === Vote::UPVOTE)
      {
        Vote::destroy($userVote->id);
      }
      else
      {
        // Remove negative vote and store a positive one
        if ($userVoteValue === Vote::DOWNVOTE) {
          Vote::destroy($userVote->id);
        }

        // Create a new vote
        $vote = new Vote();

        $vote->user_id = $userID;
        $vote->story_id = $this->id;
        $vote->vote = VOTE::UPVOTE;

        // Store a new one
        $vote->save();
      }

      // Get upvotes count
      $upvotesCount = $this->getUpvotesCount();
      $downvotesCount = $this->getDownvotesCount();

      // Return the number of upvotes
      return array($upvotesCount, $downvotesCount);
    }

    public function dislike()
    {
      // Get user id
      $userID = Auth::user()->getId();

      // Get user's vote for this story
      $userVote = Vote::where([
          ['user_id', '=', $userID],
          ['story_id', '=', $this->id],
        ])->get()->first();

      $userVoteValue = null;
      // Get user's vote value
      if(isset($userVote))
        $userVoteValue = $userVote->vote;

      // Remove the positive vote
      if($userVoteValue === Vote::DOWNVOTE)
      {
        Vote::destroy($userVote->id);
      }
      else
      {
        // Remove negative vote and store a positive one
        if ($userVoteValue === Vote::UPVOTE) {
          Vote::destroy($userVote->id);
        }

        // Create a new vote
        $vote = new Vote();

        $vote->user_id = $userID;
        $vote->story_id = $this->id;
        $vote->vote = VOTE::DOWNVOTE;

        // Store a new one
        $vote->save();

      }

      // Get upvotes count
      $upvotesCount = $this->getUpvotesCount();
      $downvotesCount = $this->getDownvotesCount();

      // Return the number of upvotes
      return array($upvotesCount, $downvotesCount);
    }

    public function getParagraphs()
    {
      return explode("<br />", $this->text);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function commentaries()
    {
      return $this->hasMany('App\Commentary')->orderBy("created_at", "desc");
    }

    public function constraints()
    {
      return $this->belongsToMany('App\Constraint');
    }

    public function votes()
    {
      return $this->hasMany(Vote::class);
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function theme()
    {
      return $this->belongsTo('App\Theme');
    }

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
