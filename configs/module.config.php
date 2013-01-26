<?php
return array(
    'controllers' => array(
        'invokables' => array(
        	'index' => 'Tunneling\Rest\Controller',
        )
    ),
    'router' => array(
        'routes' => array(
            'tunneling' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/tunnel',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '[/:model/:action]',
                            'constraints' => array(
                                'controller' => 'index',
                                'model' => '[a-zA-Z][a-zA-Z0-9_]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_]*'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    )
);
