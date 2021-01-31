<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    /**
     *  Fillable
     */
    protected $fillable = ['user_id', 'name', 'description'];

    /**
     * Protected with
     */
    protected $with = ['admin'];

    /**
     * Relationships
     */
    public function admin()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function issues()
    {
        return $this->hasMany('App\Models\Project_issue', 'project_id', 'id');
    }
    public function collaborators()
    {
        return $this->hasMany('App\Models\Project_collaborator', 'project_id', 'id');
    }
}
