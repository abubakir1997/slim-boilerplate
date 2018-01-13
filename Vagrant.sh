#!/usr/bin/env bash

# ---------------------------
# Configurations
# ---------------------------

DB_NAME=APP
DB_USER=root
DB_PASS=root

PHP_VERSION=7.1

# ---------------------------
# Prevent Input Request
# ---------------------------

export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
locale-gen en_US.UTF-8
dpkg-reconfigure locales

# ---------------------------
# Update Package Manager
# ---------------------------
echo 'Updating Package Manager...'

sudo apt-get update && apt-get upgrade

# ---------------------------
# Apache Install and Setup
# ---------------------------
echo 'Install Apache...'

sudo apt-get install -y apache2

sudo rm -rf /var/www
sudo ln -fs /home/vagrant/www /var/www

VHOST=$(cat <<EOF
<VirtualHost *:80>
	DocumentRoot "/var/www/public"
	ServerName 127.0.0.1
	ErrorLog /var/www/logs/error.log
	<Directory "/var/www/public">
		AllowOverride All
	</Directory>
</VirtualHost>
EOF
)

sudo echo "${VHOST}" > /etc/apache2/sites-enabled/000-default.conf

SERVER_NAME=$(cat <<EOF
ServerName 127.0.0.1
EOF
)

sudo echo "${SERVER_NAME}" >> /etc/apache2/apache2.conf

sudo a2enmod rewrite
sudo service apache2 restart

# ---------------------------
# PHP Install and Setup
# ---------------------------
echo 'Install PHP...'

sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php$PHP_VERSION

# ---------------------------
# MySQL Install and Setup
# ---------------------------
echo 'Install MySQL...'

sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DB_PASS"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DB_PASS"

sudo apt-get install -y mysql-server php$PHP_VERSION-mysql

sudo sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

sudo mysql -uroot -p$DB_PASS -e "CREATE USER '$DB_USER'@'%' IDENTIFIED BY '$DB_PASS'"
sudo mysql -uroot -p$DB_PASS -e "GRANT ALL PRIVILEGES ON *.* TO '$DB_USER'@'%' WITH GRANT OPTION"
sudo mysql -uroot -p$DB_PASS -e "FLUSH PRIVILEGES"
sudo mysql -uroot -p$DB_PASS -e "CREATE DATABASE $DB_NAME"

# ---------------------------
# Restart Services
# ---------------------------
echo 'Install Restarting Services...'

sudo service apache2 restart
sudo service mysql restart

echo 'DONE! Provision is COMPLETE!'