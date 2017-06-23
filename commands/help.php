<?php
/***************************

Author: Artur ArrMeeR Fijalkowski

Contact: ts3-move.pl

Command: Help

***************************/

require_once 'config/teamspeak.php';
require_once 'include/ts3admin.class.php';

function help($arguments) {
global $query;
global $config;
global $socketdata;

$query->sendMessage(1, $socketdata['invokerid'], $config['commander']['commands']['help']['output']);
}

?> 
