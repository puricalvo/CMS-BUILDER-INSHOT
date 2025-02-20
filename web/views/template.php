<?php
/* ======================================
Perfil
====================================== */

$url = "profiles";
$method = "GET";
$fields = array();

$profile = CurlController::request($url,$method,$fields);

if($profile->status == 200){

    $profile = $profile->results[0];
    
}else{

    $profile = null;

}

/* ======================================
Fotos
====================================== */

$url = "photos";
$method = "GET";
$fields = array();

$photos = CurlController::request($url,$method,$fields);

if($photos->status == 200){

    $photos = $photos->results;
    
}else{

    $photos = array();
}

/*=============================================
Capturar parámetros de la url
=============================================*/

$routesArray = explode("/", $_SERVER["REQUEST_URI"]);

array_shift($routesArray);

foreach ($routesArray as $key => $value) {
	
	$routesArray[$key] = explode("?",$value)[0];
    
}

?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Inshot - Creative Responsive Photography  Portfolio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="/views/assets/css/reset.css">
        <link type="text/css" rel="stylesheet" href="/views/assets/plugins/plugins.css">
        <link type="text/css" rel="stylesheet" href="/views/assets/css/style.css">
        <link type="text/css" rel="stylesheet" href="/views/assets/css/yourstyle.css">
        <!-- https://icons.getbootstrap.com/ -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
        <!-- https://fontawesome.com/v5/search -->
	    <link rel="stylesheet" href="/views/assets/plugins/fontawesome-free/css/all.min.css">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="/views/assets/images/favicon.ico">
    </head>
    <body>
        <!--=============== Incluimos los Módulos ===============-->
        <!--  Incluimos modulo loader  --> 
            <?php include "modules/loader.php" ?>
        <!-- loader end -->
        <!--================= Main   ================-->
        <div id="main">
            <!-- Incluimos modulo header  -->
            <?php include "modules/header.php" ?>
            <!-- header  end -->

            <!--=============== wrapper ===============-->
            <?php if (!empty($routesArray[0])): ?>

            <?php if ($routesArray[0] == "portfolio" || $routesArray[0] == "blog" ): ?>
            
                <?php include "pages/".$routesArray[0]."/".$routesArray[0].".php" ?>
            
            <?php else: ?>
            
                <?php include "pages/home/home.php" ?>

            <?php endif ?>
            
            <?php else: ?>
            
                <?php include "pages/home/home.php" ?>
            
            <?php endif ?>
            
            <!-- wrapper end -->
            <!-- Incluimos modulo sidebar  -->
            <?php include "modules/sidebar.php" ?>
            <!-- sidebar end -->
            <!-- Incluimos modulo search  -->
            <?php include "modules/search.php" ?>
            <!--search-form-holder  end--> 
            <!-- Incluimos modulo footer  -->
            <?php include "modules/footer.php" ?>
            <!-- footer end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="/views/assets/plugins/jquery.min.js"></script>
        <script type="text/javascript" src="/views/assets/plugins/plugins.js"></script>
        <script type="text/javascript" src="/views/assets/js/scripts.js"></script>
    </body>
</html>