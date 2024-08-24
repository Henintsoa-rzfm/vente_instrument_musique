<?php 
//OK
namespace Models;
require_once "Model.php";

class Shop extends Model
{
	public $NumShop;
	public $Shop;

	function __construct(int $id)
	{
		self::connecter();
		$codeMysql = "SELECT * FROM Shop WHERE NumShop = ?";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute(array($id)) ;
		$tabShops = $pdoStatement->fetch();
		
		extract($tabShops);
		$this->NumShop = $NumShop;
		$this->Shop = $Shop;

	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Shop WHERE NumShop = $this->NumShop");
	}


	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($NumShop)) 
			$this->NumShop = $NumShop ;
		
		if(isset($Shop))  
			$this->Shop = $Shop ;
	}	

	public function post(): void
	{
		$attributs = [
			"NumShop" => $this->NumShop ,
			"Shop" => $this->Shop 
		];

		$codeMySQL = "INSERT INTO Shop VALUES(:NumShop, :Shop)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}


	public function update(array $args) : void
	{
		$codeMySQL = "UPDATE Shop SET " ;


		if(isset($args["Shop"]))
		{
			$codeMySQL = $codeMySQL . " Shop = :Shop ";
		}
		$codeMySQL = $codeMySQL . " WHERE NumShop = {$this->NumShop}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public static function findByID(int $id) 
	{
		$ObjectShop = new Shop($id);
		return $ObjectShop;		
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();		 	
			self::$pdo->exec("DELETE FROM Shop WHERE NumShop = ".$id);
	}

	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		// $post = compact('Shop');

		$codeMysql = "INSERT INTO Shop(Shop) VALUES(:Shop)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($param);
	}


		public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "UPDATE Shop SET ";

		if (isset($args["Shop"])) {
			$codeMySQL = $codeMySQL . " Shop = :Shop " ;
		}

		$codeMySQL = $codeMySQL . " WHERE NumShop = :NumShop" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM Shop";

		$requete = self::$pdo->query($codeMysql);
		$Shops = $requete->fetchAll();
		
		return $Shops;
	}	

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Shop ";

	   $testAND = false ;

	   $cond1 = !empty($cond["NumShop"]);
	   $cond2 = !empty($cond["Shop"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "NumShop =  " . $cond['NumShop'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Shop = '" . $cond['Shop'] . "'";
	   }
	
	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . $cond['strCond'] ;
	   }


	   echo $codeMySQL . "<br>" ;

	   $pdoStatement  = self::$pdo->query($codeMySQL);
	   $resultat = $pdoStatement->fetchAll();

	   return $resultat ;
	}

	public static function getLastID(): int
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "SELECT max(NumShop) AS lastID FROM Shop"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $p = Shop::find(["NumShop"=>4]);
// print_r($p);

//Mety
// $p = Shop::showAll();
// print_r($p);

// Mety
// $shop = Shop::insert(["Shop"=>"Ankalamanjana"]);
// print_r($shop);

//Mety
// $prov = Shop::staticUpdate(["NumShop"=>1, "Shop"=>"Andravoahangy Ambony"]);
// print_r($prov);

//Mety
// Shop::deleteByID(6);

// $a = Shop::getLastID();
// print_r($a);

 ?>