<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 21:33
 */

namespace ITR;


use ITR\Base\IResource;
use ITR\Base\IResourceRequest;
use Noodlehaus\ConfigInterface;

class Resource implements IResource
{
    /** @var ConfigInterface */
    protected $config = false;

    public function Serve(IResourceRequest $data): array
    {
        return ['error' => 'Not found'];
    }

    public function Process(IResourceRequest $data): array
    {
        return ['error' => 'Not found'];
    }

    public function SetConfiguration(ConfigInterface $config)
    {
        $this->config = $config;
    }
}