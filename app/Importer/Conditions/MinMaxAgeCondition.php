<?php

namespace App\Importer\Conditions;

use App\Importer\Conditions\Exception\IssueWithProvidedAgeException;
use App\Importer\Conditions\Exception\UnableToDetermineAgeException;
use App\Importer\Contracts\ImportConditionInterface;
use Illuminate\Support\Carbon;

class MinMaxAgeCondition implements ImportConditionInterface
{
    /**
     * @param int $minAge
     * @param int $maxAge
     */
    public function __construct(private int $minAge = 18, private int $maxAge = 65)
    {

    }

    /**
     * @param array $data
     * @return bool
     */
    public function isPassed(array $data): bool
    {
        try {
            return $this->ageIsBetweenSpecifiedRange($this->determineAge($data));
        } catch (UnableToDetermineAgeException $e) {
            return true;
        }
    }

    /**
     * @throws UnableToDetermineAgeException
     */
    private function determineAge(array $data): int
    {
        if ( ! array_key_exists('date_of_birth', $data)) {
            throw new UnableToDetermineAgeException();
        }

        $dateOfBirth = $data['date_of_birth'];

        if (is_null($dateOfBirth)) {
            throw new UnableToDetermineAgeException();
        }

        try {
            return Carbon::parse($dateOfBirth)->diffInYears();
        } catch (\Exception $e) {
            throw new UnableToDetermineAgeException();
        }
    }

    /**
     * @param int $age
     * @return bool
     */
    protected function ageIsBetweenSpecifiedRange(int $age): bool
    {
        return $age >= $this->minAge && $age <= $this->maxAge;
    }
}
