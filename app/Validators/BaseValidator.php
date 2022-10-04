<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationException;

abstract class BaseValidator
{
    protected $rules = [];

    public function verify(array $params)
    {
        $validator = Validator::make($params, $this->rules);
 
        if ($validator->fails()) {
            throw new ValidationException(
                $validator->errors(),
                'Parameters didn\'t pass the validation rules for the method'
            );
        }
        return true;
    }
}
