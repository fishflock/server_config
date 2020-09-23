sudo apt-get update && sudo apt-get -y upgrade
sudo apt-get --yes --force-yes install apache2
sudo apt-get --yes --force-yes install mysql-server
sudo apt-get --yes --force-yes install php libapache2-mod-php php-mysql
sudo apt-get --yes --force-yes install git
cd /
sudo git clone git@github.com:fishflock/server_config.git
sudo mkdir /var/www/html/hidden/uploads
sudo chown -R www-data:root /var/www/html
sudo chmod 775 /var/www/html
mysql -e ./schema.sql

