<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendSkeletonModule;

use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{

    /**
     * Return general-purpose module configuration for use with zend-expressive.
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'router' => $this->getRouterConfig(),
            'controllers' => $this->getControllerConfig(),
            'view_manager' => $this->getViewManagerConfig(),
        ];
    }

    /**
     * Return service-manager specific configuration.
     *
     * @return array
     */
    public function getDependencyConfig()
    {
        return [
            'abstract_factories' => [],
            'aliases'            => [],
            'delegators'         => [],
            'factories'          => [],
            'initializers'       => [],
            'invokables'         => [],
            'lazy_services'      => [],
            'services'           => [],
            'shared'             => [],
        ];
    }

    /**
     * Return router configuration.
     *
     * @return array
     */
    public function getRouterConfig()
    {
        return [
            'routes' => [
                'module-name-here' => [
                    'type'    => 'Literal',
                    'options' => [
                        // Change this to something specific to your module
                        'route'    => '/module-specific-root',
                        'defaults' => [
                            'controller'    => Controller\SkeletonController::class,
                            'action'        => 'index',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [
                        // You can place additional routes that match under the
                        // route defined above here.
                    ],
                ],
            ],
        ];
    }

    /**
     * Return ControllerManager configuration.
     *
     * @return array
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\SkeletonController::class => InvokableFactory::class,
            ],
        ];
    }

    /**
     * Return ViewManager configuration.
     *
     * @return array
     */
    public function getViewManagerConfig()
    {
        return [
            'template_path_stack' => [
                'ZendSkeletonModule' => __DIR__ . '/../view',
            ],
        ];
    }
}
