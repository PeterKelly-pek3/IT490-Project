#!/bin/bash

while true; do
        read -p "Update Production Database - RMQ Server [Y/y] or [N/n]? " answer

        case $answer in
                [Yy]* )
                        cp -r *.php BACKUP;
                        scp -r db@172.23.63.180:/home/db/git/rabbitmqphp_example/DB/\{*.html,*.php,*.js\} .;
                        printf "\nDB - RMQ Server Updated\n";
                        break;;
                [Nn]* )
                        exit;;
        esac
done

