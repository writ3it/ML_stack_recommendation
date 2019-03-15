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
        /** @var ResourceLoader $loader */
        $loader = new ResourceLoader($this->_version, $this->_module, $this->_resource);
        if (!$loader->Exists()) {
            throw new NotFoundException($version, $module, $resource, $loader->GetRelativePath());
        }
        /** @var IResource $obj */
        $obj = $loader->GetInstance();
        /** @var ResourceRequest $request */
        $request = $loader->GetInstanceOfRequest();
        $request->AppendInputData($data);
        return $obj->Serve($request);
    }

    /**
     * Create instance of resource
     * @param string $version
     * @param string $module
     * @param string $resource
     */
    protected function loadClassName(string $version, string $module, string $resource)
    {


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