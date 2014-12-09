#!/bin/bash

sudo apt-get install -y php5-sqlite php5-mysql

sudo su vagrant
cd ~/todo && composer install
cd ~/todo && php artisan migrate