<?php

namespace Pamil\Rounder\Test;

use Pamil\Rounder\BcmathRounder;
use Pamil\Rounder\Rounder;

/**
 * @author Kamil Kokot <kamkok512@gmail.com>
 */
class BcmathRounderTest extends \PHPUnit_Framework_TestCase
{
    protected $fullyQualifiedClassName = "Pamil\\Rounder\\BcmathRounder";

    /**
     * @test
     * @dataProvider rounderInterfaceConstantsDataProvider
     */
    public function rounderHasRounderInterfaceConstants($constantName)
    {
        $fullyQualifiedConstantName = sprintf("%s::%s", $this->fullyQualifiedClassName, $constantName);
        $this->assertTrue(defined($fullyQualifiedConstantName), "$fullyQualifiedConstantName not defined!");
    }

    public function rounderInterfaceConstantsDataProvider()
    {
        $reflection = new \ReflectionClass("Pamil\\Rounder\\RounderInterface");

        $arguments = array();
        $constantNames = array_keys($reflection->getConstants());
        foreach ($constantNames as $constantName) {
            $arguments[] = array($constantName);
        }

        return $arguments;
    }
    
    /**
     * @test
     * @dataProvider invalidRoundingModeDataProvider
     * @expectedException \Exception
     */
    public function roundThrowExceptionIfRoundingModeIsInvalid($invalidRoundingMode)
    {
        BcmathRounder::round("6.9", 0, $invalidRoundingMode);
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
        $this->assertSame($output, BcmathRounder::roundHalfUp($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_UP));
    }

    public function roundHalfUpDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.24"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.23"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfDownDataProvider
     */
    public function roundHalfDown($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundHalfDown($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_DOWN));
    }

    public function roundHalfDownDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.23"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.24"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfEvenDataProvider
     */
    public function roundHalfEven($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundHalfEven($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_EVEN));
        $this->assertSame($output, BcmathRounder::round($input, $precision, PHP_ROUND_HALF_EVEN));
    }

    public function roundHalfEvenDataProvider()
    {
        return array(
            array("0.234", 2, "0.23"),
            array("0.235", 2, "0.24"),
            array("0.236", 2, "0.24"),
            array("0.224", 2, "0.22"),
            array("0.225", 2, "0.22"),
            array("0.226", 2, "0.23"),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfOddDataProvider
     */
    public function roundHalfOdd($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundHalfOdd($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_ODD));
        $this->assertSame($output, BcmathRounder::round($input, $precision, PHP_ROUND_HALF_ODD));
    }

    public function roundHalfOddDataProvider()
    {
        return array(
            array("0.234", 2, "0.23"),
            array("0.235", 2, "0.23"),
            array("0.236", 2, "0.24"),
            array("0.224", 2, "0.22"),
            array("0.225", 2, "0.23"),
            array("0.226", 2, "0.23"),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfAwayFromZeroDataProvider
     */
    public function roundHalfAwayFromZero($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundHalfAwayFromZero($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_AWAY_FROM_ZERO));
        $this->assertSame($output, BcmathRounder::round($input, $precision, PHP_ROUND_HALF_UP));
    }

    public function roundHalfAwayFromZeroDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.24"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.24"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundHalfTowardsZeroDataProvider
     */
    public function roundHalfTowardsZero($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundHalfTowardsZero($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_HALF_TOWARDS_ZERO));
        $this->assertSame($output, BcmathRounder::round($input, $precision, PHP_ROUND_HALF_DOWN));
    }

    public function roundHalfTowardsZeroDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.23"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.23"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundUpDataProvider
     */
    public function roundUp($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundUp($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_UP));
    }

    public function roundUpDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.24"),
            array( "0.235", 2,  "0.24"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.23"),
            array("-0.236", 2, "-0.23"),
        );
    }

    /**
     * @test
     * @dataProvider roundDownDataProvider
     */
    public function roundDown($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundDown($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_DOWN));
    }

    public function roundDownDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.23"),
            array( "0.236", 2,  "0.23"),
            array("-0.234", 2, "-0.24"),
            array("-0.235", 2, "-0.24"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundAwayFromZeroDataProvider
     */
    public function roundAwayFromZero($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundAwayFromZero($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_AWAY_FROM_ZERO));
    }

    public function roundAwayFromZeroDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.24"),
            array( "0.235", 2,  "0.24"),
            array( "0.236", 2,  "0.24"),
            array("-0.234", 2, "-0.24"),
            array("-0.235", 2, "-0.24"),
            array("-0.236", 2, "-0.24"),
        );
    }

    /**
     * @test
     * @dataProvider roundTowardsZeroDataProvider
     */
    public function roundTowardsZero($input, $precision, $output)
    {
        $this->assertSame($output, BcmathRounder::roundTowardsZero($input, $precision));
        $this->assertSame($output, BcmathRounder::round($input, $precision, Rounder::ROUND_TOWARDS_ZERO));
    }

    public function roundTowardsZeroDataProvider()
    {
        return array(
            array( "0.234", 2,  "0.23"),
            array( "0.235", 2,  "0.23"),
            array( "0.236", 2,  "0.23"),
            array("-0.234", 2, "-0.23"),
            array("-0.235", 2, "-0.23"),
            array("-0.236", 2, "-0.23"),
        );
    }
}
 