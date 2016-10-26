<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Normalizer;

final class CallbackNormalizer implements Normalizer
{
    /**
     * @var Normalizer
     */
    private $fallback;

    /**
     * @param \Closure[]
     */
    private $callbacks = [];

    public function __construct(Normalizer $fallback)
    {
        $this->fallback = $fallback;
    }

    public function normalize($data): array
    {
        if ( ! is_object($data)) {
            return $this->fallback->normalize($data);
        }

        foreach (array_keys($this->callbacks) as $interface) {
            if ($data instanceof $interface) {
                $callback = $this->callbacks[$interface];

                return $callback($data);
            }
        }

        return $this->fallback->normalize($data);
    }

    public function register(string $class, \Closure $callback)
    {
        $this->callbacks[$class] = $callback;
    }
}
