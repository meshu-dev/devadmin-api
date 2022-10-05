<?php
namespace App\Validators;

class EnvironmentValidator extends BaseValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Environment,id'
    ];

    protected $rules = [
        'name' => 'required|max:100'
    ];
}
