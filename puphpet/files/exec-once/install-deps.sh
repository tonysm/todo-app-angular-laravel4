#!/bin/bash

sudo apt-get install -y php5-sqlite php5-mysql
sudo npm install -g bower

cd ~/todo && composer install
cd ~/todo && npm install
node /home/vagrant/todo/node_modules/.bin/bower install
cd ~/todo && php artisan migrate