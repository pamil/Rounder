<?php

namespace Pamil\Rounder;

use Pamil\Rounder\Exception\MethodNotImplementedException;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BcmathRounder extends AbstractRounder
{
    /**
     * {@inheritdoc}
     */
    public static function roundHalfUp($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        $multipliedNumber = bcmul($number, $multiplier);
        $multipliedNumberRoundedDown = static::roundDown($multipliedNumber);
        $difference = static::removeTrailingArbitraryZeros(bcsub($multipliedNumber, $multipliedNumberRoundedDown));

        $numberRoundedHalfUp = bcdiv($multipliedNumberRoundedDown, $multiplier);
        if (version_compare($difference, 0.5, '>=')) {
            $numberRoundedHalfUp = bcadd($numberRoundedHalfUp, bcdiv(1, $multiplier));
        }

        return static::removeTrailingArbitraryZeros($numberRoundedHalfUp);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfDown($number, $precision = 0)
    {
        $multiplier = static::computeMultiplier($precision);

        $multipliedNumber = bcmul($number, $multiplier);
        $multipliedNumberRoundedDown = static::roundDown($multipliedNumber);
        $difference = static::removeTrailingArbitraryZeros(bcsub($multipliedNumber, $multipliedNumberRoundedDown));

        $numberRoundedHalfDown = bcdiv($multipliedNumberRoundedDown, $multiplier);
        if (version_compare($difference, 0.5, '>')) {
            $numberRoundedHalfDown = bcadd($numberRoundedHalfDown, bcdiv(1, $multiplier));
        }

        return static::removeTrailingArbitraryZeros($numberRoundedHalfDown);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfEven($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfOdd($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfAwayFromZero($number, $precision = 0)
    {
        return $number > 0
            ? static::roundHalfUp($number, $precision)
            : static::roundHalfDown($number, $precision)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfTowardsZero($number, $precision = 0)
    {
        return $number > 0
            ? static::roundHalfDown($number, $precision)
            : static::roundHalfUp($number, $precision)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public static function roundUp($number, $precision = 0)
    {
        if (false !== ($dotPosition = strpos($number, '.'))) {
            $arbitaryAfterPrecision = substr($number, $dotPosition + 1 + $precision);
            if (
                (null !== $arbitaryAfterPrecision || '' !== $arbitaryAfterPrecision) &&
                static::isPositive($number)
            ) {
                $number = bcadd($number, bcdiv(1, static::computeMultiplier($precision)));
            }

            $number = static::truncateWithPrecision($number, $precision);
        }

        return static::removeTrailingArbitraryZeros($number);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundDown($number, $precision = 0)
    {
        $number = static::truncateWithPrecision($number, $precision);

        if (static::isNegative($number)) {
            $number = bcadd($number, bcdiv(-1, static::computeMultiplier($precision)));
        }

        return static::removeTrailingArbitraryZeros($number);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundAwayFromZero($number, $precision = 0)
    {
        return $number > 0
            ? static::roundUp($number, $precision)
            : static::roundDown($number, $precision)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public static function roundTowardsZero($number, $precision = 0)
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

    protected static function removeTrailingArbitraryZeros($number)
    {
        if (false !== strpos($number, '.')) {
            $number = rtrim(rtrim($number, '0'), '.');
        }

        return $number;
    }

    protected static function truncateWithPrecision($number, $precision)
    {
        $dotPosition = strpos($number, '.') ?: 0;
        $additionalOffset = 0 !== $dotPosition ? 1 : 0;

        $number = substr($number, 0, $dotPosition + $additionalOffset + $precision);


        return $number;
    }

    protected static function isNegative($number)
    {
        return '-' === substr($number, 0, 1);
    }

    protected static function isPositive($number)
    {
        return '-' !== substr($number, 0, 1);
    }
}