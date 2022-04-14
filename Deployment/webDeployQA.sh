#!/bin/bash

while true; do

	read -p "(1) Update or (2) Rollback QA Web Server: " decide;
	case $decide in
		1 )
			read -p "Update QA Web Server [Y/y] or [N/n]? " answer
        		case $answer in
                		[Yy]* )
                        		rsync -a /var/www/html/ /home/testserver/BACKUP
					rsync -a testserver@172.23.22.186:/var/www/html/ /var/www/html/
					sudo service apache2 restart
					ver=$( cat version.txt )
                        		printf "\nWeb Server Updated to v"$ver"\n"
                        		break;;
                		[Nn]* )
                        		exit;;
        		esac
			;;
		2 )
			read -p "Rollback QA Web Server [Y/y] or [N/n]? " answer2
                	case $answer2 in
                        	[Yy]* )
					rsync -a /home/testserver/BACKUP/ /var/www/html/ --delete --remove-source-files
					sudo service apache2 restart
					ver=$( cat version.txt )
                                	printf "\nWeb Server Rollback to v"$ver" Complete\n"
                                	break;;
                        	[Nn]* )
                                	exit;;
                	esac
			;;
	esac
done

