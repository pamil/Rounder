<?php


namespace Pamil\Rounder;


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
                throw new \InvalidArgumentException(sprintf(
                    "Rounding mode '%s' not found. Check %s::ROUND_* for available rounding modes.",
                    $roundingMode,
                    "Pamil\\Rounder\\Rounder"
                ));
        }

        return $result;
    }
} 