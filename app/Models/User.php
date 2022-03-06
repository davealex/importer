<?php

namespace App\Models;

use App\Importer\Traits\UseDataFormatting;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use UseDataFormatting;
    /**
     *
     */
    private const EXPECTED_PROPERTIES = [
        'name',
        'address',
        'checked',
        'description',
        'interest',
        'date_of_birth',
        'email',
        'account',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = self::EXPECTED_PROPERTIES;

    /**
     * @var string[]
     */
    protected $casts = [
        'checked' => 'boolean',
        'date_of_birth' => 'date'
    ];

    /**
     * @param $value
     * @return void
     */
    public function setDateOfBirthAttribute($value): void
    {
        try {
            $this->attributes['date_of_birth'] = Carbon::parse($value)->format('Y-m-d');
        } catch (InvalidFormatException $e) {
            $this->attributes['date_of_birth'] = null;

            echo 'Invalid date provided : ';
        }
    }

    /**
     * @return HasMany
     */
    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    /**
     * @param array $data
     * @return void
     */
    public static function saveNewData(array $data): void
    {
        self::create(self::formattedData($data))
            ->creditCards()
            ->create(CreditCard::cardInfo($data['credit_card']))
        ;
    }
}
