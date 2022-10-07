<?php

/*
 * This file is part of the package ku_persons.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    ExtensionUtility::registerPlugin(
        'ku_persons',
        'Pi1',
        'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:title',
        'ku-persons-icon'
    );


    // New fields to 'Plugin' tab
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        [
            'ku_persons_list' => [
                'exclude' => 0,
                'label' => 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:title',
                'config' => [
                    'type' => 'user',
                    // renderType needs to be registered in ext_localconf.php
                    'renderType' => 'UserList',
                    'parameters' => [
                        'size' => '30',
                        'color' => '#F49700',
                    ],
                ],
            ],
        ]
    );

    // Configure element type
    $GLOBALS['TCA']['tt_content']['types']['ku_persons'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types']['ku_persons'],
        [
        'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
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
    '
        ]
    );

    // Add new field to palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'ku_persons_list',
        'after:header'
    );
});
