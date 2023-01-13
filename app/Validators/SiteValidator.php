<?php
namespace App\Validators;

use App\Exceptions\ValidationException;

class SiteValidator extends ApiValidator
{
    protected $existsRules = [
        'id' => 'required|exists:App\Models\Site,id'
    ];

    protected $rules = [
        'environment_id' => [
            'required',
            'exists:App\Models\Environment,id'
        ],
        'name' => [
            'required',
            'min:3',
            'max:100'
        ],
        'url' => [
            'required',
            'url',
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
        $this->rules['name'][] = $this->getUniqueRule('sites', $id);
    }
}
