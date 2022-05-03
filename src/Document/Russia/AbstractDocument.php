<?php

namespace Deleto\Documents\Document\Russia;

use Deleto\Documents\Document\Contract\HasNumberInterface;
use Deleto\Documents\Document\Contract\HasSeriesInterface;
use Deleto\Documents\Document\Contract\ParsableInterface;

abstract class AbstractDocument implements HasSeriesInterface, HasNumberInterface, ParsableInterface
{
    public function __construct(
        protected string $series,
        protected string $number
    ) {
    }

    abstract public static function parse(string $input): static;

    public function getSeries(): string
    {
        return $this->series;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getPrettified(): string
    {
        return sprintf('%s %s', $this->series, $this->number);
    }

    public function __toString(): string
    {
        return $this->getPrettified();
    }
}
