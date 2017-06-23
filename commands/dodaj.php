<?php

function validateDate($date, $format = 'Y-m-d_H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function dodaj($arguments) {//dodaj nazwa start koniec
	global $query;
	global $config;
	global $socketdata;
	$polaczenie = @new mysqli($config['database']['ip'], $config['database']['login'], $config['database']['password'], $config['database']['name']);
	if(empty($arguments[3]) || !empty($arguments[4])){
		$query->sendMessage(1, $socketdata['invokerid'], 'Błędna lista parametrów. W celu dodania nowego eventu prosimy podać wszystkie potrzebne informacje:');
		$query->sendMessage(1, $socketdata['invokerid'], '1. Nazwa ewentu (Nie może zawierać spacji ani znaków specjalnych!)');
		$query->sendMessage(1, $socketdata['invokerid'], '2. Data i godzina rozpoczęcia odliczania w formacie: [b]'.date("Y-m-d_H:i:s").'[/b]');
		$query->sendMessage(1, $socketdata['invokerid'], '3. Data i godzina zakończenia odliczania w formacie: [b]'.date("Y-m-d_H:i:s").'[/b]');
		$query->sendMessage(1, $socketdata['invokerid'], '');
		$query->sendMessage(1, $socketdata['invokerid'], '[color=red][b]Przykład:[/b][/color] !dodaj Karaoke 2017-06-19_20:00:00 2017-06-21_20:00:00');
		return 0;
	}
	if (mysqli_connect_errno() != 0){
		$query->sendMessage(1, $socketdata['invokerid'], '>> Wystąpił błąd połączenia: ' . mysqli_connect_error());
		return 0;
	}
	
	if(!validateDate($arguments[2])) {
		$query->sendMessage(1, $socketdata['invokerid'], 'Błędny format daty startowej. Prosimy zachować format Y-m-d_H:i:s czyli np. [b]'.date("Y-m-d_H:i:s").'[/b]');
		return 0;
	}
	
	if(!validateDate($arguments[3])) {
		$query->sendMessage(1, $socketdata['invokerid'], 'Błędny format daty końcowej. Prosimy zachować format Y-m-d_H:i:s czyli np. [b]'.date("Y-m-d_H:i:s").'[/b]');
		return 0;
	}
	
	$wynik = @$polaczenie -> query("INSERT INTO `event_clock` (name, starttime, stoptime) VALUES ('".$arguments[1]."', '".$arguments[2]."', '".$arguments[3]."')");
	print("INSERT INTO `event_clock` (name, starttime, stoptime) VALUES ('".$arguments[1]."', '".$arguments[2]."', '".$arguments[3]."')");
	if ($wynik === false){
		$query->sendMessage(1, $socketdata['invokerid'], '[color=red][b]Zapytanie nie zostało wykonane poprawnie![/b][/color]');
	} else {
		$query->sendMessage(1, $socketdata['invokerid'], 'Pomyślnie dodano wpis');
	}
	$polaczenie -> close();
	
}

?> 
