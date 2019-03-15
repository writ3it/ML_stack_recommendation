<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 12:02
 */

namespace ITR;

define('BASE_PATH', dirname(__FILE__));
define('DS', '/');
define('NDS', '\\');
define('EXT', '.php');

use ITR\Base\IResource;


class ResourceLoader
{

    private $_exists;
    private $_resource;
    private $_module;
    private $_version;
    private $_validation;

    public function __construct(string $version, string $module, string $resource)
    {
        $this->_validation = $this->ValidateNames([$version, $module, $resource]);
        $this->_version = $version;
        $this->_module = $module;
        $this->_resource = $resource;
    }

    static public function ValidateNames(array $names)
    {
        return count(array_filter($names, 'static::validateName')) == count($names);
    }

    static protected function validateName($name)
    {
        if (!is_string($name)) {
            return false;
        }
        return preg_match('/^[a-z\-0-9]+$/', $name);
    }

    protected function setExists(bool $exists = false)
    {
        $this->_exists = $exists;
    }

    public function GetInstance(): IResource
    {
        $path = $this->getPath();
        require_once $path;
        $className = $this->getClassname();
        return new $className();
    }

    public function Exists(): bool
    {
        if (!$this->_validation) {
            return false;
        }
        $path = $this->getPath();
        if (!file_exists($path)) {
            return false;
        }
        return true;
    }

    protected function getPath(): string
    {
        return BASE_PATH . DS . $this->GetRelativePath();
    }

    public function GetRelativePath(): string
    {
        return 'API' . DS . $this->getName($this->_version) . DS . $this->getName($this->_module) . DS . $this->getName($this->_resource) . EXT;
    }

    protected function getClassname(): string
    {
        return NDS . __NAMESPACE__ . NDS . 'API' . NDS . $this->getName($this->_version) . NDS . $this->getName($this->_module) . NDS . $this->getName($this->_resource);
    }

    protected function getName(string $_name): string
    {
        $parts = explode('-', $_name);
        $names = array_map('ucfirst', $parts);
        return implode('', $names);
    }
}