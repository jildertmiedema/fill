<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill;

final class TargetClassIsNotInstantiable extends FillException
{

    public static function withName($class)
    {
        return new static ('Cannot instantiate the class ' . $class . ', maybe it is abstract or an interface');
    }
}
