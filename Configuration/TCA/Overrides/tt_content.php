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
            'ku_persons_list_search' => [
                'label' => 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:description',
                'config' => [
                   'type' => 'group',
                   'allowed' => 'pages, tt_content',
                   'suggestOptions' => [
                      'default' => [
                         'searchWholePhrase' => 1
                      ],
                      'pages' => [
                         'searchCondition' => 'doktype = 1'
                      ]
                   ]
                ]
             ],
        ]
    );
    
    // Add new field to palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        '--linebreak--,ku_persons_list_search,--linebreak--,ku_persons_list',
        'after:date'
    );
});
