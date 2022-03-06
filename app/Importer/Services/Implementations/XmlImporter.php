<?php

namespace App\Importer\Services\Implementations;

use App\Importer\Services\FileImporter;

final class XmlImporter extends FileImporter
{
    /**
     * @var string
     */
    protected string $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return void
     */
    public function import(): void
    {
        // TODO: Implement import() method.
    }
}
