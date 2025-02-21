<?php 
/* ======================================
Blog
====================================== */

$url = "blogs?orderBy=order_blog&orderMode=ASC";
$method = "GET";
$fields = array();

$blog = CurlController::request($url,$method,$fields);

if($blog->status == 200){

    $blog = $blog->results;
    
}else{

    $blog = array();
}


?>


<?php if (!empty($routesArray[1])): ?>

    <?php include "article/article.php" ?>

<?php else: ?>

<div id="wrapper" class="heiginf">
    <!--Content -->
    <div class="content">
        <div class="fixed-column">
            <div class="bg"  data-bg="<?php echo urldecode($photos[8]->file_photo) ?>"></div>
            <div class="overlay"></div>
            <div class="fixed-column-content-wrap">
                <h2>Our Last News</h2>
                <h4>Praesent nec leo venenatis elit semper aliquet id ac enim.</h4>
                <span class="separator inline-sep sep-w"></span>
				
            </div>
        </div>
        <div class="column-wrap">
            <section class="big-pad-sec">
                <div class="container">

                    <?php if (!empty($blog)): ?>

                        <?php foreach ($blog as $key => $value): ?>

                            <!-- post -->
                            <div class="post fl-wrap fw-post">
                                <h2><span><?php echo urldecode($value->title_blog) ?></span></h2>
                                <ul class="blog-title-opt">
                                    <li>
                                        <a href="/blog/<?php echo urldecode($value->url_blog) ?>">
                                            <?php echo TemplateController::formatDate(5,urldecode($value->date_created_blog)) ?></a>
                                    </li>
                                </ul>
                                <!-- blog media -->
                                <div class="blog-media fl-wrap">
                                    <div class="single-slider fl-wrap" data-effects="slide">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">

                                                <?php foreach (explode(",",urldecode($value->gallery_blog)) as $index => $item): ?>

                                                    <div class="swiper-slide"><img src="<?php echo $item ?>" 
                                                         alt="<?php echo urldecode($value->title_blog) ?>">
                                                    </div>

                                                <?php endforeach ?>

                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- blog media end -->
                                <div class="blog-text fl-wrap">
                                    <div class="pr-tags fl-wrap">
                                        <span>Tags : </span>
                                            <ul>

                                                <?php foreach (explode(",",urldecode($value->tags_blog)) as $index => $item): ?>

                                                    <li><a href="/blog/<?php echo urlencode($item) ?>"><?php echo $item ?></a></li>

                                                <?php endforeach ?>
                                                
                                            </ul>
                                    </div>
                                    <p>
                                        <?php echo urldecode($value->abstract_blog)?>
                                    </p>
                                    <a href="/blog/<?php echo urldecode($value->url_blog) ?>" class="btn float-btn flat-btn">Read more </a>
                                </div>
                            </div>
                            <!-- post end-->

                        <?php endforeach ?>
                        
                    <?php endif ?>

                </div>
            </section>
        </div>
        <!--column wrap -->                     
    </div>
    <!-- content  end -->  
</div>
<?php endif ?>