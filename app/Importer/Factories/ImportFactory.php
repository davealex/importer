<?php

namespace App\Importer\Factories;

use App\Importer\Contracts\ImportableInterface;
use App\Importer\Services\Implementations\CsvImporter;
use App\Importer\Services\Implementations\JsonImporter;
use App\Importer\Services\Implementations\XmlImporter;

final class ImportFactory
{
    /**
     * @param string $filePath
     * @return string
     */
    private function setFileExtension(string $filePath): string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }

    /**
     * @param string $filePath
     * @return ImportableInterface
     * @throws \Exception
     */
    public function initializeImporter(string $filePath) : ImportableInterface
    {
        $extension = $this->setFileExtension($filePath);

        if ($extension === 'json') {
            return new JsonImporter($filePath);
        } elseif ($extension === 'csv') {
            return new CsvImporter($filePath);
        } elseif ($extension === 'xml') {
            return new XmlImporter($filePath);
        } else throw new \Exception("File type with .$extension extension is not currently supported.");
    }
}
