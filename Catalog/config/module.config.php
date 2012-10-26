<?php

namespace Catalog;

return array(
    'router' => array(
        'routes' => array(
             'catalog_controller' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/catalog[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'catalog_controller',
                        'action' => 'index',
                    ),
                ), 
            ),
        ),

    ),
    'view_manager' => array(
        'template_map' => array(
            'catalog_catalog_index' => __DIR__ . '/../view/catalog/catalog/index.phtml',
        ),
        
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
        // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
