# Backoff

Backoff is a PHP/MySQL application for generating web site administration interfaces.

It makes it simple for developers to implement beautiful and elegant interfaces with very little effort while providing clients an easy to use interface to manage their website.


## Installation

**Download**

* GIT : *git clone https://github.com/yanbab/backoff.git*

* Zip archive : *[master.zip](https://github.com/mloughran/em-hiredis)*

**Requirement**

* PHP 4+ 
* MySQL

**Setup**

* Extract folder somewhere in your web server
* change database settings in [config.php](https://github.com/yanbab/backoff/blob/master/config.php)
* Create a database, via phpmyadmin or command line (mysql> CREATE DATABASE backoff)
* Fil database with [backend/config/config.sql](https://github.com/yanbab/backoff/blob/master/backend/config/config.schema.yml)
* for URL rewrinting :
	* rename backend/sample.htaccess to backend/.htaccess 
	* rename frontend/sample.htaccess to frontend/.htaccess

**Notes**

* "php short tags" should be enabled (via .htaccess or php.ini)

## Using backend

## Customize backend

You can customize every aspect of the backend via a simple [YAML](http://fr.wikipedia.org/wiki/YAML) config file : [backend/config/schema.yml](https://github.com/yanbab/backoff/blob/master/backend/config/config.schema.yml)

## Customize frontend

The frontend is really a simple sample, you can use your framework of choice to build the frontend the way you like. 

