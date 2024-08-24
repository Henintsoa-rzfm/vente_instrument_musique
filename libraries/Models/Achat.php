<?php 
namespace Models;

require_once("Model.php");

class Achat extends Model
{
	public $NumAchat;
	public $DateAchat;
	public $HeureAchat;
	public $boutique;
	public $vendeur;
	public $paiement;

	function __construct(int $id)
	{
		self::connecter();

		$codeMySQL = "SELECT * FROM Achat WHERE NumAchat = ?" ;
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute(array($id)) ;
		$tabAchats = $pdoStatement->fetch();

		extract($tabAchats);

		$this->NumAchat = $NumAchat;
		$this->DateAchat = $DateAchat;
		$this->HeureAchat = $HeureAchat;
		$this->boutique = new Shop($NumShop) ;
		$this->vendeur = new Commercial($idCom) ;
		$this->paiement = new ModePaiement($codeMP) ;

	}

	public function setAttributs(array $args): void
	{
		extract($args) ;
		if(isset($NumAchat)) 
			$this->NumAchat = $NumAchat ;
		
		if(isset($DateAchat))  
			$this->DateAchat = $DateAchat ;

		if(isset($HeureAchat))  
			$this->HeureAchat = $HeureAchat ;
		
		if(isset($NumShop))  
			$this->boutique = new Shop($NumShop) ;

        if(isset($idCom))  
			$this->vendeur = new Commercial($idCom) ;

		if(isset($CodeMP))  
			$this->paiement =  new ModePaiement($codeMP);
	}

	public function delete() : void
	{
		self::$pdo->exec("DELETE FROM Achat WHERE NumAchat = ".$this->NumAchat);
	}

