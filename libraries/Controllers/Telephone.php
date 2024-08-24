<?php  
	namespace Controllers;

	require_once "libraries/Models/Telephone.php" ;
	
	class Telephone  extends Controller implements iController 
	{
		

		//...................................

		public static function insert(array $post): void 
		{
			\Models\Telephone::insert($post);
			$code = \Models\Telephone::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.telephone#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Telephone::connecter();
			\Models\Telephone::deleteByID($id);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.telephone'>";
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Telephone::connecter();
			\Models\Telephone::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.telephone'>";
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Telephone::connecter();
			$tableauArticle = \Models\Telephone::find($post);
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