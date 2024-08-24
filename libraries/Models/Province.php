<?php 

//OK
namespace Models;
require_once "Model.php";

class Province extends Model
{
	public $idProvince;
	public $Province;

	function __construct(int $id)
	{
		self::connecter();
		$codeMysql = "SELECT * FROM Province WHERE idProvince = ?";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute(array($id)) ;
		$tabprovinces = $pdoStatement->fetch();
		
		extract($tabprovinces);
		$this->idProvince = $idProvince;
		$this->Province = $Province;

	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Province WHERE idProvince = $this->province");
	}


	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($idProvince)) 
			$this->idProvince = $idProvince ;
		
		if(isset($province))  
			$this->Province = $Province ;
	}	

	public function post(): void
	{
		$attributs = [
			"idProvince" => $this->idProvince ,
			"Province" => $this->Province 
		];

		$codeMySQL = "INSERT INTO Province(idProvince, Province) VALUES(:idProvince, :Province)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}


	public function update(array $args) : void
	{
		$codeMySQL = "UPDATE Province SET " ;


		if(isset($args["Province"]))
		{
			$codeMySQL = $codeMySQL . " Province = :Province ";
		}
		$codeMySQL = $codeMySQL . " WHERE idProvince = {$this->idProvince}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public static function findByID(int $id) 
	{
		$ObjectProvince = new Province($id);
		return $ObjectProvince;		
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();		 	
			self::$pdo->exec("DELETE FROM Province WHERE idProvince = ".$id);
	}

	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		
		extract($param);

		$post = compact('province');

		$codeMySQL = "INSERT INTO Province(Province) VALUES(:Province)";
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


		public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "UPDATE Province SET ";

		if (isset($args["Province"])) {
			$codeMySQL = $codeMySQL . " Province = :Province " ;
		}

		$codeMySQL = $codeMySQL . " WHERE idProvince = :idProvince" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);

	}

	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		
		$pdoStatement = self::$pdo->query("SELECT * FROM Province");
		
		$provinces = $pdoStatement->fetchAll();

		return $provinces;
	}	

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Province ";

	   $testAND = false ;

	   $cond1 = !empty($cond["idProvince"]);
	   $cond2 = !empty($cond["Province"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "idProvince =  " . $cond['idProvince'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Province = '" . $cond['Province'] . "'";
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

		$codeMySQL = "SELECT max(idProvince) AS lastID FROM Province"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}



















//Mety
// $p = Province::find(["idProvince"=>4]);
// print_r($p);

//Mety
// $p = Province::showAll();
// print_r($p);

// Mety
// $prov = Province::insert(["Province"=>"Antananarivo"]);
// print_r($prov);

//Mety
// $prov = Province::staticUpdate(["idProvince"=>"7", "Province"=>"Antan"]);
// print_r($prov);

//Mety
// Province::deleteByID(7);
// Province::deleteByID(8);

// $a = Province::getLastID();
// print_r($a);
 ?>