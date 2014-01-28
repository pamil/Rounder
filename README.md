Rounder [![Build Status](https://travis-ci.org/pamil/Rounder.png?branch=master)](https://travis-ci.org/pamil/Rounder) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/363d3fa3-5a35-427b-8844-d466370e7ce5/mini.png)](https://insight.sensiolabs.com/projects/363d3fa3-5a35-427b-8844-d466370e7ce5)
=======

Simple round utility for PHP as equivalent for `\round()` function. Provides interface and default, safe, unit-tested implementation for rounding:

 * **half up** (half towards positive infinity)
 * **half down** (half towards negative infinity)
 * **half even**
 * **half odd**
 * **half away from zero** (half towards infinity)
 * **half towards zero** (half away from infinity)
 * **up** (towards positive infinity)
 * **down** (towards negative infinity)
 * **away from zero** (towards infinity)
 * **towards zero** (away from infinity)

Unlike `round()`, where `PHP_ROUND_HALF_UP` rounding mode means rounding half away from zero and `PHP_ROUND_HALF_DOWN` means rounding half towards zero, **Rounder** provides correct implementation of these rounding modes.

Supports **PHP >= 5.3** and **HHVM**.

How to use?
-----------

 * Run `composer require "pamil/rounder:~1.0"`
 * Play with it!

```php
use Pamil\Rounder\Rounder;
use Pamil\Rounder\BasicRounder;

$rounder = new BasicRounder();

// Use new API
$rounder->roundHalfUp(12.15, 1); // 12.2
$rounder->roundHalfUp(-12.315, 2); // -12.31

// Or old round API
$rounder->round(24.5); // 25
$rounder->round(24.5, 0, Rounder::ROUND_DOWN); // 24

// You can even use old PHP_ROUND_* constants
// Warning: as mentioned above, PHP_ROUND_HALF_UP and
// PHP_ROUND_HALF_DOWN have been badly named, so they
// aren't equivalent for Rounder::ROUND_HALF_UP and
// Rounder::ROUND_HALF_DOWN. They are 100% back compatibile,
// $rounder->round() returns the same values round() will return.

$rounder->round(23.5, 0, PHP_ROUND_HALF_EVEN); // 24
$rounder->round(22.5, 0, PHP_ROUND_HALF_EVEN); // 22
```