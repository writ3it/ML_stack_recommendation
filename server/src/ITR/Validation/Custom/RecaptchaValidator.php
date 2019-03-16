<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 20:33
 */

namespace ITR\Validation\Custom;


use ITR\Base\IResourceRequest;
use ITR\Validation\IValidator;
use ReCaptcha\ReCaptcha;
use Slim\Http\Request;

class RecaptchaValidator implements IValidator
{

    public function validate($val, IResourceRequest $request): bool
    {
        /** @var Request $rawRequest */
        $rawRequest = $request->GetConfig('http.request');
        $secret = $request->GetConfig('recaptcha.secret');
        $recaptcha = new ReCaptcha($secret);
        $response = $recaptcha->verify($val, $rawRequest->getAttribute('ip_address'));
        return $response->isSuccess();
    }

    public static function x(): IValidator
    {
        return new static();
    }
}