<?php 
//OK
namespace Models;

require_once("Model.php");

class Telephone extends Model
{
	public $TelClt;
	public $proprietaire;

	function __construct(int $id)
	{
		self::connecter();

		$codeMySQL = "SELECT * FROM Telephone WHERE TelClt = ?" ;
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute(array($id)) ;
		$tabTelephones = $pdoStatement->fetch();

		extract($tabTelephones);

		$this->TelClt = $TelClt;
		$this->proprietaire = new Client($RefClt) ;

	}

	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($TelClt)) 
			$this->TelClt = $TelClt ;

		if(isset($RefClt))  
			$this->proprietaire =  new Client($RefClt);
	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Telephone WHERE TelClt = ".$this->TelClt);
	}

	public function update($args) : void
	{
		$codeMySQL = "UPDATE Telephone SET " ;

		$testVirgule = FALSE ;

		if(isset($args["TelClt"]))
		{
			$codeMySQL = $codeMySQL . " TelClt = :TelClt ";
			$testVirgule = TRUE ;
		}

		if(isset($args["RefClt"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " RefClt = :RefClt " ;
		}

		$codeMySQL = $codeMySQL . " WHERE TelClt = {$this->TelClt}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public function post(): void
	{
		$attributs = [
			"TelClt" => $this->TelClt ,
			"RefClt" => (int)$this->proprietaire->RefClt 
		];

		$codeMySQL = "INSERT INTO Telephone VALUES(:TelClt, :RefClt)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}

	public static function findByID(int $id)
	{
		$objetTelephone = new Telephone($id) ;
		return $objetTelephone ;	
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();
			self::$pdo->exec("DELETE FROM Telephone WHERE TelCLt = ".$id);
	}

	public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($args);
		$post = compact('TelClt', 'RefClt');

		$codeMySQL = "UPDATE Telephone SET ";

		$testVirgule = false ;

		if (isset($args["TelCLt"])) {
			$codeMySQL = $codeMySQL . " Telephone = :Telephone " ;
			$testVirgule = true ;
		}

		if (isset($args["RefClt"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " RefClt = :RefClt " ;
		}

		$codeMySQL = $codeMySQL . " WHERE TelClt = :TelClt" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		$post = compact('TelClt', 'RefClt');
		$codeMysql = "INSERT INTO Telephone(TelClt, RefClt) VALUES(:TelClt, :RefClt)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($post);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM Telephoneview";
		
		$requete = self::$pdo->query($codeMysql);
		$Telephones = $requete->fetchAll();
		
		return $Telephones;
	}

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Telephone ";

	   $testAND = false ;

	   $cond1 = !empty($cond["TelClt"]);
	   $cond2 = !empty($cond["RefClt"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "TelClt =  " . $cond['TelClt'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . " AND " ;
		}
		$codeMySQL = $codeMySQL . " RefClt = " . $cond['RefClt'];
		$testAND = true;
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

		$codeMysql = "SELECT * FROM Telephone ORDER BY TelClt";
		$requete = self::$pdo->query($codeMysql);
		$telephones = $requete->fetchAll();

		end($telephones);
		$telephone = current($telephones);
		$lastphone = $telephone["TelClt"];

		return $lastphone;
	}
}
//Mety
// $p = Telephone::find(["RefClt"=>4]);
// print_r($p);

//Mety
// $p = Telephone::showAll();
// print_r($p);

// Mety
// $op = Telephone::insert(["TelClt"=>"0382453678", "RefClt"=>6]);
// print_r($op);

//Mety
// $prov = Telephone::staticUpdate(["TelClt"=>"0382453678", "RefClt"=>6]);
// print_r($prov);

//Mety
// Shop::deleteByID(6);

// $a = Telephone::getLastID();
// print_r($a);

 ?>