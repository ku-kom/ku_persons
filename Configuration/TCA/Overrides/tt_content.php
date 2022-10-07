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
           'ku_persons_contact_box' => [
              'exclude' => 0,
              'label' => 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:title',
              'description' => 'LLL:EXT:ku_persons/Resources/Private/Language/locallang_be.xlf:description',
              'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'enableMultiSelectFilterTextfield' => true,
                 'items' => [
                    ['', '']
                 ],
                 'multiSelectFilterItems' => [
                    ['', ''],
                ],
                'itemsProcFunc' => 'UniversityOfCopenhagen\KuPersons\UserFunctions\Employees->getEmployees',
              ],
           ],
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'access',
        'ku_persons_contact_box',
        'after:list_type'
    );
});
