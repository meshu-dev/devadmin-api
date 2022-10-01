<?php
namespace App\Validators;

class SiteValidator extends BaseValidator
{
    protected $rules = [
        'environment_id' => 'required|exists:App\Models\Environment,id',
        'name' => 'required|max:100',
        'url' => 'required|url|max:100',
    ];
}
