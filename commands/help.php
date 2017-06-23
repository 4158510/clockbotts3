<?php

function help($arguments) {
	global $query;
	global $config;
	global $socketdata;
	$query->sendMessage(1, $socketdata['invokerid'], $config['commander']['commands']['help']['output']);
}

?> 
