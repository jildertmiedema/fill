<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Build\Builder;

final class Fill
{
    /**
     * @var Builder
     */
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function fill($data)
    {
        if ($data instanceof \stdClass) {
            $data = (array) $data;
        }

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
