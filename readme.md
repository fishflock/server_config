## Repository Info:
This Repository represents the configuration of a LAMP stack on Ubuntu.  Apache configuration and webpages included.



THIS SECTION IS NOT FINISHED
### Download and Configuration:
This is meant to be installed on a fresh ubuntu installation, and the install script will not be careful about overwriting files etc. Run it at your own risk on an existing server.

1. Install git: $ sudo apt-get -y install git
2. Change to the root user or run the following as root
	sudo su
	cd /
3. Clone this repository:
git init
git remote add origin git://github.com/fishflock/server_config.git
git fetch
git checkout -t origin/master -f	

4. Make the downloaded config.sh file executable
chmod +x config.sh
5. Run the config.sh file
./config.sh

6. If the apache install asks about a configuration file, simply enter 'N' to keep the current version
