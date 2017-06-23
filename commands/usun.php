<?php
/***************************

Author: Artur ArrMeeR Fijalkowski

Contact: ts3-move.pl

Command: Channel

***************************/

require_once 'config/teamspeak.php';
require_once 'include/ts3admin.class.php';


function channel($arguments)
{
	global $query;
	global $config;
	global $socketdata;
	$polaczenie = @new mysqli($config['database']['ip'], $config['database']['login'], $config['database']['password'], $config['database']['name']);
}
?> 
