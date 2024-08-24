<?php  
	namespace Controllers;

	require_once "libraries/Models/Acheter.php" ;
	
	class Acheter  extends Controller implements iController 
	{
		
		//...................................

		public static function insert(array $post): void 
		{
			\Models\Acheter::insert($post);
			$code = \Models\Acheter::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.Acheter#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Acheter::connecter();
			\Models\Acheter::deleteByID($id);
			header("Location: ?page=page");
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Acheter::connecter();
			\Models\Acheter::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.Acheter'>";
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Acheter::connecter();
			$tableauArticle = \Models\Acheter::find($post);
			return $tableauArticle ;
		}
	
		public static function index($param): void 
		{
			
		}
		//...................................
	
		public static function render($args): void 
		{
	
		}
		//...................................
	}


?>