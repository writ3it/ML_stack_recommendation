<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 11:55
 */

namespace ITR\Exception;

class NotFoundException extends \Exception
{
    function __construct($version, $module, $resource, $path)
    {
        parent::__construct("API not found [{$version}].[{$module}].[{$resource}] in [{$path}]", $code = 1);
    }
}