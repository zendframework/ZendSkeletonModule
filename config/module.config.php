<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'skeleton' => 'ZendSkeletonModule\Controller\SkeletonController',
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'ZendSkeletonModule' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);
