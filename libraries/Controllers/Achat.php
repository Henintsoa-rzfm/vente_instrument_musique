<?php  
	namespace Controllers;

	require_once "libraries/Autoloader.php" ;
	
	class Achat  extends Controller implements iController 
	{

		//...................................

		public static function insert(array $post): void 
		{
			\Models\Achat::insert($post);
			$code = \Models\Achat::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.achats#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Achat::connecter();
			\Models\Achat::deleteByID($id);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.achats'>";
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Achat::connecter();
			\Models\Achat::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.achats'>";
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Achat::connecter();
			$tableauArticle = \Models\Achat::find($post);
			return $tableauArticle ;
		}
		
		public static function index($param): void 
		{
			
		}
		//...................................

		public static function render($args): void 
		{

		}		//...................................
	}



?>