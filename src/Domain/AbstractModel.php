<?php

namespace App\Domain;

use App\Configuration;

abstract class AbstractModel
{
    protected $settings;

    public function __construct(Configuration $settings)
    {
        $this->settings = $settings;
    }

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
