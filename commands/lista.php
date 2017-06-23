<?php

function lista($arguments) {//dodaj nazwa start koniec
	global $query;
	global $config;
	global $socketdata;
	$polaczenie = @new mysqli($config['database']['ip'], $config['database']['login'], $config['database']['password'], $config['database']['name']);
	if (mysqli_connect_errno() != 0){
		$query->sendMessage(1, $socketdata['invokerid'], '>> Wystąpił błąd połączenia: ' . mysqli_connect_error());
		return 0;
	}
	
	$wynik = @$polaczenie -> query("SELECT * FROM `event_clock`");
	if ($wynik === false){
		$query->sendMessage(1, $socketdata['invokerid'], '[color=red][b]Zapytanie nie zostało wykonane poprawnie![/b][/color]');
	} else {
		while(($event = $wynik->fetch_assoc())!==false) {
			$query->sendMessage(1, $socketdata['invokerid'], "");
		}
	}
	$polaczenie -> close();
	
}

?> 
