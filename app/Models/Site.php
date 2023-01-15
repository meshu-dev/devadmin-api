<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends BaseModel
{
    use HasFactory;

    protected $table = 'sites';

    protected $fillable = [
        'environment_id',
        'icon_id',
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

    /**
     * Get the site's icon
     */
    public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }
}
