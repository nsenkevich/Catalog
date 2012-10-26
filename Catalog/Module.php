<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Catalog;


use Zend\Mvc\ModuleRouteListener;

class Module
{

    public function onBootstrap($e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'productList' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\CommentList();
                    $viewHelper->setCategoryService($locator->get('category_service'));
                    return $viewHelper;
                },
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
            ),
            'factories' => array(
                'category_repository' => function ($sm) {
                    $repository = $sm->get('doctrine.entitymanager.orm_default')->getRepository('Catalog\Entity\Category');
                    return $repository;
                },
                'product_repository' => function ($sm) {
                    $repository = $sm->get('doctrine.entitymanager.orm_default')->getRepository('Catalog\Entity\Product');
                    return $repository;
                },
                
                'product_form' => function($sm) {
                    $form = new Form\ProductForm();
                    $form->setInputFilter(new Form\ProductFilter());
                    return $form;
                },
                'category_form' => function($sm) {
                    $form = new Form\CategoryForm();
                    $form->setInputFilter(new Form\CategoryFilter());
                    return $form;
                },
                    
                'package_service' => function ($sm) {
                    $service = new Service\Comment();
                    $service->setRepository($sm->get('category_repository'));
                    $service->setCommentForm($sm->get('category_form'));
                    return $service;
                },
                'category_service' => function ($sm) {
                    $service = new Service\Category();
                    $service->setRepository($sm->get('category_repository'));
                    //$product_service->setCommentForm($sm->get('product_form'));
                    return $service;
                },
                'product_service' => function ($sm) {
                    $service = new Service\Product();
                    $service->setRepository($sm->get('product_repository'));
                    $service->setCommentForm($sm->get('product_form'));
                    return $service;
                },
                    
                
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'catalog_controller' => function ($sm) {
                    $controller = new \Comment\Controller\CatalogController();
                    $locator = $sm->getServiceLocator();
//                    $controller->setCommentForm($locator->get('comment_form'));
//                    $controller->setCommentService($locator->get('comment_service'));
                    return $controller;
                }
            )
        );
    }

}
