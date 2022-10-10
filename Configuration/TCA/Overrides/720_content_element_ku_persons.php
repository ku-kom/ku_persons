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

$ll = 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:';

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        $ll . 'title',
        'ku_persons',
        'ku-persons-icon'
    ],
    'special',
    'after'
);

// New fields to 'Plugin' tab
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'ku_persons_list' => [
            'exclude' => 0,
            'label' => $ll . 'title',
            'config' => [
                'type' => 'user',
                'renderType' => 'UserList',
                'parameters' => [
                    'size' => '30',
                    'color' => '#F49700',
                ],
            ],
        ],
        'ku_persons_list_search' => [
            'label' => $ll . 'description',
            'config' => [
               'type' => 'group',
               'allowed' => 'pages, tt_content',
               'maxitems' => 100,
               'fieldControl' => [
                    'elementBrowser' => [
                        'disabled' => true,
                    ],
                ],
               'suggestOptions' => [
                    'default' => [
                        'searchWholePhrase' => true
                    ],
                    'pages' => [
                        'searchCondition' => 'doktype = 1'
                    ]
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'receiverClass' => \UniversityOfCopenhagen\KuPersons\Backend\Wizard\SuggestWizardReceiver::class
            ]
        ],
    ]
);

// Configure element type
$ku_persons = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,ku_persons_list,ku_persons_list_search,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
];

// Add fields to both cType and plugin
$GLOBALS['TCA']['tt_content']['types']['ku_persons'] = $ku_persons;
$GLOBALS['TCA']['tt_content']['types']['list'] = $ku_persons;
