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
    public function queryTable(&$params, $recursionCounter = 0)
    {
        $rows = [];
        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
        $url = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ku_persons', 'uri');
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
                foreach ($items as $employee) {
                    $newUid = StringUtility::getUniqueId('NEW');
                    $rows[$this->table . '_' . $newUid] = [
                        'class' => '',
                        'label' => $params['value'],
                        'path' => '',
                        'sprite' => '',
                        'style' => '',
                        'table' => $this->table,
                        'text' => '<table class="table-items">
                                        <tr>
                                            <td class="img-fluid img-employee"><img src="'. $employee['FOTOURL'] .'" alt="" class="list-item-img" /></td>
                                            <td><div class="employee-name">'.$employee['PERSON_FORNAVN'] . ' ' . $employee['PERSON_EFTERNAVN'] .'</div>'. $employee['ANSAT_UOFF_STIL_TEKST'] .'<br>'. $employee['ANSAT_ARB_EMAIL'] .'</td>
                                        </tr>
                                    </table>',
                        'uid' => 65 //$employee['ANSAT_ARB_EMAIL'],
                    ];
                }
            }
        }

        return $rows;
    }
}
