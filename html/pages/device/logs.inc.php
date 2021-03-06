<?php
/*
 * LibreNMS
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 *
 * @package    LibreNMS
 * @subpackage webui
 * @link       http://librenms.org
 * @copyright  2017 LibreNMS
 * @author     LibreNMS Contributors
*/

if (!isset($vars['section'])) {
    $vars['section'] = 'eventlog';
}

echo '<br>';
echo '<div class="panel panel-default">';
echo '<div class="panel-heading">';
echo '<strong>Logging</strong>  &#187; ';

if ($vars['section'] == 'eventlog') {
    echo '<span class="pagemenu-selected">';
}

echo generate_link('Event Log', $vars, array('section' => 'eventlog'));
if ($vars['section'] == 'eventlog') {
    echo '</span>';
}

if (isset($config['enable_syslog']) && $config['enable_syslog'] == 1) {
    echo ' | ';

    if ($vars['section'] == 'syslog') {
        echo '<span class="pagemenu-selected">';
    }

    echo generate_link('Syslog', $vars, array('section' => 'syslog'));
    if ($vars['section'] == 'syslog') {
        echo '</span>';
    }
}

if (isset($config['graylog']['server']) && isset($config['graylog']['port'])) {
    echo ' | ';
    if ($vars['section'] == 'graylog') {
        echo '<span class="pagemenu-selected">';
    }
    echo generate_link('Graylog', $vars, array('section' => 'graylog'));
    if ($vars['section'] == 'graylog') {
        echo '</span>';
    }
}

echo '</div><br>';
echo '<div style="width:99%;margin:0 auto;">';

switch ($vars['section']) {
    case 'syslog':
        include 'pages/syslog.inc.php';
        break;
    case 'eventlog':
    case 'graylog':
        include 'pages/device/logs/'.$vars['section'].'.inc.php';
        break;

    default:
        echo '</div>';
        echo report_this('Unknown section '.$vars['section']);
        break;
}

echo '</div>';
