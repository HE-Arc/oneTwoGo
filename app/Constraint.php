<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Theme;

class Constraint extends Model
{
  protected $fillable = ['word'];

  public function themes()
  {
      return $this->belongsToMany(Theme::class);
  }
}
