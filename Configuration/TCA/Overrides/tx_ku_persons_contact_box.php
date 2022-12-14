<?php

/*
 * This file is part of the package ku_persons.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') or die('Access denied.');

$contentTypeName = 'ku_persons';
$ll = 'LLL:EXT:'.$contentTypeName.'/Resources/Private/Language/locallang_be.xlf:';

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentTypeName] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types'][$contentTypeName] = [];
}

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        $ll . 'title',
        $contentTypeName,
        'ku-persons-icon'
    ],
    'special',
    'after'
);

// New fields to 'Plugin' tab
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'ku_persons_list_search' => [
            'label' => $ll . 'description',
            'config' => [
                'placeholder' => $ll . 'description',
                'type' => 'group',
                'allowed' => 'tt_content',
                'minitems' => 0,
                'maxitems' => 10,
                'fieldControl' => [
                    'elementBrowser' => [
                        'disabled' => true,
                    ],
                ],
                'suggestOptions' => [
                    'default' => [
                        'minimumCharacters' => 2,
                        'maxItemsInResultList' => 100,
                        'maxPathTitleLength' => 50,
                        'searchWholePhrase' => true,
                        'receiverClass' => \UniversityOfCopenhagen\KuPersons\Backend\Wizard\SuggestWizardReceiver::class
                    ],
                ]
            ]
        ],
    ]
);

// Configure element type
$ku_persons = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,ku_persons_list_search,
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
$GLOBALS['TCA']['tt_content']['types'][$contentTypeName] = $ku_persons;
//$GLOBALS['TCA']['tt_content']['types']['list'] = $ku_persons;

/**
 * Registers backend previewRenderer for custom content element and plugin
 */

$GLOBALS['TCA']['tt_content']['types'][$contentTypeName]['previewRenderer'] = \UniversityOfCopenhagen\KuPersons\Backend\Preview\contactBoxPreviewRenderer::class;
//$GLOBALS['TCA']['tt_content']['types']['list']['previewRenderer'] = \UniversityOfCopenhagen\KuPersons\Backend\Preview\contactBoxPreviewRenderer::class;
