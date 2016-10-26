<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Fakes;

final class PrivatePropertyTarget
{
    private $name;
    private $type;

    /**
     * @param $name
     * @param $type
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->type;
    }
}
