<?php 
//OK
namespace Models;

require_once("Model.php");

class Acheter extends Model
{
	public $Quantite;
	public $lachat;
	public $acheteur;
	public $leModeleI;

	function __construct(int $id)
	{
		self::connecter();

		$codeMySQL = "SELECT * FROM Acheter WHERE NumAchat = ?" ;
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute(array($id)) ;
		$tabAcheter = $pdoStatement->fetch();

		extract($tabAcheter);

		$this->quantite = $quantite;
		$this->lachat = new Achat($NumAchat) ;
		$this->acheteur = new Client($RefClt) ;
		$this->leModeleI = new ModeleI($idModele) ;


	}

	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($quantite))  
                $this->quantite = $quantite ;
        
        if(isset($NumAchat))  
			$this->lachat = new Achat($NumAchat) ;

        if(isset($acheteur))  
			$this->acheteur = new Client($RefClt) ;

		if(isset($idModele))  
			$this->leModeleI =  new ModeleI($idModele);
        
            
	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Acheter WHERE NumAchat = ".$this->lachat);
	}

	public function update($args) : void
	{
		$codeMySQL = "UPDATE Achat SET " ;

		$testVirgule = FALSE ;

		if(isset($args["Quantite"]))
		{
			$codeMySQL = $codeMySQL . " Quantite = :Quantite ";
			$testVirgule = TRUE ;
		}

		if(isset($args["NumAchat"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " NumAchat = :NumAchat " ;
			$testVirgule = TRUE ;
		}

		if(isset($args["RefClt"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " RefClt = :RefClt " ;
			$testVirgule = TRUE;
		}

		if(isset($args["idModele"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " idModele = :idModele " ;
		}


		$codeMySQL = $codeMySQL . " WHERE NumAchat = {$this->lachat}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public function post(): void
	{
		$attributs = [
			"Quantite" => $this->Quantite, 
			"NumAchat" => (int)$this->lachat->NumAchat,
			"RefClt" => (int)$this->acheteur->RefClt,
            "Modele" => (int)$this->leModeleI->idModele 
		];

		$codeMySQL = "INSERT INTO Acheter(Quantite, NumAchat, RefClt, idModele) VALUES(:Quantite, :NumAchat, :RefClt, :idModele)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}

	public static function findByID(int $id)
	{
		$objetAcheter = new Acheter($id) ;
		return $objetAcheter ;	
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();
			self::$pdo->exec("DELETE FROM Acheter WHERE NumAchat = ".$id);
	}

	public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($args);
		$post = compact('NumAchat', 'RefClt', 'idModele','Quantite' );
		$codeMySQL = "UPDATE Achat SET ";

		$testVirgule = false ;

		if (isset($args["NumAchat"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " NumAchat = :NumAchat " ;
			$testVirgule = true ;
		}

		if (isset($args["RefClt"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " RefClt = :RefClt " ;
			$testVirgule = true ;
		}

        if (isset($args["idModele"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " idModele = :idModele " ;
			$testVirgule = true ;
		}
		if (isset($args["Quantite"])) {
			$codeMySQL = $codeMySQL . " Quantite = :Quantite " ;
		}

		$codeMySQL = $codeMySQL . " WHERE NumAchat = :NumAchat" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		$post = compact('Quantite', 'NumAchat', 'RefClt', 'idModele');

		$codeMysql = "INSERT INTO Acheter(Quantite, NumAchat, RefClt, idModele) VALUES(:Quantite, :NumAchat, :RefClt, :idModele)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($post);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM acheterview";
		
		$requete = self::$pdo->query($codeMysql);
		$Acheter = $requete->fetchAll();
		
		return $Acheter;
	}

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Acheter ";

	   $testAND = false ;

	   $cond1 = !empty($cond["Quantite"]);
	   $cond2 = !empty($cond["NumAchat"]);
	   $cond3 = !empty($cond["RefClt"]);
	   $cond4 = !empty($cond["idModele"]);
	   $cond5 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3 OR $cond4 OR $cond5) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . " Quantite = " . $cond['Quantite'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " NumAchat = " . $cond['NumAchat'] ;
		   $testAND = true;
	   }

	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " RefClt = " . $cond['RefClt'];
		   $testAND = true;
	   }

	   if ($cond4) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " idModele = " . $cond['idModele'];
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

		$codeMySQL = "SELECT max(NumAchat) AS lastID FROM Acheter"; 
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
// $prov = Acheter::insert(["Quantite"=>1, "NumAchat"=>3, "RefClt"=>1, "idModele"=>3]);
// print_r($prov);

//Mety
// $prov = Commercial::staticUpdate(["idCom"=>"3", "Commercial"=>"Soava"]);
// print_r($prov);

//Mety
// Commercial::deleteByID(4);

// $a = Commercial::getLastID();
// print_r($a);


 ?>