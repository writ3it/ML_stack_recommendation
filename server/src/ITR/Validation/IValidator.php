<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 10:46
 */

namespace ITR\Validation;


interface IValidator extends IInlineValidator
{
    public static function x(): IValidator;
}