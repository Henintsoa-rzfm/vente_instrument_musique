<?php 
//OK
namespace Models;
require_once "Model.php";

class Instrument extends Model
{
	public $idInstrument;
	public $instrument;

	function __construct(int $id)
	{
		self::connecter();
		$codeMysql = "SELECT * FROM Instrument WHERE idInstrument = ?";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute(array($id)) ;
		$tabinstruments = $pdoStatement->fetch();
		
		extract($tabinstruments);
		$this->idInstrument = $idInstrument;
		$this->Instrument = $Instrument;

	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Instrument WHERE idInstrument = $this->idInstrument");
	}


	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($idInstrument)) 
			$this->idInstrument = $idInstrument ;
		
		if(isset($instrument))  
			$this->instrument = $Instrument ;
	}	

	public function post(): void
	{
		$attributs = [
			"idInstrument" => $this->idInstrument ,
			"Instrument" => $this->instrument 
		];

		$codeMySQL = "INSERT INTO Instrument VALUES(:idInstrument, :Instrument)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}


	public function update(array $args) : void
	{
		$codeMySQL = "UPDATE Instrument SET " ;


		if(isset($args["Instrument"]))
		{
			$codeMySQL = $codeMySQL . " Instrument = :Instrument ";
		}
		$codeMySQL = $codeMySQL . " WHERE idInstrument = {$this->idInstrument}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public static function findByID(int $id) 
	{
		$Objectinstrument = new Instrument($id);
		return $Objectinstrument;		
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();		 	
			self::$pdo->exec("DELETE FROM Instrument WHERE idInstrument = ".$id);
	}

	public static function insert($param) : void
	{
		extract($param);
		// $post = compact('instrument');
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "INSERT INTO Instrument(Instrument) VALUES(:Instrument);";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($param);

	}


		public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "UPDATE Instrument SET ";

		if (isset($args["Instrument"])) {
			$codeMySQL = $codeMySQL . " Instrument = :Instrument " ;
		}

		$codeMySQL = $codeMySQL . " WHERE idInstrument = :idInstrument" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo))self::connecter();
		$codeMysql = "SELECT * FROM instrument";
		$requete = self::$pdo->query($codeMysql);

		$instrument = $requete->fetchAll();
		
		return $instrument;
	}	

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Instrument ";

	   $testAND = false ;

	   $cond1 = !empty($cond["idInstrument"]);
	   $cond2 = !empty($cond["Instrument"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "idInstrument =  " . $cond['idInstrument'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " Instrument = '" . $cond['Instrument'] . "'";
	   }
	
	   if ($cond3) {
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

		$codeMySQL = "SELECT max(idInstrument) AS lastID FROM Instrument"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $mp = Instrument::insert(["Instrument"=>"Ukulele"]);
// print_r($mp);

//Mety
// $mp = Instrument::staticUpdate(["idInstrument"=>5, "Instrument"=>"Flutte"] );
// print_r($mp);

//Mety
// $mp = Instrument::find(["idInstrument"=>3]);
// print_r($mp);


//Mety
// $s = Instrument::showAll();
// print_r($s);

//Mety
// $s = Instrument::getLastID();
// print_r($s);

//Mety
// Instrument::deleteByID(6);
// ModePaiement::deleteByID(7);


 ?>