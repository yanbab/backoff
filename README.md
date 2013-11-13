**BackOff** is a PHP/MySQL application for generating web site administration interfaces.

It makes it simple for developers to implement beautiful and elegant interfaces with very little effort, while providing clients an easy to use interface to manage their website.

## Screenshots

Nice, easy to use interface

![Nice, easy to use interface](https://raw.github.com/yanbab/backoff/master/frontend/files/screenshots/shot1.png)

Custom data editing made simple

![Complex data editing](https://raw.github.com/yanbab/backoff/master/frontend/files/screenshots/shot3.png)

Themes support

![Themes support](https://raw.github.com/yanbab/backoff/master/frontend/files/screenshots/shot2.png)




## Installation

**Download**

* Zip archive : **[master.zip](https://github.com/yanbab/backoff/archive/master.zip)**
* GIT : *git clone https://github.com/yanbab/backoff.git*

**Requirement**

* PHP 4+ 
* MySQL

**Setup**

* Extract folder somewhere in your web server
* Create a database, via phpmyadmin or command line *(mysql> CREATE DATABASE backoff)*
* Fill database with [backend/config/config.sql](https://github.com/yanbab/backoff/blob/master/backend/config/config.schema.yml)
* Change database settings in [config.php](https://github.com/yanbab/backoff/blob/master/config.php)

**Optional : Remove index.php from URLs**

Create frontend/.htaccess and backend/.htaccess with the following content :   

    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule ^(.*)$ /index.php/$1 [L]
    </IfModule>

Change 'url_suffix' in [config.php](https://github.com/yanbab/backoff/blob/master/config.php) from 'index.php' to '' :

    $_CONFIG['site']['url_suffix'] = '';

**Notes**
  
*php short tags* should be enabled (via .htaccess or php.ini)

## Customize backend

You can customize every aspect of the backend via a simple [YAML](http://fr.wikipedia.org/wiki/YAML) config file : [backend/config/schema.yml](https://github.com/yanbab/backoff/blob/master/backend/config/config.schema.yml)

** Fields type **

* Checkbox (checkbox)
* Color chooser (color)
* Date picker (date)
* Date and time picker  (datetime)
* File Upload (file)
* Newsletter  (newsletter)
* Number  (number)
* Order (order)
* Password  (password)
* Number  (percent)
* Rich text (richtext)
* Choice  (select)
* Multiple choice (selectmultiple)
* Text line (text)
* Text  (textarea)

## Extend backend

**Plugins**

You can write custom fields types, called plugins. 

To create a simple email input file with html5 validation, create the file plugins/email/email.php:

    class emailPlugin extends Plugin {
        const description = "Email field";
        function getHtml($field,$value='') {
            // Edit mode
            return "<input type=\"email\" required value=\"{$value}\">";
        }
        function prepForDisplay($field, $value = '') {
            // List mode
            return "<a href=\"mailto:{$value}\">{$value}</a>";
        }
    }


## Customize frontend

The frontend is really a simple sample, you can use your framework of choice to build the frontend the way you like. The database acts as a data gateway between the backend and your frontend.


