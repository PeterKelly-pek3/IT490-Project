# IT490-Project
**Systems Integration Group Project**

**League of Legends Fantasy Gambling League**

Garret Brophy
Daniel Constancia
Tristan Gibson
Peter Kelly

FrontEnd - Contains all files required for the Web Server.
DB - Contains all files required for the Database.
DMZ - Contains all files required for the DMZ - API.
RMQ -  Contains all files required for RMQ.

/etc/hosts, /etc/apache2/apache2.conf, and /etc/apache2/sites-available/000-test.conf are from PK testserver as a template and example.


1. Start RabbitMQ Management Console. Make sure exchanges are up and running. Check for acks, nacks, rejects; purge. Restart if queues are unresponsive.
2. ./ErrorServer.php : to start Error Listener on each machine.
3. crontab -e : edit cronjob (remove comments) and save to start cronjobs once ALL 4 VMs have started ErrorServer.php.
4. ./DBServer.php : to start Database Listener on Database machine.
5. ./DMZServer.php : to start DMZ - API Listener on DMZ machine.
6. Open www.testpk.com on WebServer VM.
7. Login/Register

8. Failure to follow the correct order will cause Apollo 13 to crash and burn.
