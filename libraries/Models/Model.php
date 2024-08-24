<?php 
namespace Models;

abstract class Model
{
    public static $pdo;

    public static function connecter()
    {
        self::$pdo = new \PDO("mysql:dbname=gvim;host=localhost", "root", "");
        self::$pdo->exec("SET CHARSET utf8");

        return self::$pdo;
            
    }
		// Méthodes d'objet:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _

		abstract public function update(array $args): void;
		abstract public function setAttributs(array $args): void;
		abstract public function post(): void;

		// Méthodes de classe:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _

		abstract public static function staticUpdate(array $args): void;
		abstract public static function findByID(int $id);
		abstract public static function deleteByID(int $id): void;
		abstract public static function insert(array $args): void;
		abstract public static function showAll(): array;
		abstract public static function find(array $cond): array;
		abstract public static function getLastID(): int;
}

function __construct()
    {
        //....
    }
 ?>