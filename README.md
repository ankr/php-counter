# PHP class for counting values

This repository contains code that will help developers keeping track of counters during execution.

Contains:
 - `Counter.php` A static class for handling multiple counters
 - `Countable.php` A single counter

Some examples below, see tests for more.

# Counter.php

## Basics
```php
<?php

use ankr\Counter\Counter;

// Increment
Counter::increment('foo');
Counter::count('foo'); // 1

Counter::increment('foo', 2);
Counter::count('foo'); // 3

// Decrement
Counter::decrement('foo');
Counter::count('foo'); // 2

Counter::decrement('foo', 2);
Counter::count('foo'); // 0

// Set specific value
Counter::set('foo', 1);
Counter::set('bar', 2);

Counter::count('foo'); // 1
Counter::count('bar'); // 2

// Reset
Counter::reset('foo');
Counter::count('foo'); // 0

```

## Extras
```php
<?php

use ankr\Counter\Counter;

// Reset
Counter::set('foo', 1);
Counter::reset('foo');
Counter::count('foo'); // 0

// countAll
Counter::increment('foo');
Counter::increment('bar', 2);
Counter::countAll(); // ['foo' => 1, 'bar' => 2]

// resetAll
Counter::resetAll();
Counter::countAll(); // ['foo' => 0, 'bar' => 0]

// remove
Counter::remove('foo');
Counter::countAll(); // ['bar' => 0]

// removeAll
Counter::set('baz', 2);
Counter::removeAll();
Counter::countAll(); // []

// get
Counter::set('foo', 1);
Counter::get('foo'); // \ankr\Counter\Countable

// getAll
Counter::getAll(); // \ankr\Counter\Countable[]

```

# Countable.php
```php
<?php

use ankr\Counter\Countable;

$counter = new Countable(1, 'foo');
$counter->count(); // 1
$counter->getName(); // foo

$counter->increment();
$counter->increment(2);
$counter->count(); // 4

$counter->reset();
$conter->count(); // 0

```
