<?php

namespace Wilgucki\PhpCsv\Converters;

use Carbon\Carbon;

class DateToCarbon implements ConverterInterface
{
    public function convert(mixed $input): Carbon
    {
        return Carbon::parse($input);
    }
}
