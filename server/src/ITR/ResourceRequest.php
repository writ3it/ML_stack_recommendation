<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 19:07
 */

namespace ITR;


use ITR\Base\IResourceRequest;

class ResourceRequest implements IResourceRequest
{

    protected $data = [];

    public function __construct()
    {

    }

    public function AppendInputData(array $data)
    {
        $this->data = $data;
    }
}