<?php

namespace ZendSkeletonModuleTest\Controller;

use Zend\Http\Request;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use ZendSkeletonModule\Controller\SkeletonController;
use ZendSkeletonModule\Module;

class SkeletonControllerTest extends AbstractHttpControllerTestCase
{

    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../config/application.config.php'
        );

        parent::setUp();
    }

    public function testApplicationSettingUpCorrectModuleDependencies()
    {
        $this->dispatch('/module-specific-root', Request::METHOD_GET);
        $module = new Module();
        $this->assertModulesLoaded($module->getModuleDependencies());
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/module-specific-root', Request::METHOD_GET);
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('ZendSkeletonModule');
        $this->assertControllerName(SkeletonController::class);
        $this->assertControllerClass('SkeletonController');
        $this->assertMatchedRouteName('module-name-here');
    }
}
