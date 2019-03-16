<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 11:17
 */

namespace ITR\Data;


class FormDataGenerator
{
    /**
     * @var string
     */
    private $_path = '';

    public function __construct(string $path)
    {
        $this->_path = APPDIR . $path;
    }

    public function GetData(string $name)
    {
        if (is_callable(array($this, $name))) {
            return $this->makeData($name);
        }
        return $this->loadData($name);
    }

    protected function loadData(string $string)
    {
        $path = $this->_path . $string . '.json';
        if (!file_exists($path)) {
            return [];
        }
        return \json_decode(\file_get_contents($path));
    }

    protected function makeData(string $funname)
    {
        if (!is_callable(array($this, $funname))) {
            return [];
        }
        return $this->{$funname}();
    }

    private function timesWithComputer()
    {
        $times = [];
        for ($i = 0; $i <= 20; $i += 3) {
            $times[] = $i . ' - ' . ($i + 2) . ' h';
        }
        return $times;
    }

    private function jobExperience()
    {
        $times = [];
        for ($i = 0; $i <= 27; $i += 3) {
            $times[] = $i . ' - ' . ($i + 2) . ' lat';
        }
        $times[] = '30+';
        return $times;
    }

    private function salaries()
    {
        $times = [];
        $dt = 1000;
        for ($i = 500; $i <= 60000; $i += $dt) {
            $times[] = $i . ' - ' . ($i + $dt - 1) . ' zł';
        }
        $times[] = 'Ponad 60k zł';
        return $times;
    }

    private function ages()
    {
        $times = [];
        for ($i = 20; $i < 60; $i += 5) {
            $times[] = $i . ' - ' . ($i + 4) . " lat";
        }
        return $times;
    }
}