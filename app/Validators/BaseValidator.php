<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationException;

abstract class BaseValidator
{
    protected function checkRules($params, $rules): ValidationException|bool
    {
        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            throw new ValidationException(
                $validator->errors(),
                'Parameters didn\'t pass the validation rules for the method'
            );
        }
        return true;
    }

    protected function getUniqueRule($table, $id = 0)
    {
        $rule = Rule::unique($table);

        if ($id > 0) {
            $rule = $rule->ignore($id);
        }
        return $rule;
    }
}
