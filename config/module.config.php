<?php
return array(
    'controller' => array(
        'classes' => array(
            'skeleton' => 'ZendSkeletonModule\Controller\SkeletonController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ZendSkeletonModule' => __DIR__ . '/../view',
        ),
    ),
);
