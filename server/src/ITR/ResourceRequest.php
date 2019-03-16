<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 19:07
 */

namespace ITR;


use ITR\Base\IResourceRequest;
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
    }

    protected function InitValidation()
    {

    }

    protected $validators = [];

    protected function validate(string $name, IValidator $fieldValidator, $message = "Podana wartość jest niepoprawna")
    {
        $this->validators[$name][] = ['validator' => $fieldValidator, 'message' => $message];
    }
}