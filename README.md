# Aura.Blog

Aura version 2 blog example using the [Action Domain Responder](https://github.com/pmjones/mvc-refinement).

## Installation

```bash
composer create-project -s dev aura/web-project aurav2
cd aurav2
```

Edit `composer.json` and add `aura/blog`.

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/harikt/Aura.Router"
        }
    ],
    "require": {
        // other

        "aura/blog":"2.0.*@dev",
        "aura/router":"dev-issue-62 as 2.0.x-dev"
    },
}
```

The repositories are added for a temporary fix to the bug
[#62](https://github.com/auraphp/Aura.Router/issues/62)

Create the database and create the table running the code below.

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
