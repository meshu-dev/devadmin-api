<?php
namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidationException;

abstract class ApiValidator extends BaseValidator
{
    protected $existsRules = [];
    protected $rules = [];

    public function verifyAdd(array $params): ValidationException|bool
    {
        return $this->checkRules($params, $this->rules);
    }

    public function verifyEdit(int $id, array $params): ValidationException|bool
    {
        $params['id'] = $id;
        $rules = array_merge($this->existsRules, $this->rules);
        
        return $this->checkRules($params, $rules);
    }

    public function verifyExists(int $id): ValidationException|bool
    {
        return $this->checkRules(['id' => $id], $this->existsRules);
    }
}
