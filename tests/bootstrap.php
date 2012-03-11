<?php

$rootPath = realpath(dirname(__DIR__));
$testsPath = "$rootPath/tests";

if (is_readable($testsPath . '/TestConfiguration.php')) {
    require_once $testsPath . '/TestConfiguration.php';
} else {
    require_once $testsPath . '/TestConfiguration.php.dist';
}

$path = array(
    ZEND_FRAMEWORK_PATH,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

require_once 'Zend/Loader/AutoloaderFactory.php';
\Zend\Loader\AutoloaderFactory::factory(
    array('Zend\Loader\StandardAutoloader' =>
        array(
            'fallback_autoloader' => false
        ),
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

$listenerOptions = new Zend\Module\Listener\ListenerOptions(array('module_paths' => $modulePaths));
$defaultListeners = new Zend\Module\Listener\DefaultListenerAggregate($listenerOptions);
$moduleManager = new \Zend\Module\Manager($modules);
$moduleManager->events()->attachAggregate($defaultListeners);
$moduleManager->loadModules();

if (method_exists($moduleTestCaseClassname, 'setLocator')) {
    $config = $defaultListeners->getConfigListener()->getMergedConfig();

    $di = new \Zend\Di\Di;
    $di->instanceManager()->addTypePreference('Zend\Di\Locator', $di);

    $diConfig = new \Zend\Di\Configuration($config['di']);
    $diConfig->configure($di);

    $routerDiConfig = new \Zend\Di\Configuration(
        array(
            'definition' => array(
                'class' => array(
                    'Zend\Mvc\Router\RouteStack' => array(
                        'instantiator' => array(
                            'Zend\Mvc\Router\Http\TreeRouteStack',
                            'factory'
                        ),
                    ),
                ),
            ),
        )
    );
    $routerDiConfig->configure($di);

    call_user_func_array($moduleTestCaseClassname.'::setLocator', array($di));
}

// When this is in global scope, PHPUnit catches exception:
// Exception: Zend\Stdlib\PriorityQueue::serialize() must return a string or NULL
unset($moduleManager);
