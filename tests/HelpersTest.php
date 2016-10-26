<?php

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Fakes\PublicPropertyTarget;

class HelpersTest extends \PHPUnit_Framework_TestCase
{

    public function testMapTo()
    {
        $data1 = [
            'name' => 'test name 1',
            'type' => 'test type 2',
        ];
        $data2 = [
            'name' => 'test name 1',
            'type' => 'test type 2',
        ];

        $data = [$data1, $data2];

        $result = array_map(mapTo(PublicPropertyTarget::class), $data);

        $this->assertCount(2, $result);
        $this->assertInstanceOf(PublicPropertyTarget::class, $result[0]);
        $this->assertInstanceOf(PublicPropertyTarget::class, $result[1]);

        $this->assertSame('test name 1', $result[0]->name);
        $this->assertSame('test type 2', $result[0]->type);
    }
}
