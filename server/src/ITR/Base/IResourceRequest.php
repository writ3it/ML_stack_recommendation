<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 19:07
 */

namespace ITR\Base;


interface IResourceRequest
{
    public function __construct();

    public function AppendInputData(array $data);
}