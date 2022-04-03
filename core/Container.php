<?php

namespace Core;

class Container
{
    private $dependecies = [];

    public function get($key)
    {
        if (!isset($this->dependecies[$key])) {

            return $this->make($key);
        }

        return $this->dependecies[$key]();
    }

    public function set($key, \Closure $value): void
    {
        $this->dependecies[$key] = $value;
    }

    private function make($key)
    {
        $reflection = new \ReflectionClass($key);
        $dependencies = [];
        if (!$reflection->getConstructor()) {
            return new $key;
        }
        foreach ($reflection->getConstructor()->getParameters() as $parameter) {
			if($parameter->getType() !== null) {
				$dependencies[] = $this->get($parameter->getType()->getName());
			}
        }

        return new $key(...$dependencies);
    }
}