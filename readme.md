# {Slim3  | ReactJS} Boilerplate

Quickly start with a **Slim Framework 3 / ReactJS** skeleton for LARGE applications.

## Languages

1. Linux Ubuntu Server
2. Apache2
3. MySQL
4. PHP 7+

## Support

1. MVC Architecture
2. Multi-App Support
3. Multi-DB Support
4. Logging

## Features

1. Twig Template
2. Eloquent ORM
3. Phinx Migration
4. NPM
5. ReactJS
6. Semantic UI React
7. Redux

---
## Install App
```
~ » git clone git://github.com/abubakir1997/slim-boilerplate.git slimapp
```

## Install Composer
```
~ » php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
~ » php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
~ » php composer-setup.php
~ » php -r "unlink('composer-setup.php');"
~ » sudo vim ~/.bash_profile

	# Note: Append this to your current path
	vim> export PATH=":$HOME/.composer/vendor/bin"

~ » mv composer.phar /usr/local/bin/composer
```

## Install NPM and NodeJS
[Install from Here](http://blog.teamtreehouse.com/install-node-js-npm-mac)

## Install VirtualBox
[Install from Here](https://www.virtualbox.org/wiki/Downloads)

## Install Vagrant
[Install from Here](https://www.vagrantup.com/)

## Setup Dependencies
```
~ » cd ~/slimapp
```
```
~/slimapp » composer install
...
...
...
~/slimapp » cd npm/
~/slimapp » npm install
...
...
...
~/slimapp » vagrant up
...
...
...
~/slimapp » vagrant ssh
```

## Setup Apache
```
~/vagrantbox » sudo apt-get update && sudo apt-get upgrade
~/vagrantbox » sudo apt-get install -y apache2
~/vagrantbox » sudo vim /etc/apache2/apache2.conf

	vim> AllowOverride All
	vim> ServerName 127.0.0.1
	vim> ErrorLog /var/www/html/logs/error.log

~/vagrantbox » sudo a2enmod rewrite
~/vagrantbox » sudo vim /etc/apache2/sites-enabled/000-default.conf

	vim> DocumentRoot /var/www/html/public
```

## Setup PHP
```
~/vagrantbox » sudo add-apt-repository ppa:ondrej/php
~/vagrantbox » sudo apt-get update
~/vagrantbox » sudo apt-get install -y php7.1
~/vagrantbox » sudo service apache2 restart
```


## Setup MySQL
```
~/vagrantbox » sudo apt-get install -y mysql-server php7.1-mysql
~/vagrantbox » sudo vim /etc/mysql/my.cnf

	vim> bind-address = 0.0.0.0

~/vagrantbox » sudo service apache2 restart
~/vagrantbox » sudo service mysql restart
~/vagrantbox » mysql -u root -p

	mysql> CREATE USER 'username'@'%' IDENTIFIED BY 'password';
	mysql> GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' WITH GRANT OPTION;
	mysql> FLUSH PRIVILEGES;

~/vagrantbox » sudo service apache2 restart
~/vagrantbox » sudo service mysql restart
```

## Setup User

First Run Migration
```
~/slimapp » composer migrate 20171119201335
```

Then add user with credentials **(manually for now)**:

- username: **admin**
- password: **admin** hash(7ea9cb6e82629f154c9829eb73646eff)