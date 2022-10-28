<?php

// Add faculty fields to pages table to show TCA fields definitions
    $GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['pages']['columns'],
        [
            'tx_kupersons_author' => [
                'exclude' => 1,
                'label' => 'Ansvarlig redaktør',
                'config' => [
                    'placeholder' => 'Beskrivelse',
                    'type' => 'group',
                    'allowed' => 'tt_content',
                    'prepend_tname' => false,
                    'minitems' => 0,
                    'maxitems' => 1,
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
                    ],
                ],
            ],
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_kupersons_author', '1,3,4', 'before:doktype');