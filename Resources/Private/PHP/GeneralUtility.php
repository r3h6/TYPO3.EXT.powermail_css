<?php

class Tx_PowermailCss_GeneralUtility
{
    public function calculateWidth($content, $conf)
    {
        $content = '';
        if (preg_match('/([0-9\.]+)\s*(px|em|rem|%)/i', $conf['labelWidth'], $matches)) {
            $width = $matches[1];
            $unit = $matches[2];
            $content .= ' .powermail_horizontal .powermail_fieldwrap { padding-left: ' . $width . $unit . ' }';
            $content .= ' .powermail_horizontal .powermail_fieldwrap > .powermail_label,';
            $content .= ' .powermail_horizontal .powermail_fieldwrap > fieldset > .powermail_label {';
            if ($unit === '%') {
                $content .= ' margin-left: -' . (100 / (100 - $width) * $width) . '%;';
                $content .= ' width: ' . (100 / (100 - $width) * $width) . '%;';
            } else {
                $content .= " margin-left: -$width$unit;";
                $content .= " width: $width$unit;";
            }
            $content .= ' }';
        }
        return $content;
    }
}
