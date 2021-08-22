<h1 align="center">PHPCollection</h1>

PHPCollection provides convenient helper for working with data structures and algorithms.

Getting Started
---

Installation :

```
$ composer require hsbmaulana/phpcollection
```

How to use :

```php
require_once(__DIR__ . '/vendor/autoload.php');

use Collections\Lists\ArrayList;
use Collections\Lists\LinkedList;

$collection = new ArrayList();

$collection->add(1);
$collection->add(2);
$collection->add(3);

assert($collection->count() === 3);
```

[Replit](https://replit.com/@hsbmaulana/phpcollection)

Author
---

- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
