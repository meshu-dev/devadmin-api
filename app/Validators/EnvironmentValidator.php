<?php
namespace App\Validators;

use App\Exceptions\ValidationException;

class EnvironmentValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Environment,id'
    ];

    protected $rules = [
        'name' => [
            'required',
            'max:100'
        ]
    ];

    public function verifyAdd(array $params): ValidationException|bool
    {
        $this->addUniqueRule();

        return parent::verifyAdd($params);
    }

    public function verifyEdit(int $id, array $params): ValidationException|bool
    {
        $this->addUniqueRule($id);

        return parent::verifyEdit($id, $params);
    }

    protected function addUniqueRule($id = 0)
    {
        $this->rules['name'][] = $this->getUniqueRule('environments', $id);
    }
}
