<?php

namespace App\Importer\Conditions;

use App\Importer\Contracts\ImportConditionInterface;

class HasCreditCardWithConsecutiveNumberCondition implements ImportConditionInterface
{

    /**
     * @param int $noOfConsecutiveCharacters
     */
    public function __construct(private int $noOfConsecutiveCharacters = 3)
    {

    }

    /**
     * @param array $data
     * @return bool
     */
    public function isPassed(array $data): bool
    {
        $cardNumber = $data['credit_card']['number'];

        preg_match_all('!(.)\\1*!', $cardNumber, $m);

        $longestSequence =  max(array_map('strlen', $m[0]));

        return $longestSequence >= $this->noOfConsecutiveCharacters;
    }
}
