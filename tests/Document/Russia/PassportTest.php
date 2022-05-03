<?php

namespace Deleto\Documents\Tests\Document\Russia;

use Deleto\Documents\Document\Russia\Passport;
use Deleto\Documents\Exception\Russia\MalformedPassportException;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{

    public function testValidDatasets()
    {
        $inputs = [
            '1241512414',
            '1234 123456',
        ];
        $expected = [
            ['1241', '512414'],
            ['1234', '123456'],
        ];

        foreach ($inputs as $idx => $input) {
            $passport = Passport::parse($input);
            $series = $passport->getSeries();
            $number = $passport->getNumber();
            $expectedSeries = $expected[$idx][0];
            $expectedNumber = $expected[$idx][1];

            self::assertIsString($series);
            self::assertIsString($number);
            self::assertTrue(strlen($series) === 4);
            self::assertTrue(strlen($number) === 6);
            self::assertEquals($expectedSeries, $series, 'Series mismatch');
            self::assertEquals($expectedNumber, $number, 'Number mismatch');
        }
    }

    public function testInvalidDatasets()
    {
        $inputs = [
            '124151241',
            '1234 12345',
        ];

        self::expectException(MalformedPassportException::class);

        foreach ($inputs as $input) {
            $passport = Passport::parse($input);
            $passport->validate();
        }
    }

    public function testPrettify()
    {
        $inputs = [
            '1241512414',
            '1234 123456',
        ];
        $expected = [
            '1241 512414',
            '1234 123456',
        ];

        foreach ($inputs as $key => $input) {
            $passport = Passport::parse($input);

            self::assertEquals($expected[$key], $passport->getPrettified());
        }
    }
}
