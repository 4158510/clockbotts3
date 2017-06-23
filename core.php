<?php

date_default_timezone_set('Europe/Warsaw');
ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'UTF-8');

include_once 'config/teamspeak.php';
include_once 'include/ts3admin.class.php';
include_once 'include/functions.php';
include_once 'include/commander.php';

foreach (glob("functions/*.php") as $filename) include_once $filename;

foreach (glob("commands/*.php") as $filename)  include_once $filename;

$query = new ts3admin($teamspeak['address'], $teamspeak['tcp']);

if($query->getElement('success', $query->connect())) {
    $query->login($teamspeak['login'],$teamspeak['password']);
    $query->selectServer($teamspeak['udp']);
	$tsAdminSocket = $query->runtime['socket'];
	$options = getopt("i:");
    if($options['i']==1) {
		$query->setName($config['bot']['name']);
		while (true) {
			$datapetli = date('Y-m-d G:i:s');
			$core = $query->getElement('data',$query->whoAmI());
			$query->clientMove($core['client_id'],$config['bot']['default_channel']);
			
			for($i=0; $i<count($config['bot']['functions']); $i++) {
				if($config[$config['bot']['functions'][$i]]['enabled']) {
					if(can_do($datapetli, $config[$config['bot']['functions'][$i]]['data'], convertinterval($config[$config['bot']['functions'][$i]]['interval']))) {
						$funkcja = $config['bot']['functions'][$i];
						$funkcja();
						$config[$config['bot']['functions'][$i]]['data'] = $datapetli;
						break;
					}
				}
			}
			$admins = array();
		}
	}
    if($options['i']==2) {
		$query->setName($config['commander']['name']);
		while(true) {
			sendCommand("servernotifyregister event=textprivate");
			$core = $query->getElement('data',$query->whoAmI());
			$query->clientMove($core['client_id'],$config['commander']['default_channel']);

			$socketdata = getData();
			$command = $socketdata['msg'];
			$user = $socketdata['invokerid'];
			$client = $query->getElement('data', $query->clientInfo($user));
			
			$groups = explode(",", $client['client_servergroups']);
			$command_arguments = explode(" ", $command);
			echo 'Użytkownik '.$client['client_nickname'].' (clid: '.$user.') wywołał komendę: '.$command.'' . PHP_EOL;

			for($i=0; $i<count($config['commander']['commands_list']); $i++) {
				if($command_arguments[0]==$config['commander']['commands'][$config['commander']['commands_list'][$i]]['usage']) {
					for($j=0; $j<count($config['commander']['commands'][$config['commander']['commands_list'][$i]]['allowed_groups']); $j++) {
						if(isInGroup($groups, $config['commander']['commands'][$config['commander']['commands_list'][$i]]['allowed_groups'])) {
							$komenda = $config['commander']['commands_list'][$i];
							$komenda($command_arguments);
							break;
						}
					}
				}
			}
		}
	}
}

?>
