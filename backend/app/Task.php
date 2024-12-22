<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Explicitly define the table name
    protected $table = "project_member";

    // Other model properties and methods
    protected $fillable = ['task',"hours", 'member_id', 'project_id', "description"];

    public function project()
    {
        return $this->belongsTo('App\Project', "project_id");
    }

    public function member()
    {
        return $this->belongsTo('App\Member', "member_id");
    }
}
