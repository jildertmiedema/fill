<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Normalizer;

interface Normalizer
{

    public function normalize($data): array;
}
