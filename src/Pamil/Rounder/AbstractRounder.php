<?php


namespace Pamil\Rounder;

use Pamil\Rounder\Exception\MethodNotImplementedException;
use Pamil\Rounder\Exception\RoundingModeNotFoundException;


/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
abstract class AbstractRounder
{
    /**
     * {@inheritdoc}
     */
    public static function round($number, $precision = 0, $roundingMode = RounderInterface::ROUND_HALF_UP)
    {
        switch ($roundingMode) {
            case RounderInterface::ROUND_HALF_UP:
                $result = static::roundHalfUp($number, $precision);
                break;
            case RounderInterface::ROUND_HALF_DOWN:
                $result = static::roundHalfDown($number, $precision);
                break;
            case RounderInterface::ROUND_HALF_EVEN:
                $result = static::roundHalfEven($number, $precision);
                break;
            case RounderInterface::ROUND_HALF_ODD:
                $result = static::roundHalfOdd($number, $precision);
                break;
            case RounderInterface::ROUND_HALF_AWAY_FROM_ZERO:
                $result = static::roundHalfAwayFromZero($number, $precision);
                break;
            case RounderInterface::ROUND_HALF_TOWARDS_ZERO:
                $result = static::roundHalfTowardsZero($number, $precision);
                break;
            case RounderInterface::ROUND_UP:
                $result = static::roundUp($number, $precision);
                break;
            case RounderInterface::ROUND_DOWN:
                $result = static::roundDown($number, $precision);
                break;
            case RounderInterface::ROUND_AWAY_FROM_ZERO:
                $result = static::roundAwayFromZero($number, $precision);
                break;
            case RounderInterface::ROUND_TOWARDS_ZERO:
                $result = static::roundTowardsZero($number, $precision);
                break;
            default:
                throw new RoundingModeNotFoundException($roundingMode);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfUp($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfDown($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
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
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundHalfTowardsZero($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundUp($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundDown($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundAwayFromZero($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public static function roundTowardsZero($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }
} 