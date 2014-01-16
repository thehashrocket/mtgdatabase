# MTG Database

MTG Database's goal is to provide a mobile friendly, social, Magic The Gathering card and deck organizer. You can see an active demo by [clicking here](http://mtgdatabase.com).

The emphasis is on providing a user with

1. A quick, efficient way of organising their cards.
2. It will perform extremely well on mobile devices.
3. Social features are a long term goal including
    a. Rating of decks
    b. other stuff?

## Immediate Goals:

1. Create setup table to allow for customization for individual websites
    a. easier for an admin to setup their own copy of the site.
2. Delete cards.
3. Delete decks.
4. Database Seeding
5. ~~Update Cards.~~

## Long term goals
1. Improve appearance.
2. Code cleanup

## Notes

MTG Database is built using the [Laravel 4 w/ Vagrant project](https://github.com/bryannielsen/Laravel4-Vagrant).

## License

MTG Database is licensed under [GNU General Public License v3 (GPL-3)](http://opensource.org/licenses/gpl-3.0.html)

This software is provided 'as-is', without any express or implied
warranty.  In no event will the authors be held liable for any damages
arising from the use of this software.

Permission is granted to anyone to use this software for any purpose,
including commercial applications, and to alter it and redistribute it
freely, subject to the following restrictions:

  1. The origin of this software must not be misrepresented; you must not
     claim that you wrote the original software. If you use this software
     in a product, an acknowledgment in the product documentation would be
     appreciated but is not required.
  2. Altered source versions must be plainly marked as such, and must not be
     misrepresented as being the original software.
  3. This notice may not be removed or altered from any source distribution.

# Laravel 4 w/ Vagrant

A basic Ubuntu 12.04 Vagrant setup with [Laravel4](http://laravel.com/docs) and PHP 5.5.
PHP 5.4 w/ Apache 2.2 is available on the php54 branch.

## Requirements

* VirtualBox - Free virtualization software [Download Virtualbox](https://www.virtualbox.org/wiki/Downloads)
* Vagrant **1.3+** - Tool for working with virtualbox images [Download Vagrant](https://www.vagrantup.com)
* Git - Source Control Management [Download Git](http://git-scm.com/downloads)

## Setup


* Clone this repository `git clone http://github.com/bryannielsen/Laravel4-Vagrant.git`
* run `vagrant up` inside the newly created directory
* (the first time you run vagrant it will need to fetch the virtual box image which is ~300mb so depending on your download speed this could take some time)
* Vagrant will then use puppet to provision the base virtual box with our LAMP stack (this could take a few minutes) also note that composer will need to fetch all of the packages defined in the app's composer.json which will add some more time to the first provisioning run
* You can verify that everything was successful by opening http://localhost:8888 in a browser

*Note: You may have to change permissions on the www/app/storage folder to 777 under the host OS* 

For example: `chmod -R 777 www/app/storage/`

## Usage

Some basic information on interacting with the vagrant box

### Port Forwards

* 8888 - Apache
* 8889 - MySQL 
* 5433 - PostgreSQL


### Default MySQL/PostgreSQL Database

* User: root
* Password: (blank)
* DB Name: database


### PHPmyAdmin

Accessible at http://localhost:8888/phpmyadmin using MySQL access credentials above.

### PHP XDebug

XDebug is included in the build but **disabled by default** because of the effect it can have on performance.  

To enable XDebug:

1. Set the variable `$use_xdebug = "1"` at the beginning of `puppet/manifests/phpbase.pp`
2. Then you will need to provision the box either with `vagrant up` or by running the command `vagrant provision` if the box is already up
3. Now you can connect to XDebug on **port 9001**

**XDebug Tools**

* [MacGDBP](http://www.bluestatic.org/software/macgdbp/) - Free, Mac OSX
* [Codebug](http://www.codebugapp.com/) - Paid, Mac OSX


_Note: All XDebug settings can be configured in the php.ini template at `puppet/modules/php/templates/php.ini.erb`_


### Vagrant

Vagrant is [very well documented](http://vagrantup.com/v1/docs/index.html) but here are a few common commands:

* `vagrant up` starts the virtual machine and provisions it
* `vagrant suspend` will essentially put the machine to 'sleep' with `vagrant resume` waking it back up
* `vagrant halt` attempts a graceful shutdown of the machine and will need to be brought back with `vagrant up`
* `vagrant ssh` gives you shell access to the virtual machine

----
##### Virtual Machine Specifications #####

* OS     - Ubuntu 12.04
* Apache - 2.4.6
* PHP    - 5.5.4
* MySQL  - 5.5.32
* PostgreSQL - 9.1
* Beanstalkd - 1.4.6
* Redis - 2.2.12
* Memcached - 1.4.13
