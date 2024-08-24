<?php  
	namespace Controllers;

	require_once "libraries/Models/Commercial.php" ;
	
	class Commercial  extends Controller implements iController 
	{
		
		public static function index($param): void 
		{
			
		}
		//...................................

		public static function render($args): void 
		{

		}
		//...................................

		public static function insert(array $post): void 
		{
			\Models\Commercial::insert($post);
			$code = \Models\Commercial::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.commercial'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Commercial::connecter();
			\Models\Commercial::deleteByID($id);
			echo "<meta http-equiv='refresh' content='0, index.phppage=liste.commercial'>";
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Commercial::connecter();
			\Models\Commercial::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.phppage=liste.commercial'>";
		
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Commercial::connecter();
			$tableauArticle = \Models\Commercial::find($post);
			return $tableauArticle ;
		}
		//...................................
	}



?>