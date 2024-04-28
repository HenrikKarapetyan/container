# Container

### how to use container

```php
require "../vendor/autoload.php";
use henrik\container\Container;use henrik\container\ContainerModes;

$container = new Container();

$container->set('x',new stdClass());
$container->changeMode(ContainerModes::MULTIPLE_VALUE_MODE);

var_dump($container->get('x'));
```