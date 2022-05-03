<?php

namespace Deleto\Documents\Tests\Document\Russia;

use Deleto\Documents\Document\Russia\BirthCertificate;
use PHPUnit\Framework\TestCase;

class BirthCertificateTest extends TestCase
{
    public function testParseValidDatasets(): void
    {
        $inputs = [
            'VII-МЮ № 123456',
            'XV-МЮ № 123456',
            'XV-МЮ №123456',
            'XV-МЮ 123456',
            'XV-МЮ123456',
            'XVМЮ123456',
//            'XVМЮ 123456',
        ];
        $expected = [
            ['VII-МЮ', '123456'],
            ['XV-МЮ', '123456'],
            ['XV-МЮ', '123456'],
            ['XV-МЮ', '123456'],
            ['XV-МЮ', '123456'],
            ['XVМЮ', '123456'],
//            [['XVМЮ', 'XV-МЮ'], '123456'],
        ];

        foreach ($inputs as $idx => $input) {
            $birthCertificate = BirthCertificate::parse($input);
            $series = $birthCertificate->getSeries();
            $number = $birthCertificate->getNumber();
            $expectedSeries = $expected[$idx][0];
            $expectedNumber = $expected[$idx][1];

            self::assertIsString($series);
            self::assertIsString($number);
//            self::assertTrue(strlen($series) === 4);
//            self::assertTrue(strlen($number) === 6);
            self::assertEquals($expectedSeries, $series, 'Series mismatch');
            self::assertEquals($expectedNumber, $number, 'Number mismatch');
        }
    }
}
