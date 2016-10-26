<?php

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Build\ReflectionBuilder;
use JildertMiedema\Fill\Fakes\PublicPropertyTarget;
use JildertMiedema\Fill\Normalizer\SimpleNormalizer;

class FillTest extends \PHPUnit_Framework_TestCase
{

    public function testMap()
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

        $fill = new Fill(new ReflectionBuilder(PublicPropertyTarget::class), new SimpleNormalizer());

        $result = array_map($fill->map(), $data);

        $this->assertCount(2, $result);
        $this->assertInstanceOf(PublicPropertyTarget::class, $result[0]);
        $this->assertInstanceOf(PublicPropertyTarget::class, $result[1]);

        $this->assertSame('test name 1', $result[0]->name);
        $this->assertSame('test type 2', $result[0]->type);
    }

    public function testFromStdClassToPublicProperties()
    {
        $data = new \stdClass;
        $data->name = 'test name';
        $data->type = 'test type';

        $fill = new Fill(new ReflectionBuilder(PublicPropertyTarget::class), new SimpleNormalizer());
        $result = $fill->fill($data);

        $this->assertInstanceOf(PublicPropertyTarget::class, $result);
        $this->assertSame('test name', $result->name);
        $this->assertSame('test type', $result->type);
    }
}
