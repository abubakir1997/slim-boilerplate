# Slim/React App

Quickly start with a **Slim Framework 3 / ReactJS** skeleton for LARGE applications.

## Languages
1. Linux Ubuntu Server
2. Apache2
3. MySQL
4. PHP 7+

##Support
1. MVC Architecture
2. Multi-App Support
3. Multi-DB Support
4. Logging

##Features
1. Twig Template
2. Eloquent ORM
3. Phinx Migration
4. NPM
5. ReactJS
6. Semantic UI React
---
## Setup Dependencies
```
~/slimapp » composer install
~/slimapp » npm install
~/slimapp » vagrant up
...
...
...
~/slimapp » vagrant ssh
```

## Setup Apache
```
~/slimapp » sudo apt-get update && sudo apt-get upgrade
~/slimapp » sudo apt-get install -y apache2
~/slimapp » sudo vim /etc/apache2/apache2.conf

	vim> AllowOverride All
	vim> ServerName 127.0.0.1
	vim> ErrorLog /var/www/html/logs/error.log

~/slimapp » sudo a2enmod rewrite
~/slimapp » sudo vim /etc/apache2/sites-enabled/000-default.conf

	vim> DocumentRoot /var/www/html/public
```

## Setup PHP
```
~/slimapp » sudo add-apt-repository ppa:ondrej/php
~/slimapp » sudo apt-get update
~/slimapp » sudo apt-get install -y php7.1
~/slimapp » sudo service apache2 restart
```


## Setup MySQL
```
~/slimapp » sudo apt-get install -y mysql-server php7.1-mysql
~/slimapp » sudo vim /etc/mysql/my.cnf

	vim> bind-address = 0.0.0.0

~/slimapp » sudo service apache2 restart
~/slimapp » sudo service mysql restart
~/slimapp » mysql -u root -p

	mysql> CREATE USER 'username'@'%' IDENTIFIED BY 'password';
	mysql> GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
	mysql> FLUSH PRIVILEGES;

~/slimapp » sudo service apache2 restart
~/slimapp » sudo service mysql restart
```

## Setup User

First Run Migration
```
~/slimapp » composer migrate 20171119201335
```

Then add user with credentials (manually for now):

- username: **admin**
- password: **admin** 