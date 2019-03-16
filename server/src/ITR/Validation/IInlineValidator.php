<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 10:38
 */

namespace ITR\Validation;


use ITR\Base\IResourceRequest;

interface IInlineValidator
{
    public function validate($val, IResourceRequest $request): bool;
}