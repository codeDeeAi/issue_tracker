<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_collaborator extends Model
{
    use HasFactory;
    /**
     *  Fillable
     */
    protected $fillable = ['project_id', 'user_id'];
    /**
     * Protected with
     */
    protected $with = ['user'];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->hasMany('App\Models\User', 'id','user_id');
    }
}
