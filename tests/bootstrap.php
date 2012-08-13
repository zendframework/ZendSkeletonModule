<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

$additionalNamespaces = $additionalModulePaths = $moduleDependencies = null;

$rootPath = realpath(dirname(__DIR__));
$testsPath = "$rootPath/tests";

if (is_readable($testsPath . '/TestConfiguration.php')) {
    require_once $testsPath . '/TestConfiguration.php';
} else {
    require_once $testsPath . '/TestConfiguration.php.dist';
}

$path = array(
    ZF2_PATH,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

require_once  'Zend/Loader/AutoloaderFactory.php';
require_once  'Zend/Loader/StandardAutoloader.php';

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;

// setup autoloader
AutoloaderFactory::factory(
    array(
        'Zend\Loader\StandardAutoloader' => array(
            StandardAutoloader::AUTOREGISTER_ZF => true,
            StandardAutoloader::ACT_AS_FALLBACK => false,
            StandardAutoloader::LOAD_NS => $additionalNamespaces,
        )
    )
);

// The module name is obtained using directory name or constant
$moduleName = pathinfo($rootPath, PATHINFO_BASENAME);
if (defined('MODULE_NAME')) {
    $moduleName = MODULE_NAME;
}

// A locator will be set to this class if available
$moduleTestCaseClassname = '\\'.$moduleName.'Test\\Framework\\TestCase';

// This module's path plus additionally defined paths are used $modulePaths
$modulePaths = array(dirname($rootPath));
if (isset($additionalModulePaths)) {
    $modulePaths = array_merge($modulePaths, $additionalModulePaths);
}

// Load this module and defined dependencies
$modules = array($moduleName);
if (isset($moduleDependencies)) {
    $modules = array_merge($modules, $moduleDependencies);
}

$config = array(
    'module_listener_options' => array(
        'module_paths' => $modulePaths,
    ),
    'modules' => $modules,
);

$serviceManager = new \Zend\ServiceManager\ServiceManager(
    new \Zend\Mvc\Service\ServiceManagerConfig()
);
$serviceManager->setService('ApplicationConfig', $config);
$serviceManager->get('ModuleManager')->loadModules();

if (method_exists($moduleTestCaseClassname, 'setLocator')) {
    call_user_func_array($moduleTestCaseClassname.'::setLocator', array($serviceManager));
}

// When this is in global scope, PHPUnit catches exception:
// Exception: Zend\Stdlib\PriorityQueue::serialize() must return a string or NULL
unset($serviceManager);
