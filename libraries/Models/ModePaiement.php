<?php 
//OK
namespace Models;
require_once "Model.php";

class ModePaiement extends Model
{
	public $CodeMP;
	public $MP;

	function __construct(int $id)
	{
		self::connecter();
		$codeMysql = "SELECT * FROM MP WHERE CodeMP = ?";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute(array($id)) ;
		$tabMPs = $pdoStatement->fetch();
		
		extract($tabMPs);
		$this->CodeMP = $CodeMP;
		$this->MP = $MP;

	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM MP WHERE CodeMP = $this->CodeMP");
	}


	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($CodeMP)) 
			$this->CodeMP = $CodeMP ;
		
		if(isset($MP))  
			$this->MP = $MP ;
	}	

	public function post(): void
	{
		$attributs = [
			"CodeMP" => $this->CodeMP ,
			"MP" => $this->MP 
		];

		$codeMySQL = "INSERT INTO MP VALUES(:CodeMP, :MP)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}


	public function update(array $args) : void
	{
		$codeMySQL = "UPDATE ModePaiement SET " ;


		if(isset($args["MP"]))
		{
			$codeMySQL = $codeMySQL . " MP = :MP ";
		}
		$codeMySQL = $codeMySQL . " WHERE CodeMP = {$this->CodeMP}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public static function findByID(int $id) 
	{
		$ObjectMP = new ModePaiement($id);
		return $ObjectMP;		
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();		 	
		self::$pdo->exec("DELETE FROM ModePaiement WHERE CodeMP = ".$id);
	}

	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		// $post = compact('MP');

		$codeMysql = "INSERT INTO ModePaiement(MP) VALUES(:MP)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($param);
	}


		public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "UPDATE ModePaiement SET ";

		if (isset($args["MP"])) {
			$codeMySQL = $codeMySQL . " MP = :MP " ;
		}

		$codeMySQL = $codeMySQL . " WHERE CodeMP = :CodeMP" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM ModePaiement";
		
		$requete = self::$pdo->query($codeMysql);
		$ModeP = $requete->fetchAll();
		
		return $ModeP;
	}	

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM ModePaiement ";

	   $testAND = false ;

	   $cond1 = !empty($cond["CodeMP"]);
	   $cond2 = !empty($cond["MP"]);
	   $cond3 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "CodeMP =  " . $cond['CodeMP'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " MP = '" . $cond['MP'] . "'";
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

		$codeMySQL = "SELECT max(CodeMP) AS lastID FROM ModePaiement"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $mp = ModePaiement::insert(["MP"=>"Money"]);
// print_r($mp);

//Mety
// $mp = ModePaiement::find([]);
// print_r($mp);

//Mety
// $mp = ModePaiement::staticUpdate(["CodeMP"=>7, "MP"=>"aaaa"] );
// print_r($mp);

// $s = ModePaiement::showAll();
// print_r($s);

//Mety
// $s = ModePaiement::getLastID();
// print_r($s);

//Mety
// ModePaiement::deleteByID(6);
// ModePaiement::deleteByID(7);

 ?>