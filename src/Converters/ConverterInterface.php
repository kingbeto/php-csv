<?php

namespace Wilgucki\PhpCsv\Converters;

interface ConverterInterface
{
    public function convert(mixed $input): mixed;
}
