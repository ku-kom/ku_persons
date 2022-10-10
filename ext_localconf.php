<?php

/*
 * This file is part of the package ku_persons.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 12) {
  ExtensionManagementUtility::addPageTSConfig('
      @import "EXT:ku_persons/Configuration/page.tsconfig"
   ');
}

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// Register plugin
ExtensionUtility::configurePlugin(
  'ku_persons',
  'Pi1',
  [\UniversityOfCopenhagen\KuPersons\Controller\PersonsController::class => 'personsSearch']
);

// KU Persons new renderType
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry']['1609888016'] = [
  'nodeName' => 'UserList',
  'priority' => 40,
  'class' => \UniversityOfCopenhagen\KuPersons\Form\Element\UserListElement::class,
];

// KU register hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['ku_persons'] = \UniversityOfCopenhagen\KuPersons\Hooks\DataHandlerHook::class;