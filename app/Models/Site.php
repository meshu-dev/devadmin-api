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

    /**
     * Get the site's environment
     */
    public function environment()
    {
        return $this->belongsTo(Environment::class, 'environment_id');
    }
}
