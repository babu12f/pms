<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function scopeProject($query, $id)
    {
        return $query->where('project_id', $id);
    }

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }


}
