<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 11:53
 */

namespace ITR\Validation\Custom;


use ITR\Base\IResourceRequest;
use ITR\Validation\IValidator;

class PublicGitValidator implements IValidator
{

    public function validate($val, IResourceRequest $request): bool
    {
        // TODO: implement integration
        return true;
    }

    public static function x(): IValidator
    {
        return new static();
    }
}