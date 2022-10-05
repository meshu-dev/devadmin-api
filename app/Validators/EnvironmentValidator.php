<?php
namespace App\Validators;

class EnvironmentValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Environment,id'
    ];

    protected $rules = [
        'name' => 'required|max:100|unique:App\Models\Environment,name'
    ];
}
