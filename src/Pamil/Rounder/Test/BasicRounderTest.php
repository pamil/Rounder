<?php

namespace Pamil\Rounder\Test;

use Pamil\Rounder\BasicRounder;
use Pamil\Rounder\RounderInterface;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BasicRounderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider invalidRoundingModeDataProvider
     * @expectedException \Pamil\Rounder\Exception\RoundingModeNotFoundException
     */
    public function roundThrowExceptionIfRoundingModeIsInvalid($invalidRoundingMode)
    {
        BasicRounder::round(6.9, 0, $invalidRoundingMode);
    }

    public function invalidRoundingModeDataProvider()
    {
        return array(
            array("invalid"),
            array(666)
        );
    }

    /**
     * @test
     * @dataProvider roundHalfUpDataProvider
     */
    public function roundHalfUp($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfUp($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_UP));
    }

    public function roundHalfUpDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.24),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.23),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfDownDataProvider
     */
    public function roundHalfDown($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfDown($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_DOWN));
    }

    public function roundHalfDownDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.23),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.24),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfEvenDataProvider
     */
    public function roundHalfEven($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfEven($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_EVEN));
        $this->assertSame($output, BasicRounder::round($input, $precision, PHP_ROUND_HALF_EVEN));
    }

    public function roundHalfEvenDataProvider()
    {
        return array(
            array(0.234, 2, 0.23),
            array(0.235, 2, 0.24),
            array(0.236, 2, 0.24),
            array(0.224, 2, 0.22),
            array(0.225, 2, 0.22),
            array(0.226, 2, 0.23),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfOddDataProvider
     */
    public function roundHalfOdd($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfOdd($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_ODD));
        $this->assertSame($output, BasicRounder::round($input, $precision, PHP_ROUND_HALF_ODD));
    }

    public function roundHalfOddDataProvider()
    {
        return array(
            array(0.234, 2, 0.23),
            array(0.235, 2, 0.23),
            array(0.236, 2, 0.24),
            array(0.224, 2, 0.22),
            array(0.225, 2, 0.23),
            array(0.226, 2, 0.23),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfAwayFromZeroDataProvider
     */
    public function roundHalfAwayFromZero($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfAwayFromZero($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_AWAY_FROM_ZERO));
        $this->assertSame($output, BasicRounder::round($input, $precision, PHP_ROUND_HALF_UP));
    }

    public function roundHalfAwayFromZeroDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.24),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.24),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfTowardsZeroDataProvider
     */
    public function roundHalfTowardsZero($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundHalfTowardsZero($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_HALF_TOWARDS_ZERO));
        $this->assertSame($output, BasicRounder::round($input, $precision, PHP_ROUND_HALF_DOWN));
    }

    public function roundHalfTowardsZeroDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.23),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.23),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundUpDataProvider
     */
    public function roundUp($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundUp($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_UP));
    }

    public function roundUpDataProvider()
    {
        return array(
            array( 0.234, 2,  0.24),
            array( 0.235, 2,  0.24),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.23),
            array(-0.236, 2, -0.23),
        );
    }

    /**
     * @test
     * @dataProvider roundDownDataProvider
     */
    public function roundDown($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundDown($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_DOWN));
    }

    public function roundDownDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.23),
            array( 0.236, 2,  0.23),
            array(-0.234, 2, -0.24),
            array(-0.235, 2, -0.24),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundAwayFromZeroDataProvider
     */
    public function roundAwayFromZero($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundAwayFromZero($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_AWAY_FROM_ZERO));
    }

    public function roundAwayFromZeroDataProvider()
    {
        return array(
            array( 0.234, 2,  0.24),
            array( 0.235, 2,  0.24),
            array( 0.236, 2,  0.24),
            array(-0.234, 2, -0.24),
            array(-0.235, 2, -0.24),
            array(-0.236, 2, -0.24),
        );
    }

    /**
     * @test
     * @dataProvider roundTowardsZeroDataProvider
     */
    public function roundTowardsZero($input, $precision, $output)
    {
        $this->assertSame($output, BasicRounder::roundTowardsZero($input, $precision));
        $this->assertSame($output, BasicRounder::round($input, $precision, RounderInterface::ROUND_TOWARDS_ZERO));
    }

    public function roundTowardsZeroDataProvider()
    {
        return array(
            array( 0.234, 2,  0.23),
            array( 0.235, 2,  0.23),
            array( 0.236, 2,  0.23),
            array(-0.234, 2, -0.23),
            array(-0.235, 2, -0.23),
            array(-0.236, 2, -0.23),
        );
    }
}
 