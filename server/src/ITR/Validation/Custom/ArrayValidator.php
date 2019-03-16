<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 10:41
 */

namespace ITR\Validation;

use Respect\Validation\Rules\ArrayVal;
use Respect\Validation\Validator as v;


class ArrayValidator implements IValidator
{

    private $_minCount = 0;
    private $_maxCount = 0;


    public function SetMinCount($min)
    {
        $this->_minCount = $min;
        return $this;
    }

    public function SetMaxCount($max)
    {
        $this->_maxCount = $max;
        return $this;
    }

    public function validate($val): bool
    {
        if (!v::arrayVal()->each(v::stringType())) {
            return false;
        }
        $c = count($val);
        return $c >= $this->_minCount && $c <= $this->_maxCount;
    }

    /**
     * @return ArrayValidator
     */
    public static function x(): IValidator
    {
        return new static();
    }
}