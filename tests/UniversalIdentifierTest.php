<?php declare(strict_types=1);

require_once __DIR__ . '/../src/UniversalIdentifier.php';

use PHPUnit\Framework\TestCase;

final class UniversalIdentifierTest extends TestCase
{
	private static $firstArray;
	private static $firstArrayReordered;
	private static $secondArray;
	private static $firstObject;
	private static $secondObject;
	
	public static function setUpBeforeClass(): void
    {
        self::$firstArray = [
			'foo' => 'bar',
			'sub' => [
				'foo1' => 'bar1',
				'foo2' => 'bar2',
				'subsub' => [
					'numindexval_1',
					'numindexval_2',
					'numindexval_3',
					'numindexval_4',
				],
			],
			'abc' => '123',	
			'abc2' => '345',
		];
        self::$firstArrayReordered = [
			'abc' => '123',	
			'abc2' => '345',
			'sub' => [
				'subsub' => [
					'numindexval_1',
					'numindexval_2',
					'numindexval_3',
					'numindexval_4',
				],
				'foo2' => 'bar2',
				'foo1' => 'bar1',
			],
			'foo' => 'bar',
		];
		self::$secondArray = [
			'foo' => 'bar',
			'abc' => '123',	
			'abc2' => '345',
		];

		self::$firstObject = (object)self::$firstArray;
		self::$secondObject = (object)self::$secondArray;
    }

    public function testShouldMatchForIdenticalStrings(): void
    {
        $this->assertEquals(
           universal_identifier("mystring"),
           universal_identifier("mystring"),
		   "Two identical strings should return the same identifier."
        );
    }

    public function testShouldNotMatchForDifferentStrings(): void
    {
        $this->assertNotEquals(
           universal_identifier("mystring"),
           universal_identifier("my string"),
		   "Two different strings should not return the same identifier."
        );
    }

    public function testShouldMatchForIdenticalInts(): void
    {
        $this->assertEquals(
           universal_identifier(1),
           universal_identifier(1),
		   "Two identical ints should return the same identifier."
        );
    }

    public function testShouldNotMatchForDifferentInts(): void
    {
        $this->assertNotEquals(
           universal_identifier(1),
           universal_identifier(2),
		   "Two different ints should not return the same identifier."
        );
    }

    public function testShouldMatchForIdenticalFloats(): void
    {
        $this->assertEquals(
           universal_identifier(1.0),
           universal_identifier(1.0),
		   "Two identical floats should return the same identifier."
        );
    }

    public function testShouldNotMatchForDifferentFloats(): void
    {
        $this->assertNotEquals(
           universal_identifier(1.0),
           universal_identifier(1.01),
		   "Two different floats should not return the same identifier."
        );
    }

    public function testShouldMatchForIdenticalArrays(): void
    {
        $this->assertEquals(
           universal_identifier(self::$firstArray),
		   universal_identifier(self::$firstArray),
		   "Two identical arrays should return the same identifier."
        );
    }

    public function testShouldMatchForReorderedArrays(): void
    {
        $this->assertEquals(
           universal_identifier(self::$firstArray),
		   universal_identifier(self::$firstArrayReordered),
		   "Two associative arrays with the same values in a different order should return the same identifier."
        );
    }

    public function testShouldNotMatchForDifferentArrays(): void
    {
        $this->assertNotEquals(
           universal_identifier(self::$firstArray),
		   universal_identifier(self::$secondArray),
		   "Two associative arrays with different values should return different identifiers."
        );
	}
	
    public function testShouldMatchForIdenticalObjects(): void
    {
        $this->assertEquals(
           universal_identifier(self::$firstObject),
		   universal_identifier(self::$firstObject),
		   "Two identical objects should return the same identifier."
        );
    }
	
    public function testShouldMatchForIdenticaldArrayAndObject(): void
    {
        $this->assertEquals(
           universal_identifier(self::$firstArray),
		   universal_identifier(self::$firstObject),
		   "An associative array and an object with the same values should return the same identifier."
        );
    }
	
    public function testShouldNotMatchForDifferentArrayAndObject(): void
    {
        $this->assertNotEquals(
           universal_identifier(self::$firstArray),
		   universal_identifier(self::$secondObject),
		   "An associative array and an object with different values should not return the same identifier."
        );
    }
}

echo universal_identifier(0.55) . "\n";