<?php
$teamspeak = [
	'address'=>'127.0.0.1',
	'udp'=>9987,
	'tcp'=>10011,
	'login'=>'serveradmin',
	'password'=>'yourpassword'
];

$config=[
	'database'=>[
		'ip'=>'127.0.0.1',
		'login'=>'login to database',
		'password'=>'password to database',
		'name'=>'database name'
		],
	'bot'=>[
		'functions'=>[
			'clock'
		],
		'name'=>'Updater',
		'default_channel'=>2,
	],
	'clock'=>[
		'enabled'=>true,
		'admins_groups'=>[2],
		'title_name'=> "[cspacer]Waiting for [event_name]",
		'channels_id'=>[1,2,3,4,5],
		'interval'=>[
			'days' => 0,
			'hours' => 0,
			'minutes' => 0,
			'seconds' => 1
		],
		'data'=>'1970-01-01 00:00:00'
	],
	'commander'=>[
		'name'=>"Commander",
		'default_channel'=>2,
		'commands_list'=>['help', 'dodaj', 'usun', 'lista'],
		'commands'=>[
			'help' => [
				'description' => 'Wyswietla listę komend',
				'usage' => '!help',
				'output' => '
				!help - Wyswietla liste komend
				!dodaj - Dodaje nowy event
				!usun <id> - usuwa event o podanym id
				!lista - Lista wszystkich ewentów',
				'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
			],
			'dodaj' => [
				'description' => 'Przeniosi wybrane grupy na kanal zebrania',
				'usage' => '!dodaj',
				'output' => 'Przeniesiono administracje na kanal zebrania',
				'groups' => array(2),
				'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
			],
			'usun' => [
				'description' => 'Sprawdza kanaly',
				'usage' => '!usun',
				'output' => 'Sprawdzono kanaly',
				'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
			],
			'lista' => [
				'description' => 'Tworzy kanał prywatny',
				'usage' => '!lista',
				'output' => 'Kanał prywatny został stworzony!',
				'allowed_groups' => array(2) //Grupy, które mogą korzystać z komendy
			]
		]
	]
]
?>