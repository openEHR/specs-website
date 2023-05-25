<?php

namespace App;

use ArrayObject;
use ArrayIterator;

class Configuration extends ArrayObject
{
    public function __construct(iterable $input = [])
    {
        foreach ($input as $key => $value) {
            if (is_iterable($value)) {
                $input[$key] = new self($value);
            }
        }
        parent::__construct($input, ArrayObject::ARRAY_AS_PROPS, ArrayIterator::class);
    }

}
