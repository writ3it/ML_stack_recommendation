<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 19:07
 */

namespace ITR\Base;


use Noodlehaus\ConfigInterface;

interface IResourceRequest
{
    public function __construct();

    public function AppendInputData(array $data);

    public function GetErrors(): array;

    public function HasErrors(): bool;

    public function Configure(ConfigInterface $config);

    public function GetConfig(string $key);
}