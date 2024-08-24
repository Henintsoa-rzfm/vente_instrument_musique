<?php  
	namespace Controllers;

	require_once "libraries/Models/Instrument.php" ;
	
	class Instrument  extends Controller implements iController 
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
			\Models\Instrument::insert($post);
			$code = \Models\Instrument::getLastID();
			echo "<meta http-equiv='refresh' content='0, index.php#$code'>";
		}
		//...................................

		public static function delete(int $id): void 
		{
			\Models\Instrument::connecter();
			\Models\Instrument::deleteByID($id);
			header("Location: ?page=page");
		}
		//...................................

		public static function update(array $post): void 
		{
			\Models\Instrument::connecter();
			\Models\Instrument::staticUpdate($post);
			header("Location: ?page=page");
		}
		//...................................

		public static function select(array $post): array 
		{
			\Models\Instrument::connecter();
			$tableauArticle = \Models\Instrument::find($post);
			return $tableauArticle ;
		}
		//...................................
	}



?>