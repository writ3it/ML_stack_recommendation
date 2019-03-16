<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 19:07
 */

namespace ITR;


use ITR\Base\IResourceRequest;
use ITR\Validation\IInlineValidator;
use ITR\Validation\IValidator;

class ResourceRequest implements IResourceRequest
{
    public function __construct()
    {
        $this->InitValidation();
    }

    public function AppendInputData(array $data)
    {
        $defaults = get_object_vars($this);
        $properties = array_keys($defaults);
        $partData = array_intersect_key($data, array_flip($properties));
        foreach ($partData as $name => $value) {
            $this->{$name} = $value;
        }
        $this->ValidateAll();
    }

    protected function InitValidation()
    {

    }

    protected $validators = [];

    public function Configure(\Noodlehaus\ConfigInterface $config)
    {
    }

    protected function validate(string $name, IValidator $fieldValidator, $message = "Podana wartość jest niepoprawna")
    {
        $this->validators[$name][] = ['validator' => $fieldValidator, 'message' => $message];
    }

    private $_has_errors;

    public function HasErrors(): bool
    {
        return $this->_has_errors;
    }

    protected $errors = [];

    public function GetErrors(): array
    {
        return $this->errors;
    }

    const ALL_RULES = '*';

    public function ValidateAll()
    {
        $this->errors = [];
        $this->_has_errors = false;
        $allRules = array_key_exists(self::ALL_RULES, $this->validators) ? $this->validators[self::ALL_RULES] : [];
        foreach ($this->validators as $property => $rules) {
            if ($property == self::ALL_RULES) {
                continue;
            }
            $this->errors[$property] = [];
            $rules = $rules + $allRules;
            foreach ($rules as $rule) {
                $value = $this->{$property};
                /** @var IInlineValidator $validator */
                $validator = $rule['validator'];
                $message = $rule['message'];
                if (!$validator->validate($value, $this)) {
                    $this->_has_errors = true;
                    $this->errors[$property][] = $message;
                }
            }
        }
    }
}