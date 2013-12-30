<?php

namespace Pamil\Rounder\Test;

use Pamil\Rounder\BasicRounder;
use Pamil\Rounder\Rounder;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BasicRounderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Rounder
     */
    protected $rounder;

    protected function setUp()
    {
        $this->rounder = new BasicRounder();
    }

    /**
     * @test
     * @dataProvider invalidRoundingModeDataProvider
     * @expectedException \Exception
     */
    public function roundThrowExceptionIfRoundingModeIsInvalid($invalidRoundingMode)
    {
        $this->rounder->round(6.9, 0, $invalidRoundingMode);
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
        $this->assertSame($output, $this->rounder->roundHalfUp($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_UP));
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
        $this->assertSame($output, $this->rounder->roundHalfDown($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_DOWN));
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
        $this->assertSame($output, $this->rounder->roundHalfEven($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_EVEN));
        $this->assertSame($output, $this->rounder->round($input, $precision, PHP_ROUND_HALF_EVEN));
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
        $this->assertSame($output, $this->rounder->roundHalfOdd($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_ODD));
        $this->assertSame($output, $this->rounder->round($input, $precision, PHP_ROUND_HALF_ODD));
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
        $this->assertSame($output, $this->rounder->roundHalfAwayFromZero($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_AWAY_FROM_ZERO));
        $this->assertSame($output, $this->rounder->round($input, $precision, PHP_ROUND_HALF_UP));
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
        $this->assertSame($output, $this->rounder->roundHalfTowardsZero($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_HALF_TOWARDS_ZERO));
        $this->assertSame($output, $this->rounder->round($input, $precision, PHP_ROUND_HALF_DOWN));
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
        $this->assertSame($output, $this->rounder->roundUp($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_UP));
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
        $this->assertSame($output, $this->rounder->roundDown($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_DOWN));
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
        $this->assertSame($output, $this->rounder->roundAwayFromZero($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_AWAY_FROM_ZERO));
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
        $this->assertSame($output, $this->rounder->roundTowardsZero($input, $precision));
        $this->assertSame($output, $this->rounder->round($input, $precision, Rounder::ROUND_TOWARDS_ZERO));
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
 