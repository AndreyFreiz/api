<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'slug', 'name', 'logo', 'description', 
        'content', 'link', 'displayOption'
    ];
}
