<?php

namespace Tests\Unit\Importer;

use App\Importer\Contracts\ImportConditionInterface;
use App\Importer\Factories\ImportFactory;
use Mockery\MockInterface;
use Tests\TestCase;

class ImportProcessorTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function test_it_calls_set_conditions()
    {

        $mockData = ['mock_data' => 'mock_array', 'email' => 'fake@email.org'];

        /** @var ImportConditionInterface|MockInterface $fakeCondition1 */
        $fakeCondition1 = $this->mock(ImportConditionInterface::class);
        /** @var ImportConditionInterface|MockInterface $fakeCondition2 */
        $fakeCondition2 = $this->mock(ImportConditionInterface::class);

        $fakeCondition1->expects('isPassed')->with($mockData)->andReturn(true);
        $fakeCondition2->expects('isPassed')->with($mockData)->andReturn(true);

        $importProcessor = (new ImportFactory())->initializeImporter(storage_path('challenge.json'));

        $importProcessor->addCondition($fakeCondition1);
        $importProcessor->addCondition($fakeCondition2);

        $importProcessor->passesChecks($mockData);
    }
}
