<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_name', 'project_notes', 'project_status', 'due_date'];

    public function scopePersonal($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function tasks()
    {
        return $this->hasMany('App\task');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function collaborations()
    {
        return $this->hasMany('App\Collaboration');
    }

}
