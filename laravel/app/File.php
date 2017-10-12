<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
