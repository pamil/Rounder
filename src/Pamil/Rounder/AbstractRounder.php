<?php


namespace Pamil\Rounder;

use Pamil\Rounder\Exception\RoundingModeNotFoundException;


/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
abstract class AbstractRounder implements Rounder
{
    /**
     * {@inheritdoc}
     */
    public function round($number, $precision = 0, $roundingMode = self::ROUND_HALF_UP)
    {
        switch ($roundingMode) {
            case self::ROUND_HALF_UP:
                $result = $this->roundHalfUp($number, $precision);
                break;
            case self::ROUND_HALF_DOWN:
                $result = $this->roundHalfDown($number, $precision);
                break;
            case self::ROUND_HALF_EVEN:
                $result = $this->roundHalfEven($number, $precision);
                break;
            case self::ROUND_HALF_ODD:
                $result = $this->roundHalfOdd($number, $precision);
                break;
            case self::ROUND_HALF_AWAY_FROM_ZERO:
                $result = $this->roundHalfAwayFromZero($number, $precision);
                break;
            case self::ROUND_HALF_TOWARDS_ZERO:
                $result = $this->roundHalfTowardsZero($number, $precision);
                break;
            case self::ROUND_UP:
                $result = $this->roundUp($number, $precision);
                break;
            case self::ROUND_DOWN:
                $result = $this->roundDown($number, $precision);
                break;
            case self::ROUND_AWAY_FROM_ZERO:
                $result = $this->roundAwayFromZero($number, $precision);
                break;
            case self::ROUND_TOWARDS_ZERO:
                $result = $this->roundTowardsZero($number, $precision);
                break;
            default:
                throw new RoundingModeNotFoundException($roundingMode);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfUp($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfDown($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfEven($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfOdd($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfAwayFromZero($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundHalfTowardsZero($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundUp($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundDown($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundAwayFromZero($number, $precision = 0);

    /**
     * {@inheritdoc}
     */
    abstract public function roundTowardsZero($number, $precision = 0);
} 