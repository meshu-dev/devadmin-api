<?php
namespace App\Validators;

use App\Exceptions\ValidationException;

class IconValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Site,id'
    ];

    protected $rules = [
        'url' => 'required|url|max:500'
    ];
}
