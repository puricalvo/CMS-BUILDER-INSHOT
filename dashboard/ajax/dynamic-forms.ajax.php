<?php

require_once "../controllers/curl.controller.php";

class DynamicFormsController{

	public $matrix_column;
	public $id_column;
	public $pre_value;
	public $token;

	public function updateMatrixColumn(){

		$url = "columns?id=".$this->id_column."&nameId=id_column&token=".$this->token."&table=admins&suffix=admin";
		$method = "PUT";
		$fields = "matrix_column=".$this->matrix_column;

		$updateMatrix = CurlController::request($url,$method,$fields);

		if($updateMatrix->status == 200){

			$url = "columns?linkTo=id_column&equalTo=".$this->id_column."&select=matrix_column";
			$method = "GET";
			$fields = array();

			$getMatrix = CurlController::request($url,$method,$fields);

			if($getMatrix->status == 200){

				$html = "";
				$count = 0;

				foreach (explode(",",$getMatrix->results[0]->matrix_column) as $key => $value) {

					$selected = "";

					if($this->pre_value != null){

						if($value == $this->pre_value){

							$selected = "selected";
						}
					}
					
					$html .= '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
					
					$count++;

					if($count == count(explode(",",$getMatrix->results[0]->matrix_column))){

						echo $html;
					}

				}

			}

		}

	}

	/*=============================================
	Devolver información de la tabla
	=============================================*/ 

	public $table;

	public function getTable(){

		$url = "columns?id=".$this->id_column."&nameId=id_column&token=".$this->token."&table=admins&suffix=admin";
		$method = "PUT";
		$fields = "matrix_column=".$this->table;

		$updateMatrix = CurlController::request($url,$method,$fields);

		if($updateMatrix->status == 200){

			$url = $this->table;
			$method = "GET";
			$fields = array();

			$columns = CurlController::request($url,$method,$fields);

			if($columns->status == 200){

				echo json_encode($columns->results);
			}

		}

		
	}
}

/*=============================================
Variables POST
=============================================*/ 

if(isset($_POST["matrix_column"])){

	$ajax = new DynamicFormsController();
	$ajax -> matrix_column = $_POST["matrix_column"];
	$ajax -> id_column = $_POST["id_column"];
	$ajax -> pre_value = $_POST["pre_value"];
	$ajax -> token = $_POST["token"];
	$ajax -> updateMatrixColumn(); 

}

if(isset($_POST["table"])){

	$ajax = new DynamicFormsController();
	$ajax -> table = $_POST["table"];
	$ajax -> id_column = $_POST["id_column"];
	$ajax -> token = $_POST["token"];
	$ajax -> getTable(); 

}

