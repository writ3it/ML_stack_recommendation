<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 15:50
 */

namespace ITR\API\V1\Provider;


use ITR\Base\IResourceRequest;
use ITR\Resource;
use ITR\Storage\Storage;

class Counter extends Resource
{
    public function Serve(IResourceRequest $data): array
    {
        $storage = new Storage($this->config->get('requests'));
        return ['count' => $storage->Count('request'), 'limit' => $this->config->get('need-requests')];
    }
}