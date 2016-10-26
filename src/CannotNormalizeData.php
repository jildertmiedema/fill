<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill;

final class CannotNormalizeData extends FillException
{

    public static function forType($data)
    {
        return new static(sprintf('Cannot normalize data for %s', gettype($data)));
    }
}
