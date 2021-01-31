<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_issue_image extends Model
{
    use HasFactory;

    /**
     *  Fillable
     */
    protected $fillable = ['project_issue_id', 'image_link'];
    /**
     * Protected with
     */
    protected $with = [];

    /**
     * Relationships
     */
}
