<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comments', 'project_id', 'user_id'];

    /**
     * Get the user that is reponsible for a comment
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
