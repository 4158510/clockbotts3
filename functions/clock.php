<?php

function clock()
{
	global $query;
	global $config;
	$line1[0] = "▄▀▀▀▄";
	$line2[0] = "█───█";
	$line3[0] = "█───█";
	$line4[0] = "▀▄▄▄▀";

	$line1[1] = "─▄█";
	$line2[1] = "▀─█";
	$line3[1] = "──█";
	$line4[1] = "──█";

	$line1[2] = "▄▀▀▀▄";
	$line2[2] = "───▄▀";
	$line3[2] = "─▄▀──";
	$line4[2] = "█▄▄▄▄";

	$line1[3] = "▄▀▀▀▄";
	$line2[3] = "──▄▄█";
	$line3[3] = "────█";
	$line4[3] = "▀▄▄▄▀";

	$line1[4] = "───▄█─";
	$line2[4] = "─▄▀─█─";
	$line3[4] = "█▄▄▄█▄";
	$line4[4] = "────█─";

	$line1[5] = "█▀▀▀▀";
	$line2[5] = "█▄▄▄─";
	$line3[5] = "────█";
	$line4[5] = "▀▄▄▄▀";

	$line1[6] = "▄▀▀▀▄";
	$line2[6] = "█▄▄▄─";
	$line3[6] = "█───█";
	$line4[6] = "▀▄▄▄▀";

	$line1[7] = "▀▀▀▀█";
	$line2[7] = "────█";
	$line3[7] = "──▄▀─";
	$line4[7] = "─█───";

	$line1[8] = "▄▀▀▀▄";
	$line2[8] = "▀▄▄▄▀";
	$line3[8] = "█───█";
	$line4[8] = "▀▄▄▄▀";

	$line1[9] = "▄▀▀▀▄";
	$line2[9] = "▀▄▄▄█";
	$line3[9] = "────█";
	$line4[9] = "▀▄▄▄▀";

	$line1[10] = "─────";
	$line2[10] = "──▀──";
	$line3[10] = "──▄──";
	$line4[10] = "─────";
	
	$polaczenie = @new mysqli($config['database']['ip'], $config['database']['login'], $config['database']['password'], $config['database']['name']);
	if (mysqli_connect_errno() != 0){
		echo ' >> Wystąpił błąd połączenia: ' . mysqli_connect_error();
		exit();
	}
	$wynik = @$polaczenie -> query('SELECT * FROM `event_clock` WHERE stoptime>NOW() AND starttime<NOW() ORDER BY stoptime LIMIT 1');
	if ($wynik === false){
		echo ' >> Zapytanie nie zostało wykonane poprawnie!';
		$polaczenie -> close();
	} else {
		$event = $wynik -> fetch_assoc();
		if(empty($event)) return false;
		print_r($event);
		$roznica_sekundy = abs(strtotime($event['stoptime']) - time());
		$roznica_minuty = floor($roznica_sekundy / 60);
		$roznica_sekundy = $roznica_sekundy % 60;
		$roznica_godziny = floor($roznica_minuty / 60);
		$roznica_minuty = $roznica_minuty % 60;
		if(empty($roznica_godziny)) $czas = [$roznica_minuty,$roznica_sekundy];
		else $czas = [$roznica_godziny, $roznica_minuty];
		$channel_0 = str_replace("[event_name]", $event['name'], $config['clock']['title_name']);
		$query->channeledit($config['clock']['channels_id'][0], ['channel_name'=>$channel_0]);
		$line=[1=>"[cspacer]", 2=>"[cspacer]",3=>"[cspacer]", 4=>"[cspacer]"];
		$line[1].=$line1[floor($czas[0] / 10)].$line1[$czas[0]%10].$line1[10].$line1[floor($czas[1] / 10)].$line1[$czas[1]%10];
		$line[2].=$line2[floor($czas[0] / 10)].$line2[$czas[0]%10].$line2[10].$line2[floor($czas[1] / 10)].$line2[$czas[1]%10];
		$line[3].=$line3[floor($czas[0] / 10)].$line3[$czas[0]%10].$line3[10].$line3[floor($czas[1] / 10)].$line3[$czas[1]%10];
		$line[4].=$line4[floor($czas[0] / 10)].$line4[$czas[0]%10].$line4[10].$line4[floor($czas[1] / 10)].$line4[$czas[1]%10];
		print_r($line);
		$query->channeledit($config['clock']['channels_id'][1], ['channel_name'=>$line[1]]);
		$query->channeledit($config['clock']['channels_id'][2], ['channel_name'=>$line[2]]);
		$query->channeledit($config['clock']['channels_id'][3], ['channel_name'=>$line[3]]);
		$query->channeledit($config['clock']['channels_id'][4], ['channel_name'=>$line[4]]);
			
	}
}


