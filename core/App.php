<?php

namespace Core;

class App
{

	private $router;
	private $container;

	private $providers = [];

	public function __construct(Router $router, Container $container)
	{
		$this->router = $router;
		$this->container = $container;
	}

	public function run()
	{
		// Register all providers
		foreach ($this->providers as $provider) {
			$providerObject = new $provider($this->container);
			$providerObject->register();
		}

		$this->url = $this->parseUrl();

		list($controller, $method, $params) = $this->router->match($this->url);

		if ($controller instanceof \Closure) {
			$callback = $controller;
		} else {
			$dependencies = $this->resolveControllerParams($controller);
			$params = $this->resolveMethodParams($controller, $method, $params);
			$callback = [new $controller(...$dependencies), $method];
		}
		call_user_func_array($callback, $params);
	}

	public function parseUrl()
	{
		return $_SERVER['REQUEST_URI'] ?? '/';
	}

	private function resolveControllerParams($controller)
	{
		$reflection = new \ReflectionClass($controller);
		$dependencies = [];
		if (!$reflection->getConstructor()) {
			return $dependencies;
		}
		foreach ($reflection->getConstructor()->getParameters() as $parameter) {
			$dependencies[] = $this->container->get($parameter->getType()->getName());
		}

		return $dependencies;
	}

	private function resolveMethodParams($controller, $method, $params)
	{
		$reflection = new \ReflectionMethod($controller, $method);

		$dependencies = [];

		foreach ($reflection->getParameters() as $parameter) {
			if ($parameter->getType()) {
				$dependencies[] = $this->container->get($parameter->getType()->getName());
			} else {
				$dependencies[] = array_shift($params);
			}
		}

		return $dependencies;
	}

	public function registerProvider(string $provider)
	{
		if (!(new \ReflectionClass($provider))->isSubclassOf(ServiceProvider::class)) {
			throw new \InvalidArgumentException('Provider must be an instance of ServiceProvider');
		}
		
		$this->providers[] = $provider;
	}
}