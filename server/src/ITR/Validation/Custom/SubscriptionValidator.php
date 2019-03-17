<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 17.03.19
 * Time: 22:37
 */

namespace ITR\Validation\Custom;


use ITR\Base\IResourceRequest;
use ITR\Request\V1\Recommendation\CreateRequestRequest;
use ITR\Validation\IValidator;

class SubscriptionValidator implements IValidator
{

    /**
     * @param $val
     * @param CreateRequestRequest $request
     * @return bool
     */
    public function validate($val, IResourceRequest $request): bool
    {
        $request->webpush_id = sha1(\json_encode($val));
        return true;
    }

    public static function x(): IValidator
    {
        return new static();
    }
}