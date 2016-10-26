<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Build\Builder;
use JildertMiedema\Fill\Normalizer\Normalizer;

final class Fill
{
    /**
     * @var Builder
     */
    private $builder;
    /**
     * @var Normalizer
     */
    private $normalizer;

    public function __construct(Builder $builder, Normalizer $normalizer)
    {
        $this->builder = $builder;
        $this->normalizer = $normalizer;
    }

    public function fill($data)
    {
        $data = $this->normalizer->normalize($data);

        $target = $this->builder->build($data);

        return $target;
    }

    public function map(): \Closure
    {
        return function ($data) {
            return $this->fill($data);
        };
    }
}
