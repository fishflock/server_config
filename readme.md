## Repository Info:
This Repository represents the configuration of a LAMP stack on Ubuntu.  Apache configuration and webpages included.



### Download and Configuration:
This is meant to be installed on a fresh ubuntu installation (tested with 18.04).  Cloning the git repo as written below will not be careful about overwriting files etc. Run it at your own risk on an existing server.

1. Install git: $ sudo apt-get -y install git
2. Install the following dependencies
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

	
3. Clone this repository:
	- `$ cd /`
	- `$ git init .`
	- `$ git remote add origin git://github.com/fishflock/server_config.git`
	- `$ git fetch`
	- `$ git checkout -t origin/master -f`
4. Load Mysql schema:
	- `$ mysql`
		- `create database registration;`
		- `use registration`
		- `source schema.sql`
	This will set up the database schema, and alter the phpadmin user to use the default password configured in the PHP code (that is committed to this repo).  If you want to change this password, do so in the `<webserver_root>/registration/server.php` and `<webserver_root>/processes/processManagement.php` files, as well as in the database itself.

5. Exit the mysql prompt (Ctrl+D or exit)

6. Check that the server is running on localhost:80  
You may need to restart apache `sudo systemctl restart apache2`

7. Install Python Dependencies:
	- `$ sudo apt-get install python3-pip`
	- `$ sudo python3 -m pip install networkx matplotlib fa2 numpy`




