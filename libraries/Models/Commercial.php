<?php 
//OK
namespace Models;
require_once "Model.php";

class Commercial extends Model
{
	public $idCom;
	public $Commercial;

	function __construct(int $id)
	{
		self::connecter();
		$codeMysql = "SELECT * FROM Commercial WHERE idCom = ?";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute(array($id)) ;
		$tabCommercials = $pdoStatement->fetch();
		
		extract($tabCommercials);
		$this->idCom = $idCom;
		$this->Commercial = $Commercial;

	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Commercial WHERE idCom = $this->idCom");
	}


	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($idCom)) 
			$this->idCom = $idCom ;
		
		if(isset($Commercial))  
			$this->Commercial = $Commercial ;
	}	

	public function post(): void
	{
		$attributs = [
			"idCom" => $this->idCom ,
			"Commercial" => $this->Commercial 
		];

		$codeMySQL = "INSERT INTO Commercial VALUES(:idCom, :Commercial)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}


	public function update(array $args) : void
	{
		$codeMySQL = "UPDATE Commercial SET " ;


		if(isset($args["Commercial"]))
		{
			$codeMySQL = $codeMySQL . " Commercial = :Commercial ";
		}
		$codeMySQL = $codeMySQL . " WHERE idCom = {$this->idCom}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public static function findByID(int $id) 
	{
		$ObjectCommercial = new Commercial($id);
		return $ObjectCommercial;		
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();		 	
			self::$pdo->exec("DELETE FROM Commercial WHERE idCom = ".$id);
	}

	public static function insert($param) : void
	{
		// extract($param);
		// $post = compact('Commercial');
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "INSERT INTO Commercial(Commercial) VALUES(:Commercial)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($param);
	}


		public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "UPDATE Commercial SET ";

		if (isset($args["Commercial"])) {
			$codeMySQL = $codeMySQL . " Commercial = :Commercial " ;
		}

		$codeMySQL = $codeMySQL . " WHERE idCom = :idCom" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);

	}


	public static function showAll(): array
	{
		if(!isset(self::$pdo)) self::connecter();	
		$codeMysql = "SELECT * FROM Commercial";
		$requete = self::$pdo->query($codeMysql);
		$Commercial = $requete->fetchAll();
		
		return $Commercial;
	}	

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Commercial ";

	   $testAND = false ;

	   $cond1 = !empty($cond["idCom"]);
	   $cond2 = !empty($cond["Commercial"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "idCom =  " . $cond['idCom'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Commercial = '" . $cond['Commercial'] . "'";
	   }
	
	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . $cond['strCond'] ;
	   }


	   //echo $codeMySQL . "<br>" ;

	   $pdoStatement  = self::$pdo->query($codeMySQL);
	   $resultat = $pdoStatement->fetchAll();

	   return $resultat ;
	}

	public static function getLastID(): int
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "SELECT max(idCom) AS lastID FROM Commercial"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $p = Commercial::find(["idCom"=>1]);
// print_r($p);

//Mety
// $p = Commercial::showAll();
// print_r($p);

// Mety
// $prov = Commercial::insert(["Commercial"=>"Ramaro"]);
// print_r($prov);

//Mety
// $prov = Commercial::staticUpdate(["idCom"=>"3", "Commercial"=>"Soava"]);
// print_r($prov);

//Mety
// Commercial::deleteByID(4);

// $a = Commercial::getLastID();
// print_r($a);
 ?>