<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

class UserListElement extends AbstractFormElement
{
    public function render(): array
    {
        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];
        $color = $parameterArray['fieldConf']['config']['parameters']['color'];
        $size = $parameterArray['fieldConf']['config']['parameters']['size'];

        $fieldInformationResult = $this->renderFieldInformation();
        $fieldInformationHtml = $fieldInformationResult['html'];
        $resultArray = $this->mergeChildReturnIntoExistingResult($this->initializeResultArray(), $fieldInformationResult, false);

        $fieldId = StringUtility::getUniqueId('formengine-textarea-');

        $attributes = [
            'id' => $fieldId,
            'name' => htmlspecialchars($parameterArray['itemFormElName']),
            'size' => $size,
            'data-formengine-input-name' => htmlspecialchars($parameterArray['itemFormElName']),
            'onChange' => implode('', $parameterArray['fieldChangeFunc']),
        ];

        //$attributes['placeholder'] = 'Enter special value for user "' . htmlspecialchars(trim($row['username'])) . '" in size ' . $size;
        $classes = [
            'form-control',
            't3js-formengine-textarea',
            'formengine-textarea',
        ];
        $itemValue = $parameterArray['itemFormElValue'];
        $attributes['class'] = implode(' ', $classes);

        $html = [];
        //$html[] = '<div class="formengine-field-item t3js-formengine-field-item" style="padding: 5px; background-color: ' . $color . ';">';
        $html[] = '<div class="formengine-field-item t3js-formengine-field-item">';
        $html[] = $fieldInformationHtml;
        $html[] = '<div class="form-wizards-wrap">';
        $html[] = '<div class="form-wizards-element">';
        $html[] = '<div class="form-control-wrap">';
        $html[] = '<input type="text" value="' . htmlspecialchars($itemValue, ENT_QUOTES) . '" ';
        $html[] = GeneralUtility::implodeAttributes($attributes, true);
        $html[] = 'list="user-select-list" id="user-select"';
        $html[] = ' />';
        $html[] = '<datalist id="user-select-list">
                    <option value="Arne Petersen">
                    <option value="Jonna List">
                </datalist>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '</div>';
        $resultArray['html'] = implode(LF, $html);
        return $resultArray;
    }
}