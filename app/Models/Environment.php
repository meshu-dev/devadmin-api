<?php
namespace App\Models;

class Environment extends BaseModel
{
    protected $table = 'environments';

    protected $fillable = [
        'name'
    ];
}
