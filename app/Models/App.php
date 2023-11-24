<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'slug', 'name', 'description', 'partnerLinkText',
        'partnerLinkUrl', 'partnerId', 'icon', 'screenshots',
        'content', 'size', 'publicationDate', 'categoryId',
        'version', 'solutionId', 'language', 'policyLink',
        'licenseLink', 'displayOption'
    ];
}