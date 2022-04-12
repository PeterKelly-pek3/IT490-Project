#!/bin/bash

while true; do
        read -p "Rollback QA Database - RMQ Server [Y/y] or [N/n]? " answer
        if [ "$(ls -A BACKUP)" ]
        then
                case $answer in
                        [Yy]* )
                                cp -r BACKUP/*.php /home/db/git/rabbitmqphp_example/DB;
                                rm -r BACKUP/*;
                                printf "\nDatabase - RMQ Server Rollback Complete\n";
                                break;;
                        [Nn]* )
                                exit;;
                esac
        else
                printf "\nBackup not found. Rollback cancelled\n"
                break
        fi
done

