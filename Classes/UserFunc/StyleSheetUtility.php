<?php

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 3 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * StyleSheetUtility
 */
class Tx_PowermailCss_UserFunc_StyleSheetUtility
{
    private $templateFile = 'EXT:powermail_css/Resources/Private/StyleSheets/layouts.css';

    public function getCss($content, $conf)
    {
        $content = '';

        $markers = [
            '###LABEL_INDENT###' => '33.333%',
            '###LABEL_OUTDENT###' => '49.99925%',
            '###BREAKPOINT###' => 'min-width: 768px',
        ];

        if (preg_match('/([0-9\.]+)\s*(px|em|rem|%)/i', trim($conf['labelWidth']), $matches)) {
            $width = (float) $matches[1];
            $unit = $matches[2];
            if ($unit === '%') {
                $markers['###LABEL_OUTDENT###'] = (100 / (100 - $width) * $width) . '%';
            } else {
                $markers['###LABEL_OUTDENT###'] = $width . $unit;
            }
            $markers['###LABEL_INDENT###'] = $width . $unit;
        }

        if (!empty(trim($conf['breakpoint']))) {
            $markers['###BREAKPOINT###'] = trim($conf['breakpoint']);
        }

        $content .= str_replace(
            array_keys($markers),
            array_values($markers),
            @file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->templateFile))
        );
        return $content;
    }
}
