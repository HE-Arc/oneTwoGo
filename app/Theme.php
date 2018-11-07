<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Constraint;

class Theme extends Model
{
    protected $fillable = ['name', 'image'];

    public function constraints()
    {
        return $this->belongsToMany(Constraint::class);
    }
}
