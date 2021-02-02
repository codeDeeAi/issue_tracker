<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_issue extends Model
{
    use HasFactory;

    /**
     *  Fillable
     */
     protected $fillable = ['project_id', 'module', 'issue', 'qa_id', 'date_logged', 'qa_status', 'dev_id', 'dev_status', 'date_fixed'];
    /**
     * Protected with
     */
    protected $with = ['dev', 'qa', 'images'];

    /**
     * Relationships
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Project_issue_image', 'project_issue_id', 'id');
    }
    public function dev()
    {
        return $this->hasOne('App\Models\User', 'id',  'dev_id');
    }
    public function qa()
    {
        return $this->hasOne('App\Models\User', 'id', 'qa_id');
    }

    
}
