<?php
declare(strict_types=1);

/*
 * This file is part of the package ku_persons.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace UniversityOfCopenhagen\KuPersons\Backend\Preview;

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;

class contactBoxPreviewRenderer implements PreviewRendererInterface
{
    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {
        return 'Contact box';
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $employee = '';
        $record = $item->getRecord();
        if ($record['ku_persons_list_search']) {
            $employee .= htmlspecialchars($record['ku_persons_list_search']);
        }
        return $employee;
    }

    public function renderPageModulePreviewFooter(GridColumnItem $item): string
    {
        return '';
    }

    public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
    {
        $previewHeader = $previewHeader ? '<div class="content-element-preview-ctype">' . $previewHeader . '</div>' : '';
        $previewContent = $previewContent ? '<div class="content-element-preview-content">' . $previewContent . '</div>' : '';
        $preview = $previewHeader || $previewContent ? '<div class="ku-contactbox-preview">' . $previewHeader . $previewContent . '</div>' : '';
        return $preview;
    }
}
