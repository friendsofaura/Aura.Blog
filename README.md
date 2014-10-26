# Aura.Blog

Aura version 2 blog example using the [Action Domain Responder](https://github.com/pmjones/adr).

## Installation

```bash
composer create-project -s dev aura/web-project aurav2
cd aurav2
composer require "aura/blog:2.0.*@dev"
```

Create a database and run the code.

```sql
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `intro` tinytext NOT NULL,
  `body` text NOT NULL,
  `author` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

Edit `config/Common.php` and in `define()` method we need to define the
database connection as below.

```php
$di->params['Aura\Sql\ExtendedPdo'] = array(
    'dsn' => 'mysql:dbname=auraauth;host=127.0.0.1',
    'username' => 'root',
    'password' => 'mysqlroot'
);
```

Run your local php server

```bash
php -S localhost:8000 web/index.php
```

And browse `http://localhost:8000/blog`

## Caution

You may need to make use of the dev version of Aura.View .
