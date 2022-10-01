<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{
    protected $rules = [];

    public function verify(array $params)
    {
        $validator = Validator::make($params, $this->rules);
 
        if ($validator->fails()) {
            return $validator->errors();
        }
        return true;
    }
}
