<?php
namespace Tunneling;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap($e)
    {
        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        /** @var \Zend\EventManager\SharedEventManager $sharedEvents */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach(
            'Zend\Mvc\Controller\AbstractController',
            MvcEvent::EVENT_DISPATCH,
            array($this, 'postProcess'),
            -100
        );
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

    public function getConfig()
    {
        return include __DIR__ . '/configs/module.config.php';
    }

    public function postProcess(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        if (\strpos($routeMatch->getMatchedRouteName(), "tunneling") !== false) {
            $e->getResponse()->setContent(json_encode($e->getResult()->getVariables()));
            return $e->getResponse();
        }
    }
}
