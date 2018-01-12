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

```
~ » vim ~/.bash_profile
~ » export PATH="$PATH:/usr/local/bin:/usr/local/sbin:$HOME/.composer/vendor/bin"
```

---

## Before Starting

The following instructions contain variable placeholders that you could configure to your liking.   
Through out the instructions replace any ```PROJECT_*``` variable to your liking.   
To make things easier, I marked headers in the instructions with a **###** for sections that contain placeholders.   
Ex. ```PROJECT_NAME``` => ```todo_app```

## Cloning Boilerplate ###

```
~ » git clone git://github.com/abubakir1997/slim-boilerplate.git PROJECT_NAME
~ » cd ~/PROJECT_NAME
```

### Configure Files
```~/PROJECT_NAME/config/dev.php```   
```~/PROJECT_NAME/config/prod.php```   
```~/PROJECT_NAME/phinx.yml```   
```~/PROJECT_NAME/Vagrant.sh```    
```~/PROJECT_NAME/Vagrantfile```     

## Setup Composer
```
~/PROJECT_NAME » composer install
~/PROJECT_NAME » composer dump-autoload --optimize
```

## Setup NPM
```
~/PROJECT_NAME » cd npm/
~/PROJECT_NAME » npm install
~/PROJECT_NAME » npm run build
```

## Setup Vagrant ###

```
~/PROJECT_NAME » vagrant up --provision
~/PROJECT_NAME » sudo echo '192.168.33.10 PROJECT_DOMAIN.test' >> /etc/hosts
```

## Setup User

```
~/PROJECT_NAME » sudo echo 'alias phinx=vendor/bin/phinx' >> ~/.bash_profile 
~/PROJECT_NAME » phinx migrate
```

## Example Credentials ###

**Username:** admin   
**Password:** admin

The following hash will generate the **admin** password => ```md5(admin+salt)```   
To insert the admin/admin login crediential based on the provided salt in the default configuration do the following:
```
~/PROJECT_NAME » vagrant ssh
~/vagrant » mysql -u DB_USER -D DB_NAME -p DB_PASS -e "INSERT INTO users (username, password) VALUES ('admin', 'ec5c5011157cfe93b4994ad2b4dde12b');"
```