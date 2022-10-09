<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\Backend\Wizard;

/**
 * This file is part of the "news_tagsuggest" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Backend\Form\Wizard\SuggestWizardDefaultReceiver;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Utility\StringUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\RequestFactory;

class SuggestWizardReceiver extends SuggestWizardDefaultReceiver
{

    public const DELIMITER = '__--__';

    public function queryTable(&$params, $recursionCounter = 0)
    {
        $searchString = strtolower($params['value']);

        // Webservive endpoint url is set in TYPO3 > Admin Tools > Settings > Extension Configuration
        $url = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ku_persons', 'uri');
        // Parameters
        $additionalOptions = [
            //'debug' => true,
            'form_params' => [
              'format' => 'json',
              'startrecord' => 0,
              'recordsperpage' => 100,
              'searchstring' => $searchString
            ]
        ];

        $response = $this->requestFactory->request($url, 'POST', $additionalOptions);

        $rows = parent::queryTable($params, $recursionCounter);

        
        $matchRow = array_filter($rows, static function ($value) use ($searchString) {
            return strtolower($value['label']) === $searchString;
        });

        if (empty($matchRow)) {
            $newUid = StringUtility::getUniqueId('NEW');
            $rows[$this->table . '_' . $newUid] = [
                'class' => '',
                'label' => $params['value'],
                'path' => '',
                'sprite' => '',
                'style' => '',
                'table' => '',
                'text' => sprintf($this->getLanguageService()->sL('LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:suggest'), $params['value']),
                'uid' => '123',
            ];
        }

        return $rows;
    }
}