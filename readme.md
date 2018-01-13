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

## Install Virtual Box

[Install VirtualBox](https://www.virtualbox.org/wiki/Downloads). If during installation  
a failed installation appears such as this one.

![Failed Installation](/readme/failed.png "Failed Installation")

Navigate to the `System Preferences > Security & Privacy` then click the Allow Button  
as shown in the image below.

![Fix Installation](/readme/fix.jpg "Fix Installation")

## Required Software
[Install NPM and NodeJS](https://nodejs.org/en/)  
[Install Vagrant](https://www.vagrantup.com/)  


## Install Composer
```
~ » php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
~ » php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
~ » php composer-setup.php
~ » php -r "unlink('composer-setup.php');"
...
...
...
~ » mv ./composer.phar /usr/local/bin
~ » echo "export PATH="$PATH:/usr/local/bin"" >> ~/.bash_profile
~ » echo "alias composer=composer.phar" >> ~/.bash_profile
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
```

The following error may appear due to improper VirtualBox Installation:  

![Error](/readme/error.jpg "Error")

In this case go remove **Virtual Box** and reinstall it following the above instructions.

## Setup Domain

When in vim mode navigate to the bottom of the page (i.e. to the last letter) via the arrow keys.  
Then click the letter **i** after it click the key **enter | return** and insert the line  
after **vim>**.
```
~/PROJECT_NAME » sudo vim /etc/hosts 

	vim> 192.168.33.10 PROJECT_DOMAIN.test
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
To insert the admin/admin login crediential based on the provided salt in the default configuration do the following (When Prompted for password enter **root** if you stick to the default configuration):
```
~/PROJECT_NAME » vagrant ssh
~/vagrant » mysql -u DB_USER -p DB_NAME -e "INSERT INTO users (username, password) VALUES ('admin', 'ec5c5011157cfe93b4994ad2b4dde12b');"
```