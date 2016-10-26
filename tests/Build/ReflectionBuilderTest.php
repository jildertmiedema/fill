<?php

namespace JildertMiedema\Fill\Build;

use JildertMiedema\Fill\Fakes\AbstractClass;
use JildertMiedema\Fill\Fakes\PrivatePropertyTarget;
use JildertMiedema\Fill\Fakes\PublicPropertyTarget;

class ReflectionBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testFromArrayToPublicProperties()
    {
        $data = [
            'name' => 'test name',
            'type' => 'test type',
            'extra' => 'extra',
        ];
        $builder = new ReflectionBuilder(PublicPropertyTarget::class);
        $result = $builder->build($data);

        $this->assertInstanceOf(PublicPropertyTarget::class, $result);
        $this->assertSame('test name', $result->name);
        $this->assertSame('test type', $result->type);
        $this->assertFalse(isset($result->extra));
    }


    public function testFromArrayToPrivateProperties()
    {
        $data = [
            'name' => 'test name',
            'type' => 'test type',
            'extra' => 'extra',
        ];
        $builder = new ReflectionBuilder(PrivatePropertyTarget::class);
        $result = $builder->build($data);

        $this->assertInstanceOf(PrivatePropertyTarget::class, $result);
        $this->assertSame('test name', $result->name());
        $this->assertSame('test type', $result->type());
        $this->assertFalse(isset($result->extra));
    }

    /**
     * @expectedException \JildertMiedema\Fill\TargetClassIsNotInstantiable
     */
    public function testErrorOnAbstractClass()
    {
        $data = [];
        $builder = new ReflectionBuilder(AbstractClass::class);
        $builder->build($data);
    }
}
