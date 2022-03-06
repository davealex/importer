<?php

namespace Tests\Unit\Importer\Conditions;

use App\Importer\Conditions\MinMaxAgeCondition;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class MinMaxAgeConditionTest extends TestCase
{
    /**
     * @return void
     */
    public function test_it_checks_min_max_age_condition()
    {
        $minAge = 18;
        $maxAge = 65;

        $age = rand($minAge, $maxAge);
        $data = [
            'date_of_birth' => Carbon::now()->subYears($age)
        ];
        $condition = new MinMaxAgeCondition($minAge, $maxAge);

        $this->assertTrue($condition->isPassed($data));
    }

    /**
     * @return void
     */
    public function test_it_fails_checks_min_max_age_condition()
    {
        $minAge = 18;
        $maxAge = 65;

        $age = rand(70, 100);
        $data = [
            'date_of_birth' => Carbon::now()->subYears($age)
        ];
        $condition = new MinMaxAgeCondition($minAge, $maxAge);

        $this->assertFalse($condition->isPassed($data));
    }

    /**
     * @return void
     */
    public function test_it_passes_min_max_age_condition_for_missing_dob()
    {
        $minAge = 18;
        $maxAge = 65;
        $data = [
        ];
        $condition = new MinMaxAgeCondition($minAge, $maxAge);

        $this->assertTrue($condition->isPassed($data));
    }

    /**
     * @return void
     */
    public function test_it_passes_min_max_age_condition_for_invalid_dates()
    {
        $minAge = 18;
        $maxAge = 65;
        $data = [
            'date_of_birth' => 'xxx'
        ];
        $condition = new MinMaxAgeCondition($minAge, $maxAge);

        $this->assertTrue($condition->isPassed($data));
    }
}
