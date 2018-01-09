# { Slim | React } Boilerplate


## Application

![Home Page](/readme/home.png "Home Page")
![Signin Page](/readme/signin.png "Signin Page")
![Application Page](/readme/app.png "Application Page")

## Tools

1. Linux Ubuntu Server
2. Apache2
3. MySQL
4. PHP 7+

## Features

1. Twig Template
2. Eloquent ORM
3. Phinx Migration
4. NPM
5. ReactJS
7. Redux
6. Semantic UI React

## Required Software
[Install Composer](https://getcomposer.org/download/)  	
[Install NPM and NodeJS](http://blog.teamtreehouse.com/install-node-js-npm-mac)  
[Install VirtualBox](https://www.virtualbox.org/wiki/Downloads)  
[Install Vagrant](https://www.vagrantup.com/)  

---
## Cloning Boilerplate

Replace PROJECT_NAME with your desired project name.
```
~ » git clone git://github.com/abubakir1997/slim-boilerplate.git PROJECT_NAME
```

## Setup Dependencies
```
~ » cd ~/PROJECT_NAME
```
```
~/PROJECT_NAME » composer install
~/PROJECT_NAME » composer dump-autoload --optimize
~/PROJECT_NAME » cd npm/
~/PROJECT_NAME » npm install
```

## Setup Vagrant

First go into ```~/PROJECT_NAME/Vagrant.sh``` and configure your box in the configuration section on the top.

Replace PROJECT_DOMAIN with desired domain for development purposes.
```
~/PROJECT_NAME » vagrant up --provision
~/PROJECT_NAME » sudo echo '192.168.33.10 PROJECT_DOMAIN.test' >> /etc/hosts
```

## Setup User

First Run Migration
```
~/PROJECT_NAME » sudo echo 'alias phinx=vendor/bin/phinx' >> ~/.bash_profile 
~/PROJECT_NAME » phinx migrate
```

## Adding Admin User for Login

Replace DB_NAME, DB_USER, DB_PASS with your configuration.
Note: Password is based on the current salt provided in the config folder.

Username: admin
Password: admin => md5(admin+salt)
```
~/PROJECT_NAME » vagrant ssh
~/vagrant » mysql -u DB_USER -D DB_NAME -p DB_PASS -e "INSERT INTO users (username, password) VALUES ('admin', 'ec5c5011157cfe93b4994ad2b4dde12b');"
```