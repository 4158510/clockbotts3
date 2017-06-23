<?php

function channel($arguments)
{
	global $query;
	global $config;
	global $socketdata;
	$polaczenie = @new mysqli($config['database']['ip'], $config['database']['login'], $config['database']['password'], $config['database']['name']);
}
?> 
