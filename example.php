<?php
require_once 'vendor/autoload.php';

use function JildertMiedema\Fill\mapTo;

class Demo
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }
}

$data = [
    ['name' => 'test name 1'],
    ['name' => 'test name 1'],
];

$result = array_map(mapTo(Demo::class), $data);

var_dump($result);
