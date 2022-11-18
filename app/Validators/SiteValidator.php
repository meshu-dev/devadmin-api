<?php
namespace App\Validators;

class SiteValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Site,id'
    ];

    protected $rules = [
        'environment_id' => 'required|exists:App\Models\Environment,id',
        'name' => 'required|max:100|unique:App\Models\Site,name',
        'url' => 'required|url|max:100',
    ];
}
