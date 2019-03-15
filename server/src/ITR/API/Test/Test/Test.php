<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 13:00
 */

namespace ITR\API\Test\Test;


use ITR\Base\IResource;
use ITR\Exception\NotFoundException;

class Test implements IResource
{

    public function Serve(array $data): array
    {
        if (!defined('TEST_ENV')){
            throw new NotFoundException('Test','Test','Test','testPath');
        }
        return $data;
    }
}