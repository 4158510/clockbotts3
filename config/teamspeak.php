<?php

$teamspeak['address'] = '217.182.72.133';
$teamspeak['udp'] = '9987';
$teamspeak['tcp'] = '10011';
$teamspeak['login'] = 'serveradmin';
$teamspeak['password'] = 'OuvMxHTv';

$config['database']['ip']="localhost";
$config['database']['login']="login do bazy danych";
$config['database']['password']="hasło do bazy danych ";
$config['database']['name']="nazwa bazy danych";


$config['bot']['functions'] = array('clock');					
$config['bot']['name'] = 'Aktualizator'; // nazwa bota
$config['bot']['default_channel'] = 2; // ID kanalu na ktorym bot ma siedziec 

$config['clock']['enabled'] = true;
$config['clock']['admins_groups'] = array(82);
$config['clock']['title_name'] = "[cspacer]Odliczamy do: [event_name]";
$config['clock']['channels_id'] = [81, 77, 78, 79, 80];
$config['clock']['interval'] = array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 1);
$config['clock']['data'] = '1970-01-01 00:00:00'; 

$config['commander']['name'] = 'Commander'; // nazwa bota
$config['commander']['default_channel'] = 2; // ID kanalu na ktorym bot ma siedziec 
$config['commander']['commands_list'] = array ('help','dodaj','usun','lista');
$config['commander']['commands'] = array(
	'help' => array(
		'description' => 'Wyswietla listę komend',
		'usage' => '!help',
		'output' => '
		!help - Wyswietla liste komend
		!dodaj - Dodaje nowy event
		!usun <id> - usuwa event o podanym id
		!lista - Lista wszystkich ewentów',
		'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
	),
	'dodaj' => array(
		'description' => 'Przeniosi wybrane grupy na kanal zebrania',
		'usage' => '!dodaj',
		'output' => 'Przeniesiono administracje na kanal zebrania',
		'groups' => array(2),
		'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
	),
	'usun' => array(
		'description' => 'Sprawdza kanaly',
		'usage' => '!usun',
		'output' => 'Sprawdzono kanaly',
		'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
	),
	'lista' => array(
		'description' => 'Tworzy kanał prywatny',
		'usage' => '!lista',
		'output' => 'Kanał prywatny został stworzony!',
		'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
	),
);
	
	
?>
