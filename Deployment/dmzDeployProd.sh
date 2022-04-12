#!/bin/bash

while true; do
        read -p "Update Production DMZ Server [Y/y] or [N/n]? " answer

        case $answer in
                [Yy]* )
                        cp -r *.php BACKUP;
                        scp -r dmz@172.23.179.19:/home/dmz/git/rabbitmqphp_example/DMZ/\{*.html,*.php,*.js\} .;
                        printf "\nDMZ Server Updated\n";
                        break;;
                [Nn]* )
                        exit;;
        esac
done

