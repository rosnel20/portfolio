<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Comment.php
class Comment extends Model
{
    protected $fillable = ['post_slug', 'name', 'email', 'body'];

    // Ne jamais exposer l'email dans les réponses JSON
    protected $hidden = ['email'];
}