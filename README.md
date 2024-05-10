
# SPDO - SimplePDO (Query Builder based on structure of Eloquent ORM)


## Installation

```bash
  git clone https://github.com/ProMasterPHP/SimplePDO.git
  mv SimplePDO/* ./
  rm -rf SimplePDO
```

## Add your configs to src/Config/database.php
```php
return [
    'driver' => 'mysql', // mysql, pgsql, sqlite

    'host' => 'localhost', // default: localhost
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
];
```
## Usage/Examples

## Defining new model (to folder src/Model)
```php
namespace TurgunboyevUz\SPDO\Model;

use TurgunboyevUz\SPDO\Core\Model;

class User extends Model{
    protected static $table = 'users';

    public static function up(){
        return self::query("CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,

            PRIMARY KEY (`id`)
        )");
    }

    public static function down(){
        return self::dropIfExists();
    }
}
```

## Defining new controller (to folder src/Controller)

```php
namespace TurgunboyevUz\SPDO\Controller;

use TurgunboyevUz\SPDO\Model\User;

class UserC{
    // working with model should be there
}
```
## Authors
- [@TurgunboyevUz](https://www.github.com/TurgunboyevUz/)

## License

[MIT](https://choosealicense.com/licenses/mit/)