#!/bin/bash

sudo apt-get install -y php5-sqlite php5-mysql curl
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /bin/composer
sudo chown vagrant:vagrant /bin/composer

sudo su vagrant
cd /home/vagrant/todo && composer install
cd /home/vagrant/todo && php artisan migrate