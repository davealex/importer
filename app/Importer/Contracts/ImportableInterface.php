<?php

namespace App\Importer\Contracts;

interface ImportableInterface
{
    /**
     * @return void
     */
    public function import(): void;

    /**
     * @return void
     */
    public function stopProcessing(): void;
}
