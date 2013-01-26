<?php
namespace Tunneling\Rest;

use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractController;
use Zend\Http\Request as HttpRequest;
use Zend\Mvc\Exception;
use Zend\Mvc\MvcEvent;

class Controller extends AbstractController
{
    public function onDispatch(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        $params = $routeMatch->getParams();
        $vars = get_object_vars($e->getRequest()->getQuery());

        $filter = new \Zend\Filter\FilterChain();
        $filter->attach(new \Zend\Filter\Word\DashToCamelCase());
        $filter->attach(new \Zend\Filter\Callback("lcfirst"));

        $action = $filter->filter($params["action"]);

        $filter->attach(new \Zend\Filter\Callback("ucfirst"));
        $model = $filter->filter($params["model"]);

        $classname = "\\Tunneling\\Model\\{$model}";
        if (class_exists($classname)) {
        $clazz = new $classname;
        if (method_exists($clazz, $action)) {
                $ret = call_user_func_array(array($clazz, $action), $vars);

                $e->setResult($ret);
                return;
            } else {
                throw new \Zend\Mvc\Exception\InvalidArgumentException("Method \"{$action}\" doesn't exists'");
            }
        } else {
            throw new \Zend\Mvc\Exception\InvalidArgumentException("Class \"{$classname}\" doesn't exists'");
        }

    }
}
