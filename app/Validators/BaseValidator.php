<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationException;

abstract class BaseValidator
{
    protected $existsRules = [];
    protected $rules = [];

    public function verify(array $params): ValidationException|bool
    {
        return $this->checkRules($params, $this->rules);
    }

    public function verifyExists(int $id): ValidationException|bool
    {
        return $this->checkRules(['id' => $id], $this->existsRules);
    }

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
}
