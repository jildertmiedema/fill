<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Build;

interface Builder
{
    public function build(array $data);
}
