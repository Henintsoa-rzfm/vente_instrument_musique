<?php 
namespace Models;

require_once("Model.php");

class Client extends Model
{
	public $RefClt;
	public $Client;
	public $Adresse;
	public $local;

	function __construct(int $id)
	{
		self::connecter();

		$codeMySQL = "SELECT * FROM Client WHERE RefClt = ?" ;
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute(array($id)) ;
		$tabclients = $pdoStatement->fetch();

		extract($tabclients);

		$this->RefClt = $RefClt;
		$this->Client = $Client;
		$this->Adresse = $Adresse;
		$this->local = new Province($idProvince) ;

	}

	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($RefClt)) 
			$this->RefClt = $RefClt ;
		
		if(isset($Client))  
			$this->Client = $Client ;

		if(isset($adresse))  
			$this->Adresse = $Adresse ;
		
		if(isset($idProvince))  
			$this->local =  new Province($idProvince);
	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Client WHERE Client = ".$this->RefClt);
	}

	public function update($args) : void
	{
		$codeMySQL = "UPDATE Client SET " ;

		$testVirgule = FALSE ;

		if(isset($args["Client"]))
		{
			$codeMySQL = $codeMySQL . " Client = :Client ";
			$testVirgule = TRUE ;
		}

		if(isset($args["adresse"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " Adresse = :Adresse " ;
			$testVirgule = TRUE ;
		}

		if(isset($args["RefClt"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " idProvince = :idProvince " ;
		}

		$codeMySQL = $codeMySQL . " WHERE RefClt = {$this->RefClt}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public function post(): void
	{
		$attributs = [
			"RefClt" => $this->RefClt ,
			"Client" => $this->Client ,
			"adresse" => $this->Adresse ,
			"idProvince" => (int)$this->local->idProvince 
		];

		$codeMySQL = "INSERT INTO Client VALUES(:Client, :Adresse, :idProvince)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}

	public static function findByID(int $id)
	{
		$objetClient = new Client($id) ;
		return $objetClient ;	
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();
			self::$pdo->exec("DELETE FROM Client WHERE RefClt = ".$id);
	}

	public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($args);
		$post = compact('RefClt','Client', 'Adresse', 'idProvince');
		$codeMySQL = "UPDATE Client SET ";

		$testVirgule = false ;

		if (isset($args["Client"])) {
			$codeMySQL = $codeMySQL . " Client = :Client " ;
			$testVirgule = true ;
		}

		if (isset($args["Adresse"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " Adresse = :Adresse " ;
			$testVirgule = true ;
		}

		if (isset($args["idProvince"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " idProvince = :idProvince " ;
		}

		$codeMySQL = $codeMySQL . " WHERE RefClt = :RefClt" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


	public static function insert($param) : void
	{
		
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		$post = compact('Client', 'Adresse', 'idProvince');
		$codeMysql = "INSERT INTO Client(Client, Adresse, idProvince) VALUES(:Client, :Adresse, :idProvince)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($post);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM Clientview";
		
		$requete = self::$pdo->query($codeMysql);
		$Clients = $requete->fetchAll();
		
		return $Clients;
	}

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Client ";

	   $testAND = false ;

	   $cond1 = !empty($cond["RefClt"]);
	   $cond2 = !empty($cond["Client"]);
	   $cond3 = !empty($cond["Adresse"]);
	   $cond4 = !empty($cond["idProvince"]);
	   $cond5 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3 OR $cond4 OR $cond5) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "RefClt =  '" . $cond['RefClt'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Client = '" . $cond['Client'];
		   $testAND = true;
	   }

	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . "' AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Adresse = '" . $cond['Adresse'];
		   $testAND = true;
	   }

	   if ($cond4) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . "' AND " ;
		}
		$codeMySQL = $codeMySQL . " idProvince = " . $cond['idProvince'];
		$testAND = true;
	}

	   if ($cond5) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . $cond['strCond'] ;
	   }


	//    echo $codeMySQL . "<br>" ;

	   $pdoStatement  = self::$pdo->query($codeMySQL);
	   $resultat = $pdoStatement->fetchAll();

	   return $resultat ;
	}

	public static function getLastID(): int
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "SELECT max(RefClt) AS lastID FROM Client"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $p = Client::find([]);
// print_r($p);

//Mety
// $p = Client::showAll();
// print_r($p);

// Mety
// $prov = Client::insert(["Client"=>"Sala", "Adresse"=>"Salazamay", "idProvince"=>3]);
// print_r($prov);

//Mety
// $prov = Client::staticUpdate(["RefClt"=>2, "Adresse"=>"Ampefiloha"]);
// print_r($prov);

//Mety
// Province::deleteByID(7);
// Province::deleteByID(8);

// $a = Client::getLastID();
// print_r($a);


 ?>