<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'hours', 'description',
    ];

    /**
     * The members that belong to the project.
     */
    public function members()
    {
        return $this->belongsToMany('App\Member', 'project_member');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
