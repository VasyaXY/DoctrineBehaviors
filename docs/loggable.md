# Loggable

Loggable is able to track lifecycle modifications and log them using any third party log system.

## Entity

```php
<?php
 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use VasyaXY\DoctrineBehaviors\Model\Loggable\LoggableTrait;
use VasyaXY\DoctrineBehaviors\Contract\Entity\LoggableInterface;

/**
 * @ORM\Entity
 */
class Category implements LoggableInterface
{
    use LoggableTrait;
}
```

## Logger Interface

These messages are then passed to the configured logger.
You can define your own, by passing a class that implements `Psr\Log\LoggerInterface`.
