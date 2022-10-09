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
    $ll = 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:';

    ExtensionUtility::registerPlugin(
        'ku_persons',
        'Pi1',
        $ll . 'xlf:title',
        'ku-persons-icon'
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
    
    // Add new field to palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        '--linebreak--,ku_persons_list_search,--linebreak--,ku_persons_list',
        'after:date'
    );
});
