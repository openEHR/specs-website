<?php

namespace App\Domain\Data;

abstract class AbstractModel
{

    public function __invoke(array $args = [])
    {
        foreach ($args as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }
}
