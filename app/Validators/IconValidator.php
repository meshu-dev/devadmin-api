<?php
namespace App\Validators;

use App\Exceptions\ValidationException;

class IconValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Icon,id'
    ];

    protected $rules = [
        'name' => 'required|max:100',
        'url' => 'required|url|max:500'
    ];
}
