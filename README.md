
# SimplePDO (Query Builder based on structure of Eloquent ORM)


## Installation

```bash
  git clone https://github.com/ProMasterPHP/SimplePDO.git
  mv SimplePDO/* ./
  rm -rf SimplePDO
```

## Add your configs to config.php
```php
require "src/Autoloader.php";

Autoloader::boot(Autoloader::find('Model')); //Model -> model fayllari joylashgan direktoriya (default - Model)

use TurgunboyevUz\SimplePDO\Database;

$sql = [
    'dbuser'=>'', // your database username
    'dbpass'=>'', // your database password
    'dbname'=>'' // your database name
];

Database::connect('mysql', [
    'host' => 'localhost',
    'port'=>3306,
    'charset' => 'utf8mb4',
    'dbname' => $sql['dbname'],
], $sql['dbuser'], $sql['dbpass']);
```
## Usage/Examples

## Create new model (Example - Model/Order.php)
```php
use TurgunboyevUz\SimplePDO\Model;

class Order extends Model{
    protected static $table = 'orders'; //model javob beradigan table nomi (required)
    
    public static function up(){
        return self::query("CREATE TABLE `orders` (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id BIGINT NOT NULL,
            product_id INT(11) NOT NULL,
            status VARCHAR(255) NOT NULL,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down(){
        return self::dropIfExists();
    }
}
```

## Other usages in examples.php


## Authors
- [@TurgunboyevUz](https://www.github.com/TurgunboyevUz/)

## License

- [MIT](https://choosealicense.com/licenses/mit/)