	public function update($args) : void
	{
		$codeMySQL = "UPDATE Achat SET " ;

		$testVirgule = FALSE ;

		if(isset($args["DateAchat"]))
		{
			$codeMySQL = $codeMySQL . " DateAchat = :DateAchat ";
			$testVirgule = TRUE ;
		}

		if(isset($args["HeureAchat"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " HeureAchat = :HeureAchat " ;
			$testVirgule = TRUE ;
		}

        if(isset($args["CodeMP"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " idCom = :idCom " ;
		}

		if(isset($args["idCom"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " idCom = :idCom " ;
		}

		if(isset($args["NumShop"]))
		{
			if ($testVirgule) {
				$codeMySQL = $codeMySQL . " , " ;
			}
			$codeMySQL = $codeMySQL . " NumShop = :NumShop " ;
			$testVirgule = TRUE;
		}
		

		$codeMySQL = $codeMySQL . " WHERE NumAchat = {$this->NumAchat}" ;
		
		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($args);
		$this->setAttributs($args);
	}	

	public function post(): void
	{
		$attributs = [
			"NumAchat" => $this->NumAchat ,
			"DateAchat" => $this->DateAchat ,
			"HeureAchat" => $this->HeureAchat , 
			"codeMP" => (int)$this->paiement->codeMP,
			"idCom" => (int)$this->vendeur->idCom,
			"NumShop" => (int)$this->boutique->NumShop 
		];

		$codeMySQL = "INSERT INTO Achat VALUES(:NumAchat, :DateAchat, :HeureAchat,:codeMP, :idCom, :NumShop,)" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($attributs);
	}

	public static function findByID(int $id)
	{
		$objetAchat = new Achat($id) ;
		return $objetAchat ;	
	}

	public static function deleteByID($id) : void
	{
		if(!isset(self::$pdo))self::connecter();
			self::$pdo->exec("DELETE FROM Achat WHERE NumAchat = ".$id);
	}

	public static function staticUpdate($args) : void
	{
		if(!isset(self::$pdo)) self::connecter();		
		extract($args);
		$post = compact('NumAchat', 'DateAchat', 'HeureAchat', 'CodeMP', 'idCom', 'NumShop');

		$codeMySQL = "UPDATE Achat SET ";

		$testVirgule = false ;

		if (isset($args["DateAchat"])) {
			$codeMySQL = $codeMySQL . " DateAchat = :DateAchat " ;
			$testVirgule = true ;
		}

		if (isset($args["HeureAchat"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " HeureAchat = :HeureAchat " ;
			$testVirgule = true ;
		}

		if (isset($args["CodeMP"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " CodeMP = :CodeMP " ;
		}

        if (isset($args["idCom"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " idCom = :idCom " ;
			$testVirgule = true ;
		}

		if (isset($args["NumShop"])) {
			if ($testVirgule) $codeMySQL = $codeMySQL . " , " ;
			$codeMySQL = $codeMySQL . " NumShop = :NumShop " ;
			$testVirgule = true ;
		}		

		$codeMySQL = $codeMySQL . " WHERE NumAchat = :NumAchat" ;

		$pdoStatement = self::$pdo->prepare($codeMySQL);
		$pdoStatement->execute($post);
	}


	public static function insert($param) : void
	{
		if(!isset(self::$pdo)) self::connecter();
		extract($param);
		$post = compact('DateAchat', 'HeureAchat', 'CodeMP', 'idCom','NumShop');
		$codeMysql = "INSERT INTO Achat(DateAchat, HeureAchat, CodeMP, idCom, NumShop) VALUES(:DateAchat, :HeureAchat,:CodeMP, :idCom, :NumShop)";
		$pdoStatement = self::$pdo->prepare($codeMysql);
		$pdoStatement->execute($post);

	}


	public static function showAll(): array
	{	
		if(!isset(self::$pdo)) self::connecter();
		$codeMysql = "SELECT * FROM Achat1view";
		
		$requete = self::$pdo->query($codeMysql);
		$Achats = $requete->fetchAll();
		
		return $Achats;
	}

	public static function find(array $cond): array
	{
		self::connecter();

	   $codeMySQL="SELECT * FROM Achat ";

	   $testAND = false ;

	   $cond1 = !empty($cond["NumAchat"]);
	   $cond2 = !empty($cond["DateAchat"]);
	   $cond3 = !empty($cond["HeureAchat"]);
	   $cond4 = !empty($cond["codeMP"]);
	   $cond5 = !empty($cond["idCom"]);
	   $cond6 = !empty($cond["NumShop"]);
	   $cond7 = !empty($cond["strCond"]);
		

	   if ($cond1 OR $cond2 OR $cond3 OR $cond4 OR $cond5 OR $cond6 OR $cond7) {
		   $codeMySQL = $codeMySQL . " WHERE " ;
	   }

	   if($cond1) 
	   {
		   $codeMySQL = $codeMySQL . "NumAchat =  " . $cond['NumAchat'];
		   $testAND = true ;
	   }

	   if ($cond2) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " DateAchat = '" . $cond['DateAchat'] . "'";
		   $testAND = true ;
	   }

	   if ($cond3) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . " HeureAchat = '" . $cond['HeureAchat']."'";
		   $testAND = true;
	   }


	   if ($cond4) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . " AND " ;
		}
		$codeMySQL = $codeMySQL . " idCom = " . $cond['idCom'];
		$testAND = true;
	}

	if ($cond5) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . " AND " ;
		}
		$codeMySQL = $codeMySQL . " NumShop = " . $cond['NumShop'];
		$testAND = true;
	}


	if ($cond6) {
		if ($testAND) {
			$codeMySQL = $codeMySQL . " AND " ;
		}
		$codeMySQL = $codeMySQL . " CodeMP = " . $cond['CodeMP'];
		$testAND = true;
	}

	   if ($cond7) {
		   if ($testAND) {
			   $codeMySQL = $codeMySQL . " AND " ;
		   }
		   $codeMySQL = $codeMySQL . $cond['strCond'] ;
		//    $testAND = true;
	   }


	//   echo $codeMySQL . "<br>" ;

	   $pdoStatement  = self::$pdo->query($codeMySQL);
	   $resultat = $pdoStatement->fetchAll();

	   return $resultat ;
	}

	public static function getLastID(): int
	{
		if(!isset(self::$pdo)) self::connecter();

		$codeMySQL = "SELECT max(NumAchat) AS lastID FROM Achat"; 
		$pdoStatement = self::$pdo->query($codeMySQL);
		$tabLastID = $pdoStatement->fetch();

		return $tabLastID["lastID"] ;
	}
}
//Mety
// $p = Telephone::find(["RefClt"=>4]);
// print_r($p);

//Mety
// $p = Telephone::showAll();
// print_r($p);

// Mety
// $date = 1648611993;
// $date1 = date("Y-m-d", strtotime($date));
// $op = Achat::insert(["DateAchat"=>date('Y-m-d'), "HeureAchat"=>time('Y:m:s'), "CodeMP"=>1, "idCom"=>2, "NumShop"=>5]);
// $date = "2022-03-30";
// $op = Achat::insert(["DateAchat"=>date('Y-m-d'), "HeureAchat"=>date('H:i:s'), "CodeMP"=>1, "idCom"=>2, "NumShop"=>5]);
// print_r($op);
// echo date('Y-m-d') . PHP_EOL .'<br>';
// echo date('H:i:s', time());
//Mety
// $prov = Achat::staticUpdate(["NumAchat"=>1, "HeureAchat"=>"12:20"]);
// print_r($prov);

//Mety
// Achat::deleteByID(6);

// $a = Achat::getLastID();
// print_r($a);




 ?>