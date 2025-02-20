<?php 

class TemplateController{

	/*=============================================
	Traemos la vista principal de la plantilla
	=============================================*/

	public function index(){

		include "views/template.php";
	
	}

	/*=============================================
	Función Reducir texto
	=============================================*/

	static public function reduceText($value, $limit){

		if(strlen($value) > $limit){

			$value = substr($value, 0, $limit)."...";
		}

		return $value;
	}
	/*=============================================
	Función para dar formato a las fechas
	=============================================*/

	static public function formatDate($type, $value){

		date_default_timezone_set("Europe/Madrid");
		setlocale(LC_TIME, 'es_VE.UTF-8','esp'); //Para traer dias y meses en español

		if($type == 1){

			return strftime("%d %B %Y", strtotime($value));
		}

		if($type == 2){

			return strftime("%b %Y", strtotime($value));

		}

		if($type == 3){

			return strftime("%d - %m - %Y", strtotime($value));

		}

		if($type == 4){

			return strftime("%d/%m/%Y", strtotime($value));

		}

		if($type == 5){

			return strftime("%d %b %Y", strtotime($value));
		}

	}
    
}

?>