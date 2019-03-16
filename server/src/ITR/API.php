<?php

namespace ITR;

use ITR\Base\IResource;
use ITR\Exception\NotFoundException;
use ITR\HTTP\HTTPMethod;
use Noodlehaus\ConfigInterface;

class API
{
    /** @var string */
    private $_version = false;
    /** @var string */
    private $_module = false;
    /** @var string */
    private $_resource = false;
    /** @var int */
    private $http_status_code = 200;
    /** @var ConfigInterface */
    private $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * With API versioning, server could be deal with clients with old interface
     * @param $version
     * @return $this
     */
    public function UseVersion($versionName)
    {
        $this->_version = $versionName;
        return $this;
    }

    /**
     * Use module name to serve response
     * @param $moduleName
     * @return $this
     */
    public function UseModule($moduleName)
    {
        $this->_module = $moduleName;
        return $this;
    }

    /**
     * Use resource to serve response
     * @param $resourceName
     * @return $this
     */
    public function UseResource($resourceName)
    {
        $this->_resource = $resourceName;
        return $this;
    }

    /**
     * Generate response data
     */
    public function Serve(array $data, $method): array
    {
        /** @var ResourceLoader $loader */
        $loader = new ResourceLoader($this->_version, $this->_module, $this->_resource);
        if (!$loader->Exists()) {
            throw new NotFoundException($version, $module, $resource, $loader->GetRelativePath());
        }
        /** @var IResource $obj */
        $obj = $loader->GetInstance();
        $obj->SetConfiguration($this->config);
        /** @var ResourceRequest $request */
        $request = $loader->GetInstanceOfRequest();
        $request->Configure($this->config);
        $request->AppendInputData($data);
        switch ($method) {
            case HTTPMethod::GET:
                return $obj->Serve($request);
            case HTTPMethod::POST:
                return $obj->Process($request);
            default:
                $this->http_status_code = 404;
                return ['error' => 'Resource not found'];
        }
    }

    /**
     * Get status code
     * @return int
     */
    public function GetStatusCode()
    {
        return $this->http_status_code;
    }


}