<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

namespace UniversityOfCopenhagen\KuPersons\UserFunctions;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\RequestFactory;


class Employees
{
    /**
     * Gets list of KU employees.
     *
     * @param array	The current config array.
     * @return array
     */
    public function getEmployees(array &$config)
    {
        $config['items'] = [
            // label, value
            ['Arne Petersen', 'Arne Petersen'],
            ['Jonna List', 'Jonna List']
        ];

        return $config;
    }
}