To start DMZ server: ./DMZServer.php

  MAIN FILES:
    - DMZServer.php - Listener file used to process messages from the database client.
    - DMZFunctions.php - Used to process messages from the DMZServer file.
    - DMZRabbitMQ.ini - RabbitMQ ini file used to establish connection between database and dmz.
  
  EVENT/ERROR LOGGING:
    - ErrorServer.php - Listener file used to process error messages from other VM's.
    - errors.php - Used to push error messages to other VM's.
    - ErrorRabbitMQ.ini - RabbitMQ ini file used to establish connection with error exchange.
    
