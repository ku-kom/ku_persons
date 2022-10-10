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
});
