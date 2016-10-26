<?php

namespace JildertMiedema\Fill\Normalizer;

use JildertMiedema\Fill\Fakes\NonDefaultClass;

class SimpleNormalizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testArray()
    {
        $data = [
            'name' => 'test name',
            'type' => 'test type',
        ];

        $normalizer = new SimpleNormalizer();

        $result = $normalizer->normalize($data);

        $this->assertSame('test name', $result['name']);
        $this->assertSame('test type', $result['type']);
    }

    public function testFromStdClassToPublicProperties()
    {
        $data = new \stdClass;
        $data->name = 'test name';
        $data->type = 'test type';

        $normalizer = new SimpleNormalizer();

        $result = $normalizer->normalize($data);

        $this->assertSame('test name', $result['name']);
        $this->assertSame('test type', $result['type']);
    }

    /**
     * @expectedException \JildertMiedema\Fill\CannotNormalizeData
     */
    public function testErrorOnNonDefaultClass()
    {
        $data = new NonDefaultClass();

        $normalizer = new SimpleNormalizer();
        $normalizer->normalize($data);
    }
}
