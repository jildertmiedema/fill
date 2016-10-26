# Fill
A easy tool to fill objects.

## Usage

A helper function is provided: `mapTo()` will return a callable which can be used in the mapping.

```php
    $result = array_map(mapTo(Target::class), $data);
```

## Example

```php
use function JildertMiedema\Fill\mapTo;

class Demo
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }
}

$data = [
    ['name' => 'test name 1'],
    ['name' => 'test name 1'],
];

$result = array_map(mapTo(Demo::class), $data);

var_dump($result);
```
output:
```sh
array(2) {
  [0] =>
  class Demo#7 (1) {
    private $name =>
    string(11) "test name 1"
  }
  [1] =>
  class Demo#6 (1) {
    private $name =>
    string(11) "test name 1"
  }
}
```

## Customize
You can customize the behaviour. For example in Laravel you can
use the `CallbackNormalizer` to convert snake_cased_fields to camelCase.

In this example is shown how to implement your own `mapTo()` function:
```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JildertMiedema\Fill\Build\ReflectionBuilder;
use JildertMiedema\Fill\Fill;
use JildertMiedema\Fill\Normalizer\CallbackNormalizer;
use JildertMiedema\Fill\Normalizer\SimpleNormalizer;

function mapTo($targetClass): \Closure
{
    $normalizer = new CallbackNormalizer(new SimpleNormalizer());
    $normalizer->register(Model::class, function (Model $model) {
        $data = $model->toArray();
        $keys = array_map(function ($key) {
            return Str::camel($key);
        }, array_keys($data));
        $data = array_combine($keys, array_values($data));

        return $data;
    });
    $fill = new Fill(new ReflectionBuilder($targetClass), $normalizer);

    return $fill->map();
}

class DemoModel extends Model
{
    protected $guarded = [];
}

class Target
{
    private $name;
    private $otherValue;

    public function __construct($name, $otherValue)
    {
        $this->name = $name;
        $this->otherValue = $otherValue;
    }

    public function name()
    {
        return $this->name;
    }
}

$data = [
    new DemoModel(['name' => 'test', 'other_value' => 'value']),
];

$result = array_map(mapTo(Target::class), $data);

var_dump($result);
```