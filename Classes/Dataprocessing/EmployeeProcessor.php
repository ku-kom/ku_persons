<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\Dataprocessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class EmployeeProcessor implements DataProcessorInterface
{
    /**
      * Process data for the content element "My new content element"
      *
      * @param ContentObjectRenderer $cObj The data of the content element or page
      * @param array $contentObjectConfiguration The configuration of Content Object
      * @param array $processorConfiguration The configuration of this processor
      * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
      * @return array the processed data as key/value store
      */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        if (!$processorConfiguration['ku_persons_list_search']) {
            return $processedData;
        }
        $processedData['ku_persons_list_search'] = '...';

        return $processedData;
    }
}
