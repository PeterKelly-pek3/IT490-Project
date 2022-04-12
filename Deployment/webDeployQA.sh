#!/bin/bash

while true; do
        read -p "Update QA Web Server [Y/y] or [N/n]? " answer

        case $answer in
                [Yy]* )
                        cp -r {*.html,*.php,*.js} BACKUP;
                        scp -r testserver@172.23.22.186:/var/www/html/\{*.html,*.php,*.js\} .;
                        printf "\nWeb Server Updated\n";
                        break;;
                [Nn]* )
                        exit;;
        esac
done
