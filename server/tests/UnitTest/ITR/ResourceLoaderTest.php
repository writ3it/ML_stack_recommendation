<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 12:51
 */

namespace Tests\UnitTest\ITR;

use ITR\ResourceLoader;
use PHPUnit\Framework\TestCase;

class ResourceLoaderTest extends TestCase
{
    public function testPathCreation(){
        $loader = new ResourceLoader('version','module','resource');
        $this->assertEquals('API'.DS.'Version'.DS.'Module'.DS.'Resource.php', $loader->GetRelativePath());
    }

    public function testExists(){
        $loader = new ResourceLoader('version','module','resource');
        $this->assertEquals(false, $loader->Exists());
        $loader = new ResourceLoader('test','test','test');
        $this->assertEquals(true, $loader->Exists());
    }

    public function testValidation(){
        $this->assertEquals(true, ResourceLoader::ValidateNames(['version','module','resource']));
        $this->assertEquals(false, ResourceLoader::ValidateNames(['version with error','module','resource']));
    }

}