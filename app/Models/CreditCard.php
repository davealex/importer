<?php

namespace App\Models;

use App\Importer\Traits\UseDataFormatting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory, UseDataFormatting;

    /**
     *
     */
    private const EXPECTED_PROPERTIES = [
        'type',
        'number',
        'name',
        'expiration_date'
    ];

    /**
     * @var string[]
     */
    protected $fillable = self::EXPECTED_PROPERTIES;

    /**
     * @param $creditCardData
     * @return array
     */
    private static function modifyExpirationDateKey($creditCardData): array
    {
        $creditCardData['expiration_date'] = $creditCardData['expirationDate'];
        unset($creditCardData['expirationDate']);
        return $creditCardData;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function cardInfo(array $data): array
    {
        return self::formattedData(self::modifyExpirationDateKey($data));
    }
}
