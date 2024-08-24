<?php  
	namespace Controllers;

	interface iController{
		public static function index($param): void;
		public static function render($param): void;
		public static function insert(array $post): void;
		public static function delete(int $id): void;
		public static function update(array $post): void;
		public static function select(array $post): array;
	}
?>