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
require_once __DIR__ . '/vendor/autoload.php';

use Lists\{ArrayList, LinkedList};

$list = new ArrayList();

$list->add("A");
$list->add("B");
$list->add("C");
$list->add("D");
$list->add("E");

assert($collection->count() === 5);
```

[Replit](https://replit.com/@hsbmaulana/phpcollection)

Author
---

- Hasby Maulana ([@hsbmaulana](https://linkedin.com/in/hsbmaulana))
