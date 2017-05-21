<?php
/**
 * If you need an environment-specific system or application configuration,
 * there is an example in the documentation
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-system-configuration
 * @see https://docs.zendframework.com/tutorials/advanced-config/#environment-specific-application-configuration
 *
 * @see https://github.com/zendframework/ZendSkeletonApplication/blob/master/config/application.config.php
 */
return [
    // Retrieve list of modules used in this application.
    'modules' => require __DIR__ . '/modules.config.php',
    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => [
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
        'check_dependencies' => true,

        'config_glob_paths' => [
            realpath(__DIR__) . '/test/*.php',
        ],
    ],
];
