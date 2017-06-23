#!/bin/bash
# Colors
ESC_SEQ="\x1b["
COL_RESET=$ESC_SEQ"39;49;00m"
COL_RED=$ESC_SEQ"31;01m"
COL_GREEN=$ESC_SEQ"32;01m"
COL_YELLOW=$ESC_SEQ"33;01m"
COL_BLUE=$ESC_SEQ"34;01m"
COL_MAGENTA=$ESC_SEQ"35;01m"
COL_CYAN=$ESC_SEQ"36;01m"

if [[ $1 == 'stop' ]]; then 
        echo stop >> ./tmp/log.txt
	date >> ./tmp/log.txt
        screen -S bot -X quit
        screen -S commander -X quit
		sleep 1
		echo -e "Bot: $COL_RED wylaczony! $COL_RESET"
elif [[ $1 == 'start' ]]; then
	sleep 1
	echo start >> ./tmp/log.txt
	date >> ./tmp/log.txt
        screen -dmS bot php core.php -i 1
		screen -dmS commander php core.php -i 2
		ps ax | grep -v grep | grep -v -i SCREEN | grep links >> ./tmp/log.txt	
		echo -e "Bot: $COL_GREEN wlaczony! $COL_RESET"
else
	echo -e "$COL_GREEN Użyj: ${0} {start/stop} $COL_RESET"
 fi
