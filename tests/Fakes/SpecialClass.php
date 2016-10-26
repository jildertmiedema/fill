<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Fakes;

final class SpecialClass implements SpecialClassInterface
{
    private $name;
    private $type;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}
