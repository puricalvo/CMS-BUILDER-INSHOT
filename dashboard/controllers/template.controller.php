<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TemplateController{

	/*=============================================
	Traemos la vista principal de la plantilla
	=============================================*/

	public function index(){

		include "views/template.php";
	
	}

	/*=============================================
	Identificar el tipo de columna
	=============================================*/

	static public function typeColumn($value){

		if($value == "text" || 
		   $value == "textarea" ||
		   $value == "image" || 
		   $value == "video" ||
		   $value == "file" ||
		   $value == "link" ||
		   $value == "select" ||
		   $value == "array" ||
		   $value == "color" ||
		   $value == "password" || 
		   $value == "email"){

			$type = "TEXT NULL DEFAULT NULL";
		}

		if($value == "object"){

			$type = "TEXT NULL DEFAULT '{}'";
		}

		if($value == "json"){

			$type = "TEXT NULL DEFAULT '[]'";

		}

		if($value == "int" || $value == "relations"){
	       
	       	$type = "INT NULL DEFAULT '0'";
		
		}

		if($value == "boolean"){
	       
	       	$type = "INT NULL DEFAULT '1'";
		
		}

		if($value == "double" || $value == "money"){
	       
	       	$type = "DOUBLE NULL DEFAULT '0'";
		
		}

		if($value == "date"){
	       	
	       	$type = "DATE NULL DEFAULT NULL";
	    
	    }

	    if($value == "time"){
	       	
	       	$type = "TIME NULL DEFAULT NULL";
	    
	    }

	    if($value == "datetime"){
	      	
	      	$type = "DATETIME NULL DEFAULT NULL";
	    
	    }

	    if($value == "timestamp"){
	      	
	      	$type = "TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
	    }

	    if($value == "code"){

	       	$type = "LONGTEXT NULL DEFAULT NULL";
	    
	    }

	    return $type;

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
	Devuelva la miniatura de la lista
	=============================================*/

	static public function returnThumbnailList($value){

		/*=============================================
		Capturar miniatura imagen
		=============================================*/

		if(explode("/",$value->type_file)[0] == "image"){

			$path = '<img src="'.$value->link_file.'" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';

		}

		/*=============================================
		Capturar miniatura video
		=============================================*/

		if(explode("/",$value->type_file)[0] == "video" && $value->id_folder_file != 4){

			if(explode("/",$value->type_file)[1] == "mp4"){

				$path = '<video class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">
				<source src="'.$value->link_file.'" type="'.$value->type_file.'">
				</video>';

			}else{

				$path = '<img src="/views/assets/img/multimedia.png" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';
			}

		}

		if(explode("/",$value->type_file)[0] == "video" && $value->id_folder_file == 4){

			$path = '<img src="'.$value->thumbnail_vimeo_file.'" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';

		}

		/*=============================================
		Capturar miniatura audio
		=============================================*/

		if(explode("/",$value->type_file)[0] == "audio"){

			$path = '<img src="/views/assets/img/multimedia.png" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';

		}

		/*=============================================
		Capturar miniatura pdf
		=============================================*/

		if(explode("/",$value->type_file)[1] == "pdf"){

			$path = '<img src="/views/assets/img/pdf.jpeg" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';
		}

		/*=============================================
		Capturar miniatura zip
		=============================================*/

		if(explode("/",$value->type_file)[1] == "zip"){

			$path = '<img src="/views/assets/img/zip.jpg" class="rounded" style="width:100px; height:100px; object-fit: cover; object-position: center;">';
		}

		return $path;
	}

	/*=============================================
	Devuelva la miniatura de la cuadrícula
	=============================================*/

	static public function returnThumbnailGrid($value){

		/*=============================================
		Capturar miniatura imagen
		=============================================*/

		if(explode("/",$value->type_file)[0] == "image"){

			$path = '<img src="'.$value->link_file.'" class="rounded card-img-top w-100">';

		}

		/*=============================================
		Capturar miniatura video
		=============================================*/

		if(explode("/",$value->type_file)[0] == "video" && $value->id_folder_file != 4){

			if(explode("/",$value->type_file)[1] == "mp4"){

				$path = '<video class="rounded card-img-top w-100">
					<source src="'.$value->link_file.'" type="'.$value->type_file.'">
				</video>';

			}else{

				$path = '<img src="/views/assets/img/multimedia.png" class="rounded card-img-top w-100">';
			}

		}

		if(explode("/",$value->type_file)[0] == "video" && $value->id_folder_file == 4){

			$path = '<img src="'.$value->thumbnail_vimeo_file.'" class="rounded card-img-top w-100">';
			
		}

		/*=============================================
		Capturar miniatura audio
		=============================================*/

		if(explode("/",$value->type_file)[0] == "audio"){

			$path = '<img src="/views/assets/img/multimedia.png" class="rounded card-img-top w-100">';

		}

		/*=============================================
		Capturar miniatura pdf
		=============================================*/

 		if(explode("/",$value->type_file)[1] == "pdf"){

 			$path = '<img src="/views/assets/img/pdf.jpeg" class="rounded card-img-top w-100">';
 		}

 		/*=============================================
		Capturar miniatura zip
		=============================================*/

 		if(explode("/",$value->type_file)[1] == "zip"){

 			$path = '<img src="/views/assets/img/zip.jpg" class="rounded card-img-top w-100">';
 		}
	 		
		return $path;
	}

	/*=====================================================
	Función para generar código alfanumérico aleatorios
	=====================================================*/

	static public function genPassword($Length){

		$password = "";
		$chain = "0123456789abcdefghijklmnopqrstuvwxyz";

		$password = substr(str_shuffle($chain),0, $Length);

		return $password;
	}

	/*=====================================================
	Función para enviar correos electrónicos
	=====================================================*/

	static public function sendEmail($subject, $email, $title, $message, $link){

		date_default_timezone_set("Europe/Madrid");

		$mail = new PHPMailer;

		$mail->CharSet = "utf-8";
		//$mail->Encoding = 'base64'; //Habilitar al subir el sistema a un hosting;

		$mail->isMail();

		$mail->UseSendmailOptions = 0;

		$mail->setFrom("noreply@dashboard.com","CMS-BUILDER");

		$mail->Subject = $subject;

		$mail->addAddress($email);

		$mail->msgHTML('

			<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; 
                padding-top: 40px; padding-bottom: 40px">

				<div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px">

					<center>

						<h3 style="font-weight: 100; color: #999;">'.$title.'</h3>

						<hr style="border: 1px solid #ccc; width: 80%;">

						'.$message.'

						<a href="'.$link.'" target="_blank" style="text-decoration: none; margin-top: 10px">

							<div style="line-height: 25px; background: #000; width: 60%; padding: 10px; color: white; border-radius: 5px">
								Haz clic aquí
							</div>
						</a>

						<hr style="border: 1px solid #ccc; width: 80%">

						<h5 style="font-weight: 100; color: #999">
							Sí no solicitó el envío de este correo, haga caso omiso de este mensaje.
						</h5>

					</center>
				</div>

    		</div>
		
		');

		$send = $mail->send();

		if(!$send){

			return $mail->ErrorInfo;

		}else{

			return "ok";

		}

	}

}

?>