<?php

namespace Pamil\Rounder;

use Pamil\Rounder\Exception\MethodNotImplementedException;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BcmathRounder extends AbstractRounder
{
    public function __construct()
    {
        if (!function_exists('bcadd')) {
            throw new \Exception("Bcmath not found. Configure your PHP with --enable-bcmath option.");
        }

        bcscale(100);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfUp($number, $precision = 0)
    {
        $multiplier = $this->computeMultiplier($precision);

        $multipliedNumber = bcmul($number, $multiplier);
        $multipliedNumberRoundedDown = $this->roundDown($multipliedNumber);
        $difference = $this->removeTrailingArbitraryZeros(bcsub($multipliedNumber, $multipliedNumberRoundedDown));

        $numberRoundedHalfUp = bcdiv($multipliedNumberRoundedDown, $multiplier);
        if (version_compare($difference, 0.5, '>=')) {
            $numberRoundedHalfUp = bcadd($numberRoundedHalfUp, bcdiv(1, $multiplier));
        }

        return $this->removeTrailingArbitraryZeros($numberRoundedHalfUp);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfDown($number, $precision = 0)
    {
        $multiplier = $this->computeMultiplier($precision);

        $multipliedNumber = bcmul($number, $multiplier);
        $multipliedNumberRoundedDown = $this->roundDown($multipliedNumber);
        $difference = $this->removeTrailingArbitraryZeros(bcsub($multipliedNumber, $multipliedNumberRoundedDown));

        $numberRoundedHalfDown = bcdiv($multipliedNumberRoundedDown, $multiplier);
        if (version_compare($difference, 0.5, '>')) {
            $numberRoundedHalfDown = bcadd($numberRoundedHalfDown, bcdiv(1, $multiplier));
        }

        return $this->removeTrailingArbitraryZeros($numberRoundedHalfDown);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfEven($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfOdd($number, $precision = 0)
    {
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfAwayFromZero($number, $precision = 0)
    {
        return $number > 0
            ? $this->roundHalfUp($number, $precision)
            : $this->roundHalfDown($number, $precision)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function roundHalfTowardsZero($number, $precision = 0)
    {
        return $number > 0
            ? $this->roundHalfDown($number, $precision)
            : $this->roundHalfUp($number, $precision)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function roundUp($number, $precision = 0)
    {
        if (false !== ($dotPosition = strpos($number, '.'))) {
            $arbitaryAfterPrecision = substr($number, $dotPosition + 1 + $precision);
            if (
                (null !== $arbitaryAfterPrecision || '' !== $arbitaryAfterPrecision) &&
                $this->isPositive($number)
            ) {
                $number = bcadd($number, bcdiv(1, $this->computeMultiplier($precision)));
            }

            $number = $this->truncateWithPrecision($number, $precision);
        }

        return $this->removeTrailingArbitraryZeros($number);
    }

    /**
     * {@inheritdoc}
     */
    public function roundDown($number, $precision = 0)
    {
        $number = $this->truncateWithPrecision($number, $precision);

        if ($this->isNegative($number)) {
            $number = bcadd($number, bcdiv(-1, $this->computeMultiplier($precision)));
        }

        return $this->removeTrailingArbitraryZeros($number);
    }

    /**
     * {@inheritdoc}
     */
    public function roundAwayFromZero($number, $precision = 0)
    {
        return $number > 0
            ? $this->roundUp($number, $precision)
            : $this->roundDown($number, $precision)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function roundTowardsZero($number, $precision = 0)
    {
        return $number > 0
            ? $this->roundDown($number, $precision)
            : $this->roundUp($number, $precision)
            ;
    }

    protected function computeMultiplier($precision)
    {
        return pow(10, $precision);
    }

    protected function removeTrailingArbitraryZeros($number)
    {
        if (false !== strpos($number, '.')) {
            $number = rtrim(rtrim($number, '0'), '.');
        }

        return $number;
    }

    protected function truncateWithPrecision($number, $precision)
    {
        $dotPosition = strpos($number, '.') ?: 0;
        $additionalOffset = 0 !== $dotPosition ? 1 : 0;

        $number = substr($number, 0, $dotPosition + $additionalOffset + $precision);


        return $number;
    }

    protected function isNegative($number)
    {
        return '-' === substr($number, 0, 1);
    }

    protected function isPositive($number)
    {
        return '-' !== substr($number, 0, 1);
    }
}