<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Site;

class Environment extends BaseModel
{
    use HasFactory;

    protected $table = 'environments';

    protected $fillable = [
        'name'
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
