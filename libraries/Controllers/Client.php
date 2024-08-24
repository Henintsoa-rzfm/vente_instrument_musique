<?php  
	namespace Controllers;
	require_once "libraries/Models/Client.php";	
	class Client  extends Controller implements iController 
	{
		public static function insert(array $post): void 
		{
			\Models\Client::connecter();
			\Models\Client::insert($post);
			$code = \Models\Client::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php#$code'>";
		}
		//...................................
		public static function delete(int $id): void 
		{
			\Models\Client::connecter();
			\Models\Client::deleteByID($id);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.clients'>";
		}
		//...................................
		public static function update(array $post): void 
		{
			\Models\Client::connecter();
			\Models\Client::staticUpdate($post);
			echo "<meta http-equiv='refresh' content='0, index.php?page=liste.clients'>";
		}
		//...................................
		public static function select(array $post): array 
		{
			\Models\Client::connecter();
			$tableauArticle = \Models\Client::find($post);
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

// Client::delete(15);


?>