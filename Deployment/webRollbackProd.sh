#!/bin/bash

while true; do
        read -p "Rollback Production Web Server [Y/y] or [N/n]? " answer
	if [ "$(ls -A BACKUP)" ]
	then
        	case $answer in
                	[Yy]* )
                        	cp -r BACKUP/{*.html,*.php,*.js} /var/www/html;
				rm -r BACKUP/*;
                        	printf "\nWeb Server Rollback Complete\n";
                        	break;;
                	[Nn]* )
                        	exit;;
        	esac
	else
		printf "\nBackup not found. Rollback cancelled\n"
		break
	fi
done


