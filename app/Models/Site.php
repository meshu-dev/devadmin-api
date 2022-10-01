<?php
namespace App\Models;

class Site extends BaseModel
{
    protected $table = 'sites';

    protected $fillable = [
        'environment_id',
        'name',
        'url'
    ];
}
