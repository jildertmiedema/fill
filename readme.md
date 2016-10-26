# Fill
A easy tool to fill objects.

## Usage
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
