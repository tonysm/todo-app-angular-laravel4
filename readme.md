## TODO App

This app is just an example. I used AngularJS and Laravel 4 (as a RESTful API).

## Installation steps

I'm using Vagrant and Puphpet, so just run <code>$ vagrant up</code> and you should be good to go!
I actually did a small script to run composer install and the migrations when you <em>start</em> your VM for the first
time (see <code>/puphpet/files/exec-once/install-deps.sh</code>).

However, in case it does not work, try running:

* <code>$ composer install # make sure you have composer installed</code>
* <code>$ vagrant ssh -c "cd ~/todo && php artisan migrate"</code>

After starting your VM, check the application going to: http://192.168.56.101.xip.io/ on your browser of choice.
In case you have no internet connection, make sure to place <code>192.168.56.101 192.168.56.101.xip.io</code> on your
hosts file (this will suppress the xip.io service).

Check the API documentation going to http://192.168.56.101.xip.io/docs.html. I used <em>aglio</em> to build the page.

## Development

TODO write the steps to start coding