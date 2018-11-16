<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constraint extends Model
{
  protected $fillable = ['word', 'active'];

  public function themes()
  {
      return $this->belongsToMany('App\Theme');
  }
}
