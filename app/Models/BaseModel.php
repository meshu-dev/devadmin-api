<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    private const VALID_PARAMS = [
        'limit',
        'offset',
        'order'
    ];
    protected $searchable = [];
    public $timestamps = false;

    public function verifySearchable($params)
    {
        $verifiedParams = [];

        foreach ($params as $paramName => $paramValue) {
            if (in_array($paramName, self::VALID_PARAMS) === true) {
                $verifiedParams[$paramName] = $paramValue;
            }
            if (in_array($paramName, $this->searchable) === true) {
                if ($paramValue === 'true' || $paramValue === 'false') {
                    $paramValue = filter_var($paramValue, FILTER_VALIDATE_BOOLEAN);
                }
                $verifiedParams[] = [$paramName, $paramValue];
            }
        }
        return $verifiedParams;
    }

    public function toArray()
    {
        $array = parent::toArray();
        unset($array['id']);
        
        return ['id' => $this->id] + $array;
    }
}
