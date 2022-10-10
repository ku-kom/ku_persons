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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

class SuggestWizardReceiver extends SuggestWizardDefaultReceiver
{

    public const DELIMITER = '__--__';

    public function queryTable(&$params, $recursionCounter = 0)
    {   
        $rows = [];
        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        $url = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ku_phonebook', 'uri');
        $query = strtolower($params['value']);
        $additionalOptions = [
            //'debug' => true,
            'form_params' => [
              'format' => 'json',
              'startrecord' => 0,
              'recordsperpage' => 100,
              'searchstring' => $query
            ]
          ];
        $response = $requestFactory->request($url, 'POST', $additionalOptions);
            // Get the content on a successful request
        if ($response->getStatusCode() === 200) {
            if (false !== strpos($response->getHeaderLine('Content-Type'), 'application/json')) {
                $string = $response->getBody()->getContents();
                // getContents() returns a string
                // Convert string back to json
                $string = iconv('ISO-8859-1', 'UTF-8', $string);
                $data = json_decode((string) $string, true);

                $items = $data['root']['employees'];
                foreach($items as $employee) {
                    $newUid = StringUtility::getUniqueId('NEW');
                    $rows[$this->table . '_' . $newUid] = [
                        'class' => '',
                        'label' => $params['value'],
                        'path' => '',
                        'sprite' => $this->iconFactory->getIconForRecord($this->table, [], Icon::SIZE_SMALL)->render(),
                        'style' => '',
                        'table' => $this->table,
                        'text' => $employee['PERSON_FORNAVN'] . $employee['PERSON_EFTERNAVN'],
                        'uid' => 63,
                    ];
                }
            }
        }

        return $rows;
    }
}