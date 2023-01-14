<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Icon extends BaseModel
{
    use HasFactory;

    protected $table = 'icons';

    protected $fillable = [
        'name',
        'url'
    ];
}
