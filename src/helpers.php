<?php

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Build\ReflectionBuilder;
use JildertMiedema\Fill\Normalizer\SimpleNormalizer;

function mapTo($targetClass): \Closure
{
    $fill = new Fill(new ReflectionBuilder($targetClass), new SimpleNormalizer());

    return $fill->map();
}
