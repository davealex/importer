<?php

namespace Tests\Unit\Importer\Conditions;

use App\Importer\Conditions\HasCreditCardWithConsecutiveNumberCondition;
use Tests\TestCase;

class HasCreditCardWithConsecutiveNumberConditionTest extends TestCase
{
    /**
     * @return void
     */
    public function test_it_can_allow_cards_with_multiple_consecutive_numbers()
    {
        $data = [
            'credit_card' => [
                'number' => '123444567890'
            ]
        ];

        $condition = new HasCreditCardWithConsecutiveNumberCondition();

        $this->assertTrue($condition->isPassed($data));
    }

    /**
     * @return void
     */
    public function test_it_can_allow_cards_with_multiple_non_consecutive_numbers()
    {
        $data = [
            'credit_card' => [
                'number' => '12344567894'
            ]
        ];

        $condition = new HasCreditCardWithConsecutiveNumberCondition();

        $this->assertFalse($condition->isPassed($data));
    }

    /**
     * @return void
     */
    public function test_it_doesnt_allow_cards_without_multiple_consecutive_numbers()
    {
        $data = [
            'credit_card' => [
                'number' => '1234567890'
            ]
        ];
        $condition = new HasCreditCardWithConsecutiveNumberCondition();

        $this->assertFalse($condition->isPassed($data));
    }
}
