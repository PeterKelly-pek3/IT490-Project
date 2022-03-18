All files were created and tested in git/rabbitmqphp_example/DB

You will need to install mysqli:> sudo apt install php-mysqli
Edit DBConnect file with Database VM's SQL login information
To start DBListener: ./DBServer.php

  MAIN FILES:
    - DBServer.php - Listener file for webClient.php
    - DBConnect.php - Authenticate and establish connection with database.
    - DBFunctions.php - Used to process messages received by the webserver and dmz.
    - DBRabbitMQ.ini - RabbitMQ ini file used to connect to database and webserver exchange.
    - DMZClient.php - Used to send messages to DMZServer.php
    - DMZRabbitMQ.ini - RabbitMQ ini file used to connect to database and dmz exchange.
    - getAPI.php - Used to automatically collect event data from our API. (cronjob daily).
    - getHistory.php - Used to automatically collect player historical information from our API. (cronjob daily).
    
  EMAIL PUSH NOTIFICATIONS:
    - emailPush3.php (required??)
    
  EVENT/ERROR LOGGING:
    - ErrorServer.php - Listener file for messages from other VM's.
    - errors.php - Used to push errors to other VM's.
    - ErrorRabbitMQ.ini - RabbitMQ ini file used to connect to error exchange.
    
