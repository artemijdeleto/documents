<?php

namespace Deleto\Documents\Document\Contract;

interface ParsableInterface
{
    public static function parse(string $input): static;
}
