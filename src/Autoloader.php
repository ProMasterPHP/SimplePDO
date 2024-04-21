<?php
class Autoloader{
    const base_dir = __DIR__ . '/';

    public static function boot($models, $prefix = ''){
        require __DIR__."/Database.php";
        require __DIR__."/Model.php";

        if(!empty($prefix)){
            $prefix = $prefix."\\";   
        }

        spl_autoload_register(function($class) use($models, $prefix){
            if(!in_array($class, [
                'TurgunboyevUz\\SimplePDO\\Database',
                'TurgunboyevUz\\SimplePDO\\Model',
            ])){
                if(substr($class, 0, strlen($prefix)) == $prefix){
                    $class = substr($class, strlen($prefix));
                }
                $path = str_replace('\\', '/', $class).'.php';
                if(file_exists($models.'/'.$path)){
                    require $models.'/'.$path;
                }
            }
        });
    }

    public static function find($dir = 'Model', $base_dir = null){
        $base_dir = $base_dir ?? self::base_dir;
        $scan = scandir($base_dir);
        $flip = array_flip($scan);

        if(array_key_exists($dir, $flip)){
            return $base_dir.$dir;
        }else{
            return self::find($dir, $base_dir."../");
        }
    }
}
?>