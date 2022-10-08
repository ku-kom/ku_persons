<?php

/*
 * This file is part of the package ku_persons.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['ku_persons'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['ku_persons'] = [];
}

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:title',
        'ku_persons',
        'ku-persons-icon'
    ],
    'special',
    'after'
);

// Suggest options
$GLOBALS['TCA']['tx_kupersons']['columns']['ku_persons_list_search']['config']['type'] = 'group';
$GLOBALS['TCA']['tx_kupersons']['columns']['ku_persons_list_search']['config']['allowed'] = 'ku_persons_list_search';
unset($GLOBALS['TCA']['tx_kupersons']['columns']['ku_persons_list_search']['config']['renderType']);

$GLOBALS['TCA']['tx_kupersons']['columns']['ku_persons_list_search']['config']['suggestOptions'] = [
    'default' => [
        'minimumCharacters' => 2,
        'maxItemsInResultList' => 100,
        'searchWholePhrase' => true,
        'receiverClass' => \UniversityOfCopenhagen\KuPersons\Classes\Backend\Wizard\SuggestWizardReceiver::class
    ],
];