<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 12:05
 */

namespace ITR\Validation\Custom;


use ITR\Base\IResourceRequest;
use ITR\Validation\IValidator;

class OverflowValidator implements IValidator
{

    const MAX_LENGTH = 1024;

    public function validate($val, IResourceRequest $request): bool
    {
        if (is_string($val)) {
            return strlen($val) >= 0 && strlen($val) <= MAX_LENGTH;
        }
        return true;
    }

    public static function x(): IValidator
    {
        return new static();
    }
}