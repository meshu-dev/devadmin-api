<?php

namespace App\Repositories;

use App\Models\Environment;

class EnvironmentRepository extends ModelRepository
{
    public function __construct(Environment $environment)
    {
        parent::__construct($environment);
    }
}
