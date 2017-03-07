<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_name', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
