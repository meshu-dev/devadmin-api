<?php
namespace App\Repositories;

use App\Models\Icon;

class IconRepository extends ModelRepository
{
    public function __construct(Icon $icon)
    {
        parent::__construct($icon);
    }
}
