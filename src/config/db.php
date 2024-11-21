<?php
require_once __DIR__ .'/../helpers/Env.php';
class Database
{
    private static $db = null;

    public static function getDb()
    {
        if (self::$db === null) {
            $env = loadEnv(__DIR__ . '/../.env');
            self::$db = pg_connect("host={$env['DB_HOST']} port={$env['DB_PORT']} dbname={$env['DB_DATABASE']} user={$env['DB_USERNAME']} password={$env['DB_PASSWORD']}");

            if (!self::$db) {
                die("Ошибка подключения: " . pg_last_error());
            }
        }

        return self::$db;
    }
}