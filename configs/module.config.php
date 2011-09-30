<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'skeleton' => 'ZendSkeletonModule\Controller\SkeletonController',
            ),
            'Zend\View\PhpRenderer' => array(
                'methods' => array(
                    'setResolver' => array(
                        'resolver' => 'Zend\View\TemplatePathStack',
                        'options'  => array(
                            'script_paths' => array(
                                'skeleton' => __DIR__ . '/../views',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
