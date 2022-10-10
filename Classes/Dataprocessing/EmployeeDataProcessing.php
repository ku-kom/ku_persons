<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class EmployeeDataProcessing implements DataProcessorInterface
{
   public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
       $processedData['data']['myNewField'] = 'myValue';
       return $processedData;
    }
}