<?php

namespace JildertMiedema\Fill\Normalizer;

use JildertMiedema\Fill\Fakes\SpecialClass;
use JildertMiedema\Fill\Fakes\SpecialClassInterface;

class CallbackNormalizerTest extends \PHPUnit_Framework_TestCase
{
    public function testFallback()
    {
        $data = new \stdClass;
        $data->name = 'test name';
        $data->type = 'test type';

        $normalizer = new CallbackNormalizer(new SimpleNormalizer());

        $result = $normalizer->normalize($data);

        $this->assertSame('test name', $result['name']);
        $this->assertSame('test type', $result['type']);
    }

    public function testRegisterSpecialClass()
    {
        $data = new SpecialClass('test name', 'test type');

        $normalizer = new CallbackNormalizer(new SimpleNormalizer());
        $normalizer->register(SpecialClass::class, function (SpecialClass $item) {
            return $item->toArray();
        });

        $result = $normalizer->normalize($data);

        $this->assertSame('test name', $result['name']);
        $this->assertSame('test type', $result['type']);
    }

    public function testRegisterInterface()
    {
        $data = new SpecialClass('test name', 'test type');

        $normalizer = new CallbackNormalizer(new SimpleNormalizer());
        $normalizer->register(SpecialClassInterface::class, function (SpecialClass $item) {
            return $item->toArray();
        });

        $result = $normalizer->normalize($data);

        $this->assertSame('test name', $result['name']);
        $this->assertSame('test type', $result['type']);
    }
}
