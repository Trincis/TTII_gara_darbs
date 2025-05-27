<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Importē trūkstošās klases
use App\Models\Project;
use App\Models\Comment;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'assigned_to', 'project_id', 'deadline'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

