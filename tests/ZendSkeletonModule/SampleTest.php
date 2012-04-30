<?php
namespace ZendSkeletonModuleTest;

class SampleTest extends Framework\TestCase
{

    public function testSample()
    {
        $this->assertInstanceOf('Zend\Di\Locator', $this->getLocator());
    }
}
