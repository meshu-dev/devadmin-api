<?php
namespace App\Validators;

class EnvironmentValidator extends BaseValidator
{
    protected $rules = [
        'name' => 'required|max:100'
    ];
}
