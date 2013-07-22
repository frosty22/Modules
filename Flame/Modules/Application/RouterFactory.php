<?php
/**
 * Class RouterFactory
 *
 * @author: Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date: 20.07.13
 */
namespace Flame\Modules\Application;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;
use Nette\InvalidStateException;
use Nette\Reflection\ClassType;

class RouterFactory
{

	/** @var array  */
	private $routes;

	/**
	 * @param array $routes
	 */
	public function __construct(array $routes = array())
	{
		$this->routes = $routes;
	}

	/**
	 * @return array|RouteList
	 * @throws \Nette\InvalidStateException
	 */
	public function createRouter()
	{
		$routeList = new RouteList;
		if(count($this->routes)) {
			foreach ($this->routes as $class => $args) {
				$route = new ClassType($class);
				$routeList[] = $route->newInstanceArgs($args);
			}
		}
		return $routeList;
	}

}