#!/bin/bash

while true; do
        read -p "Rollback Production DMZ Server [Y/y] or [N/n]? " answer
        if [ "$(ls -A BACKUP)" ]
        then
                case $answer in
                        [Yy]* )
                                cp -r BACKUP/*.php /home/dmz/git/rabbitmqphp_example/DMZ;
                                rm -r BACKUP/*;
                                printf "\nDMZ Server Rollback Complete\n";
                                break;;
                        [Nn]* )
                                exit;;
                esac
        else
                printf "\nBackup not found. Rollback cancelled\n"
                break
        fi
done

