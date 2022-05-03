<?php

namespace Deleto\Documents\Document\Russia;

use Deleto\Documents\Exception\Russia\MalformedBirthCertificateException;

class BirthCertificate extends AbstractDocument
{
    public static function parse(string $input): static
    {
        preg_match('/([^\s\d№]+)\D*(\d+)/i', $input, $matches);

        $series = $matches[1];
        $number = $matches[2];

        return new self($series, $number);
    }

    /**
     * @throws MalformedBirthCertificateException
     */
    public function validate(): void
    {
        if (!preg_match('/[^\d№]+/', $this->series)) {
            throw new MalformedBirthCertificateException();
        }

        if (!preg_match('/\d+/', $this->number)) {
            throw new MalformedBirthCertificateException();
        }
    }
}
