<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 10:53
 */

namespace ITR\Validation;

use ITR\Base\IResourceRequest;
use Respect\Validation\Validatable;

/**
 * Class Validator
 * It's adapter for Respect Validator
 * @package ITR\Validation
 * @method static \Respect\Validation\Validator arrayVal()
 * @method static \Respect\Validation\Validator numericVal()
 * @method static \Respect\Validation\Validator stringVal()
 * @method static \Respect\Validation\Validator age($minAge = null, $maxAge = null)
 */
class Validator implements IValidator
{

    private $ctx;

    public function __construct(Validatable $context)
    {
        $this->ctx = $context;
    }

    public function validate($val, IResourceRequest $request): bool
    {
        return $this->ctx->validate($val);
    }

    /**
     * @param $name
     * @param $arguments
     * @return \Respect\Validation\Validator
     */
    public function __call($name, $arguments)
    {
        call_user_func_array([$this->ctx, $name], $arguments);
        return $this;
    }

    public static function __callStatic($name, $args)
    {
        $validatorName = "\Respect\Validation\{$name}";
        $ctx = call_user_func_array($validatorName, $args);
        return new static($ctx);
    }

    /**
     * @return \Respect\Validation\Validator
     */
    public static function x(): IValidator
    {
        throw new Exception('Not implemented, use static call');
    }
}