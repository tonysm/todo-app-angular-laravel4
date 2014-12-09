#!/bin/bash

sudo apt-get install -y php5-sqlite php5-mysql
sudo npm install -g bower
cd ~/todo
composer install
npm install
bower install
php artisan migrate