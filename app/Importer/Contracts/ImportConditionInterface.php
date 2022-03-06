<?php

namespace App\Importer\Contracts;

interface ImportConditionInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function isPassed(array $data): bool;
}
