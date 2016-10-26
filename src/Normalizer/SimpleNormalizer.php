<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Normalizer;

use JildertMiedema\Fill\CannotNormalizeData;

final class SimpleNormalizer implements Normalizer
{

    public function normalize($data): array
    {
        if ($data instanceof \stdClass) {
            $data = (array) $data;
        }

        if ( ! is_array($data)) {
            throw CannotNormalizeData::forType($data);
        }

        return $data;
    }
}
