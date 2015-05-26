<?php
namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module 
{

    public function onBootstrap(MvcEvent $e) 
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() 
    {
        return array(
            'factories' => array(
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {

                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                }
            )
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

    public function mvcPreDispatch($event) 
    {
        $di = $event->getTarget()->getServiceLocator();
        $routeMatch = $event->getRouteMatch();
        $moduleName = $routeMatch->getParam('module');
        $controllerName = $routeMatch->getParam('controller');
        $actionName = $routeMatch->getParam('action');

        $authService = $di->get('Admin\Service\Index');

        if (!$authService->authorize($moduleName, $controllerName, $actionName)) {
            throw new \Exception('Você não tem permissão para acessar esse recurso!');
        }
        return true;
    }

}
