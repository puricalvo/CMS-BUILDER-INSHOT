<?php 

/*=============================================
Categorias
=============================================*/

$url = "categories";
$method = "GET";
$fields = array();

$categories = CurlController::request($url,$method,$fields);

if($categories->status == 200){

    $categories = $categories->results;
   
  
}else{

    $categories = array();
    
}

?>

<div id="wrapper" class="heiginf">
    <!--Content -->
    <div class="content">
        <!--  filter -->    
        <div class="inline-filter">
            <div class="filter-button">Filter : </div>
            <div class="gallery-filters">
                <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*">All</a>

                <?php if (!empty($categories)): ?>

                    <?php foreach ($categories as $key => $value): ?>
                        
                        <a href="#" class="gallery-filter" data-filter=".<?php echo $value->class_category ?>"><?php echo $value->title_category ?></a>

                    <?php endforeach ?>
                    
                <?php endif ?>
               
            </div>
        </div>
        <!--  filter end --> 
        <!--  gallery-items -->
        <div class="gallery-items hid-det-items">

            <?php if (!empty($photos)): ?>

                <?php foreach ($photos as $key => $value): ?>

                     <!-- gallery-item -->
                    <div class="gallery-item <?php echo str_replace(","," ",urldecode($value->categories_photo)) ?> <?php echo urldecode($value->class_photo) ?>">
                        <div class="grid-item-holder">
                            <img  src="<?php echo urldecode($value->file_photo) ?>"   alt="<?php echo urldecode($value->title_photo) ?>">
                            <a data-src="<?php echo urldecode($value->file_photo) ?>" class="single-popup-image slider-zoom">
                            <i class="fa fa-search"></i> 
                            </a>
                            <div class="thumb-info">
                                <h3><?php echo urldecode($value->title_photo) ?></h3>
                                <p><?php echo urldecode($value->description_photo) ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- gallery-item end -->

                <?php endforeach ?>

            <?php endif ?>
                                                       
        </div>
    </div>
    <!-- content  end -->  
</div>