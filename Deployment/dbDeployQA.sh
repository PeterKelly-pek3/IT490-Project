#!/bin/bash

while true; do
        read -p "Update QA Database - RMQ Server [Y/y] or [N/n]? " answer

        case $answer in
                [Yy]* )
                        cp -r *.php BACKUP;
			scp -r db@172.23.40.252:/home/db/git/rabbitmqphp_example/DB/\{*.html,*.php,*.js\} .;
                        printf "\nDB - RMQ Server Updated\n";
                        break;;
                [Nn]* )
                        exit;;
        esac
done

