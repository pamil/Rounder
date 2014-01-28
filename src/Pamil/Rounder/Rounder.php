<?php

namespace Pamil\Rounder;

/**
 * Defines primary rounding mode constants (custom rounding modes >= 0x10, PHP5.3 supported {1, 2, 3, 4} [PHP_ROUND_*
 * constants]). Defines interface for different rounders, numbers can be anything, precision must be integer.
 *
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
interface Rounder
{
    /**
     * Round half up (or round half towards positive infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -24
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_up
     * @api
     */
    const ROUND_HALF_UP = 0x10;

    /**
     * Round half down (or round half towards negative infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -24, -23.6 -> -24
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_down
     * @api
     */
    const ROUND_HALF_DOWN = 0x11;

    /**
     * Round half to even.
     * Compatibile with PHP_ROUND_HALF_EVEN.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     *  22.4 ->  22,  22.5 ->  22,  22.6 ->  23
     *
     * @see round()
     * @see PHP_ROUND_HALF_EVEN
     * @link http://pl1.php.net/round Uses round() from PHP standard library
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_to_even
     * @api
     */
    const ROUND_HALF_EVEN = PHP_ROUND_HALF_EVEN;

    /**
     * Round half to odd.
     * Compatibile with PHP_ROUND_HALF_ODD.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     *  22.4 ->  22,  22.5 ->  23,  22.6 ->  23
     *
     * @see round()
     * @see PHP_ROUND_HALF_ODD
     * @link http://pl1.php.net/round Uses round() from PHP standard library
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_to_odd
     * @api
     */
    const ROUND_HALF_ODD = PHP_ROUND_HALF_ODD;

    /**
     * Round half away from zero (or round half towards infinity).
     * Compatibile with PHP_ROUND_HALF_UP.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -24, -23.6 -> -24
     *
     * @see round()
     * @see PHP_ROUND_HALF_UP
     * @link http://pl1.php.net/round Uses round() from PHP standard library
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_away_from_zero
     * @api
     */
    const ROUND_HALF_AWAY_FROM_ZERO = PHP_ROUND_HALF_UP;


    /**
     * Round half towards zero (or round half away from infinity).
     * Compatibile with PHP_ROUND_HALF_DOWN.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -24
     *
     * @see round()
     * @see PHP_ROUND_HALF_DOWN
     * @link http://pl1.php.net/round Uses round() from PHP standard library
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_towards_zero
     * @api
     */
    const ROUND_HALF_TOWARDS_ZERO = PHP_ROUND_HALF_DOWN;

    /**
     * Round up (or round towards positive infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  24,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -23
     *
     * @api
     */
    const ROUND_UP = 0x12;

    /**
     * Round down (or round towards negative infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  23
     * -23.4 -> -24, -23.5 -> -24, -23.6 -> -24
     *
     * @api
     */
    const ROUND_DOWN = 0x13;

    /**
     * Round away from zero (or round towards infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  24,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -24, -23.5 -> -24, -23.6 -> -24
     *
     * @api
     */
    const ROUND_AWAY_FROM_ZERO = 0x14;

    /**
     * Round towards zero (or round away from infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  23
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -23
     *
     * @api
     */
    const ROUND_TOWARDS_ZERO = 0x15;

    /**
     * Rounds number with given precision and rounding mode.
     *
     * @param mixed $number
     * @param int   $precision
     * @param int   $roundingMode
     *
     * @return mixed Rounded number
     */
    public function round($number, $precision = 0, $roundingMode = self::ROUND_HALF_UP);

    /**
     * Rounds half up (or rounds half towards positive infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -24
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_up
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfUp($number, $precision = 0);

    /**
     * Rounds half down (or rounds half towards negative infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -24, -23.6 -> -24
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_down
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfDown($number, $precision = 0);

    /**
     * Rounds half to even.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     *  22.4 ->  22,  22.5 ->  22,  22.6 ->  23
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_to_even
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfEven($number, $precision = 0);

    /**
     * Rounds half to odd.
     * Compatibile with PHP_ROUND_HALF_ODD.
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     *  22.4 ->  22,  22.5 ->  23,  22.6 ->  23
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_to_odd
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfOdd($number, $precision = 0);

    /**
     * Rounds half away from zero (or rounds half towards infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -24, -23.6 -> -24
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_away_from_zero
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfAwayFromZero($number, $precision = 0);

    /**
     * Round half towards zero (or round half away from infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -24
     *
     * @param mixed $number
     * @param int   $precision
     *
     * @link http://en.wikipedia.org/wiki/Rounding#Round_half_towards_zero
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundHalfTowardsZero($number, $precision = 0);

    /**
     * Rounds up (or rounds towards positive infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  24,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -23
     *
     * @param mixed $number
     * @param int $precision
     *
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundUp($number, $precision = 0);

    /**
     * Rounds down (or rounds towards negative infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  23
     * -23.4 -> -24, -23.5 -> -24, -23.6 -> -24
     *
     * @param mixed $number
     * @param int $precision
     *
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundDown($number, $precision = 0);

    /**
     * Rounds away from zero (or rounds towards infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  24,  23.5 ->  24,  23.6 ->  24
     * -23.4 -> -24, -23.5 -> -24, -23.6 -> -24
     *
     * @param mixed $number
     * @param int $precision
     *
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundAwayFromZero($number, $precision = 0);

    /**
     * Rounds towards zero (or rounds away from infinity).
     *
     * Examples (precision = 0):
     *  23.4 ->  23,  23.5 ->  23,  23.6 ->  23
     * -23.4 -> -23, -23.5 -> -23, -23.6 -> -23
     *
     * @param mixed $number
     * @param int $precision
     *
     * @api
     *
     * @return mixed Rounded number
     */
    public function roundTowardsZero($number, $precision = 0);
} 