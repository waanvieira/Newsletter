<?php

namespace App\Traits;

use App\Exceptions\MethodMagicException;

trait MethodsMagicsTrait
{

    public function __get($prop)
    {
        if(isset($this->{$prop})) {
            return $this->{$prop};
        }

        $className = get_class($this);
        throw new MethodMagicException("Property {$prop} not found in class {$className}");
    }
}
