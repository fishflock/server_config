# Repository Info:
This Repository represents the configuration of a LAMP stack on Ubuntu 18.04,  Apache configuration and webpages included.



# Download and Configuration:
This is meant to be installed on a fresh ubuntu installation (tested with 18.04).  Cloning the git repo as written below will not be careful about overwriting files etc. Run it at your own risk on an existing server.

1. Install the following dependencies
	- `$ sudo apt-get update`
	- `$ sudo apt-get  install apache2`
		- If the apache install asks about any configuration files, simply enter 'N' to keep the current version(s)
	- `$ sudo apt-get  install mysql-server`
	- `$ sudo apt-get install php libapache2-mod-php php-mysql`
	- `$ sudo apt-get install git`
	- `$ sudo mkdir /var/www/html/hidden/`
	- `$ sudo mkdir /var/www/html/hidden/uploads`
	- `$ sudo chown -R www-data:root /var/www/html`
	- `$ sudo chmod 775 /var/www/html`

	
2. Clone this repository on the machine:
	- `$ cd /`
	- `$ git init .`
	- `$ git remote add origin git://github.com/fishflock/server_config.git`
	- `$ git fetch`
	- `$ git checkout -t origin/master -f`
3. Load Mysql schema:
	- `$ mysql`
		- `create database registration;`
		- `use registration`
		- `source schema.sql`
	This will set up the database schema, and alter the phpadmin user to use the default password configured in the PHP code (that is committed to this repo).  If you want to change this password, do so in the `<webserver_root>/phpHelpers/db/*` files, as well as in the database itself.

4. Exit the mysql prompt (Ctrl+D or exit)

5. Check that the server is running on localhost 
You may need to restart apache `sudo systemctl restart apache2`

6. Install Python Dependencies:
	- `$ sudo apt-get install python3-pip`
	- `$ sudo python3 -m pip install networkx matplotlib fa2 numpy`

Test that the server is functional.


If you need to update the executable for GOBS and the NetworkX Python file, just drop them into the scripts folder, make sure they are executable, and have ownership permissions like `www-data:root`


# Project Directory Info:

## Other Files:

### schema.sql:
	Exported database schema for the mysql database

### /etc:
	Configuration files for apache2 and php 7.2 installations.
	When installing, you do not have to copy these installations files if know what you are doing.
	The site is using the /etc/epach2/sites-available/000-default.conf site
	



___
## Site Files in /var/www/html:
### /dependencies:
	Javascript libraries
___
### /pages:
This directory contains almost all of the folders that will be seen by users, the exceptions to this are /index.php and /registration/login and register

___
### /phpHelpers:
Includes files that define the server's behaviour

#### phpHelpers/db:
	Files that interact with the mysql database
#### phpHelpers/processes:
	File that defines a process object
#### phpHelpers/responses:
	Files that define responses to POST requests

___
### /registration:
	Front-End files that are used to login, logout, and register

___
### /index.php:
	The main page of the site, includes the file listing and 

___
### /hidden:
	A set of directories that CANNOT be accessed by users. (It is blocked in the server configuration).  It contains...
#### hidden/scripts:
	Contains the GOBS executeable 'gobs' and the Python file 'nX' used when spawning processes.
#### hidden/uploads:
	Contains subfolders, one for each user
##### hidden/uploads/\<uid>
	A folder created for each user that contains subfolders, and the files that they upload to the server
###### hidden/uploads/\<uid>/gobs_output:
	Files that are outputted by the GOBS algorithm
###### hidden/uploads/\<uid>/x_output:
	Files that are outputted by NetworkX
