All files created and tested in /var/www/html

Error logs are directed to git/rabbitmqphp_example/FrontEnd/Logs
Error reporting code is included but not completely functional

You will have to edit your configuration files for apache

A virtual host file needs to be created/edited
/etc/apache2: apache2.config

/etc/apache2/sites-available: 
/etc/apache2/sites-enabled:

    A symbolic link will need to be created to make the site available. The configuration file needs to be created/edited to point to loginRegister.html
    
    MAIN FILES:
        - loginRegister.html - Home page, contains user login/authentication and registration features.
        - profile.php - User profile page upon successful login.
        - logout.php - User logout, redirects to loginRegister.html.
        - webClient.php - Establish connection to database.
        - webCases.php - WebServer Message Types.
        - webFunctions.php - Sends Messages to the Database.
        - webScripts.js - Javascript/AJAX functions for login/authentication and registration.
        - webRabbitMQ.ini - RabbitMQ ini file to connect to database exchange.
        - rmqClient.php - Establish connection to DMZ.
        - DMZRabbitMQ.ini - RabbitMQ ini file to connect to dmz exchange.
        
    CHAT FILES:
        - Esports_Chat: all files for team and global chat.
        - utils: all files for team and global chat.
        - server.js - Create server for team and global chat.
        - package.json
        - package-lock.json
        
    EVENT/ERROR LOGGING:
        - ErrorServer.php - Listens for errors from other VM's.
        - errors.php - Sends local errors to other VM's.
        - ErrorRabbitMQ.ini - RabbitMQ ini file to connect to error exchange. (ErrorRabbitMQ2..3..4: local testing).
        
