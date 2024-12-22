<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'role', 'description',
    ];

    /**
     * The projects that belong to the member.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_member');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
