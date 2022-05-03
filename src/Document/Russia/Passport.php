<?php

namespace Deleto\Documents\Document\Russia;

use Deleto\Documents\Exception\Russia\MalformedPassportException;

class Passport extends AbstractDocument
{
    /**
     * @throws MalformedPassportException
     */
    public static function parse(string $input): static
    {
        if (!preg_match('/(\d{4})\D*(\d{6})/', $input, $matches)) {
            throw new MalformedPassportException();
        }

        $series = $matches[1];
        $number = $matches[2];

        return new self($series, $number);
    }

    /**
     * @throws MalformedPassportException
     */
    public function validate(): void
    {
        if (!preg_match('/\d{4}/', $this->series)) {
            throw new MalformedPassportException();
        }

        if (!preg_match('/\d{6}/', $this->number)) {
            throw new MalformedPassportException();
        }
    }
}
