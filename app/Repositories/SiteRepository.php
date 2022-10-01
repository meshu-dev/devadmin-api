<?php
namespace App\Http\Repositories;

use App\Models\Site;

class SiteRepository extends ModelRepository
{
    public function __construct(Site $site)
    {
        parent::__construct($site);
    }
}
