<?php

namespace ITR;

use ITR\Base\IResource;
use ITR\Exception\NotFoundException;

class API
{

    private $_version = false;
    private $_module = false;
    private $_resource = false;

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
    public function Serve(array $data): array
    {
        /** @var IResource $obj */
        $obj = $this->loadClassName($this->_version, $this->_module, $this->_resource);
        return $obj->Serve($data);
    }

    /**
     * Create instance of resource
     * @param string $version
     * @param string $module
     * @param string $resource
     */
    protected function loadClassName(string $version, string $module, string $resource)
    {
        $loader = new ResourceLoader($version, $module, $resource);
        if (!$loader->Exists()) {
            throw new NotFoundException($version, $module, $resource, $loader->GetRelativePath());
        }
        return $loader->GetInstance();
    }

    /**
     * Get status code
     * @return int
     */
    public function GetStatusCode()
    {
        return 200;
    }


}