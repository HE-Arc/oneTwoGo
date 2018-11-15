<?php

namespace App;

use DB;
use Auth;
use App\Vote;
use App\Commentary;
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
      return Commentary::where('story_id', $this->id)->get();
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

    public function like()
    {

      // Get user id
      $userID = Auth::user()->getId();

      // Get user's vote for this story
      $userVote = DB::table('votes')->where([
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
      $userVote = DB::table('votes')->where([
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
