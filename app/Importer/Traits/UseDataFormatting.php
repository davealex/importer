<?php

namespace App\Importer\Traits;

use Illuminate\Support\Arr;

trait UseDataFormatting
{
    /**
     * @param array $data
     * @return array
     */
    public static function formattedData(array $data): array
    {
        return Arr::only($data, static::EXPECTED_PROPERTIES);
    }
}
