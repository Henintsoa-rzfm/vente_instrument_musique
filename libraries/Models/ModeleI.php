<?php 
//OK
namespace Models;

require_once("Model.php");

class ModeleI extends Model
{
	public $idModele;
	public $Modele;
	public $Taille;
	public $Prixunitaire;
	public $categorie;

	function __construct(int $id)
	{
		self::connecter();

		$codeMySQL = "SELECT * FROM Modele WHERE idModele = ?" ;
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute(array($id)) ;
		$tabmodeles = $pdoStatement->fetch();

		extract($tabmodeles);

		$this->idModele = $idModele;
		$this->Modele = $Modele;
		$this->Taille = $Taille;
		$this->PrixUnitaire = $PrixUnitaire;
		$this->categorie = new Instrument($idInstrument) ;

	}

	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($idModele)) 
			$this->idModele = $idModele ;
		
		if(isset($Modele))  
			$this->Modele = $Modele ;

		if(isset($taille))  
			$this->Taille = $Taille ;
		
		if(isset($PrixUnitaire))  
			$this->PrixUnitaire = $PrixUnitaire ;

		if(isset($idInstrument))  
			$this->categorie =  new Instrument($idInstrument);
	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Modele WHERE Modele = ".$this->idModele);
	}

	public function update($args) : void
	{
		$codeMySQL = "UPDATE Modele SET " ;

		$testVirgule = FALSE ;

		if(isset($args["Modele"]))
		{
			$codeMySQL = $codeMySQL . " Modele = :Modele ";
			$testVirgule = TRUE ;
		}

		if(isset($args["Taille"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " Taille = :Taille " ;
			$testVirgule = TRUE ;
		}

		if(isset($args["PrixUnitaire"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " PrixUnitaire = :PrixUnitaire " ;
			$testVirgule = TRUE;
		}

		if(isset($args["idModele"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " idInstrument = :idInstrument " ;
		}

		$codeMySQL = $codeMySQL . " WHERE idModele = {$this->idModele}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public function post(): void
	{
		$attributs = [
			"idModele" => $this->idModele ,
			"Modele" => $this->Modele ,
			"Taille" => $this->Taille ,
			"PrixUnitaire" => $this->PrixUnitaire ,
			"idInstrument" => (int)$this->categorie->idInstrument 
		];

		$codeMySQL = "INSERT INTO Modele VALUES(:idModele, :Modele, :Taille, :PrixUnitaire, :idInstrument)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}

	public static function findByID(int $id)
	{
		$objetModele = new ModeleI($id) ;
		return $objetModele ;	
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();
			self::$pdo->exec("DELETE FROM Modele WHERE idModele = ".$id);
	}

	public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($args);
		$post = compact('idModele','Modele', 'Taille', 'PrixUnitaire', 'idInstrument');
		
		$codeMySQL = "UPDATE Modele SET ";

		$testVirgule = false ;

		if (isset($args["Modele"])) {
			$codeMySQL = $codeMySQL . " Modele = :Modele " ;
			$testVirgule = true ;
		}

		if (isset($args["Taille"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " Taille = :Taille " ;
			$testVirgule = true ;
		}

		if (isset($args["PrixUnitaire"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " PrixUnitaire = :PrixUnitaire " ;
			$testVirgule = true ;
		}

		if (isset($args["idInstrument"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " idInstrument = :idInstrument " ;
		}

		$codeMySQL = $codeMySQL . " WHERE idModele = :idModele" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		$post = compact('Modele', 'Taille', 'PrixUnitaire', 'idInstrument');
		
		$codeMysql = "INSERT INTO modele(Modele, Taille, PrixUnitaire, idInstrument) VALUES (:Modele, :Taille, :PrixUnitaire, :idInstrument)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($post);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM modeleviewako";
		$requete = self::$pdo->query($codeMysql);
		$modele = $requete->fetchAll();
		
		return $modele;
	}

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Modele ";

	   $testAND = false ;

	   $cond1 = !empty($cond["idModele"]);
	   $cond2 = !empty($cond["Modele"]);
	   $cond3 = !empty($cond["Taille"]);
	   $cond4 = !empty($cond["PrixUnitaire"]);
	   $cond5 = !empty($cond["idInstrument"]);
	   $cond6 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3 OR $cond4 OR $cond5 OR $cond6) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "idModele =  " . $cond['idModele'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Modele = '" . $cond['Modele'] . "'";
		   $testAND = true ;
	   }

	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Taille = '" . $cond['Taille']."'";
		   $testAND = true;
	   }

	   if ($cond4) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " PrixUnitaire = " . $cond['PrixUnitaire'];
		   $testAND = true;
	   }

	   if ($cond5) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . " AND " ;
		}
		$codeMySQL = $codeMySQL . " idInstrument = " . $cond['idInstrument'];
		$testAND = true;
	}

	   if ($cond6) {
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

		$codeMySQL = "SELECT max(idModele) AS lastID FROM Modele"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Tsia
// ModeleI::insert(["Modele"=>"aaaaa", "Taille"=>2, "PrixUnitaire"=>200000.00, "idInstrument"=>1]);
 
//Mety
// $a = ModeleI::find(["idInstrument"=>4]);
// print_r($a);
 
//Mety
//  ModeleI::staticUpdate(["idModele"=>1, "PrixUnitaire"=>700001]);
 
//Mety
// $a = ModeleI::showAll();
// print_r($a);
 
 ?>