<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 14:36
 */

namespace ITR\Storage;


use FilesystemIterator;
use ITR\Base\IResourceRequest;

class Storage
{
    private $_path = '';
    private $_types = [];
    private $_persisted;

    public function __construct(array $config)
    {
        $this->_path = APPDIR . $config['destination']['path'];
        $this->_types = $config['destination']['types'];
        if (!file_exists($this->_path)) {
            mkdir($this->_path, $mode = 0755, $recursive = true);
        }

    }

    public function Persist(IResourceRequest $request)
    {
        $data = get_object_vars($request);
        $this->_persisted = count($this->_types) > 0;
        foreach ($this->_types as $name => $key) {
            $filename = $data[$key];
            $dir = $this->getTypePath($name);
            $path = $dir . $filename . '.json';
            if (!file_exists($dir)) {
                mkdir($dir, $mode = 0755, $recursive = true);
            }
            file_put_contents($path, \json_encode($data));
            $this->_persisted = $this->_persisted && file_exists($path);
        }
    }

    protected function getTypePath($type)
    {
        return $this->_path . $type . '/';
    }

    public function IsPersisted(): bool
    {
        return $this->_persisted;
    }

    public function Count(string $string): int
    {
        $path = $this->getTypePath($string);
        if (!file_exists($path)) {
            return 0;
        }
        $fi = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
        return iterator_count($fi);
    }
}