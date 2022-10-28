<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\Hooks;

/**
 * This file is part of the "news_tagsuggest" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use UniversityOfCopenhagen\KuPersons\Backend\Wizard\SuggestWizardReceiver;
use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\StringUtility;

class DataHandlerHook
{

    protected DataHandler $localDataHandler;

    public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, DataHandler $parentObject): void
    {
        if ($table !== 'pages') {
            return;
        }
        if (array_key_exists('tx_kupersons_author', $fieldArray) === false) {
            return;
        }
        $value = $fieldArray['tx_kupersons_author'];

        GeneralUtility::makeInstance(ConnectionPool::class)
        ->getConnectionForTable('pages')
        ->update(
        'pages',
            [
                'tx_kupersons_author' => $value,
            ],
            [
                'uid' => $id
            ]
        );

        unset($fieldArray['tx_kupersons_author']);
    }

}