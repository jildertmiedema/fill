<?php

namespace JildertMiedema\Fill;

use JildertMiedema\Fill\Build\ReflectionBuilder;

function mapTo($targetClass): \Closure
{
    $fill = new Fill(new ReflectionBuilder($targetClass));

    return $fill->map();
}
