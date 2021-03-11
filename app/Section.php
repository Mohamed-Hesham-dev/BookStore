<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    //
    use SoftDeletes;
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
