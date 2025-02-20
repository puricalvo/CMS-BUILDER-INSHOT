<?php 

$url = "files?linkTo=name_file&equalTo=".urlencode("video-banner")."&select=link_file";
$method = "GET";
$fields = array();

$videoBanner = CurlController::request($url,$method,$fields);

if($videoBanner->status == 200){

    $videoBanner = $videoBanner->results[0];
    
}else{

    $videoBanner = null;
}

?>


?>



<!-- sidebar -->
<div class="sb-overlay"></div>
<div class="hiiden-sidebar-wrap">
<!-- sb-widget-wrap-->
<div class="sb-widget-wrap fl-wrap">
    <h3>About The Inshot</h3>
    <div class="sb-widget about-widget fl-wrap">
        <img src="<?php echo urldecode($profile->image_profile) ?>" alt="">
        <p><?php echo urldecode($profile->description_profile) ?></p>
    </div>
</div>
<!-- sb-widget-wrap end-->
<!-- sb-widget-wrap-->
<div class="sb-widget-wrap fl-wrap">
    <h3>Our Story  video </h3>
    <div class="sb-widge video-widget   fl-wrap">
        <img src="<?php echo $videoBanner->link_file ?>"  class="respimg" alt=""> 
        <a href="<?php echo urldecode($profile->video_profile) ?>" class="image-popup"><i class="fa fa-play"></i></a>
    </div>
</div>
<!-- sb-widget-wrap end-->       
<!-- sb-widget-wrap-->
<div class="sb-widget-wrap fl-wrap">
    <h3>We're Are Social</h3>
    <div class="sb-widget    fl-wrap">
        <div class="sidebar-social fl-wrap">
            <ul>

                <?php foreach (json_decode(urldecode($profile->socials_profile)) as $key => $value):  ?>

                    <li><a href="<?php echo $value->link ?>" target="_blank" ><?php echo $value->icon ?></a></li>
                  
                <?php endforeach ?>

            </ul>
        </div>
    </div>
</div>
<!-- sb-widget-wrap end-->            
</div>