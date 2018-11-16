<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['name', 'placeholder', 'active'];

    public function constraints()
    {
        return $this->belongsToMany('App\Constraint');
    }
}
