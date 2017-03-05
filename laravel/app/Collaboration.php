<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $table = 'project_collaborator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'collaborator_id'];

    /**
     * Get the user that is a collaborator on another project
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'collaborator_id');
    }

    /**
     * Query scope to return information about the current project
     * @param  $query
     * @param  int $id
     * @return query
     */
    public function scopeProject($query, $id)
    {
        return $query->where('project_id', $id);
    }

}
