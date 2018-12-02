<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constraint extends Model
{
  protected $fillable = ['word', 'use', 'active'];

  public function themes()
  {
      return $this->belongsToMany('App\Theme');
  }

  public function story()
  {
      return $this->belongsToMany('App\Story');
  }
}
