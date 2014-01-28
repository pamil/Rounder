<?php

namespace Pamil\Rounder;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BasicRounder extends AbstractRounder implements Rounder
{
    /**
     * {@inheritdoc}
     */
    public function roundHalfUp($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        $multipliedNumber = $number * $multiplier;
        $multipliedNumberRoundedDown = static::roundDown($multipliedNumber);

        $numberRoundedHalfUp = $multipliedNumberRoundedDown / $multiplier;
        if (($multipliedNumber - $multipliedNumberRoundedDown) >= 0.5) {
            $numberRoundedHalfUp += (1 / $multiplier);
        }

        return $numberRoundedHalfUp;
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfDown($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        $multipliedNumber = $number * $multiplier;
        $multipliedNumberRoundedDown = static::roundDown($multipliedNumber);

        $numberRoundedHalfDown = $multipliedNumberRoundedDown / $multiplier;
        if (($multipliedNumber - $multipliedNumberRoundedDown) > 0.5) {
            $numberRoundedHalfDown += (1 / $multiplier);
        }

        return $numberRoundedHalfDown;
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfEven($number, $precision = 0)
    {
        return round($number, $precision, PHP_ROUND_HALF_EVEN);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfOdd($number, $precision = 0)
    {
        return round($number, $precision, PHP_ROUND_HALF_ODD);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfAwayFromZero($number, $precision = 0)
    {
        return round($number, $precision, PHP_ROUND_HALF_UP);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfTowardsZero($number, $precision = 0)
    {
        return round($number, $precision, PHP_ROUND_HALF_DOWN);
    }

    /**
     * {@inheritdoc}
     */
    public function roundUp($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        return ceil($number * $multiplier) / $multiplier;
    }

    /**
     * {@inheritdoc}
     */
    public function roundDown($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        return floor($number * $multiplier) / $multiplier;
    }

    /**
     * {@inheritdoc}
     */
    public function roundAwayFromZero($number, $precision = 0)
    {
        return $number > 0
            ? static::roundUp($number, $precision)
            : static::roundDown($number, $precision)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function roundTowardsZero($number, $precision = 0)
    {
        return $number > 0
            ? static::roundDown($number, $precision)
            : static::roundUp($number, $precision)
        ;
    }

    protected static function computeMultiplier($precision)
    {
        return pow(10, $precision);
    }
}