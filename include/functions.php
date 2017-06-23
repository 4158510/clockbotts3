<?php

function convertinterval($interval) {
	$interval['hours'] = $interval['hours'] + $interval['days']*24;
	$interval['minutes'] = $interval['minutes'] + $interval['hours']*60;
	return $interval['seconds'] + $interval['minutes']*60;
}

function can_do($date1, $date2, $interval) {
	$time2 = strtotime($date2);
	$time1 = strtotime($date1);
	$sum = $time1 - $time2;
	if($sum >= $interval) return true;
	else  return false;
}

function isInGroup($usergroups,$group) {
	$diff = count(array_diff($usergroups, $group));
	if ($diff < count($usergroups)) return true;
	else return false;
}

?>
