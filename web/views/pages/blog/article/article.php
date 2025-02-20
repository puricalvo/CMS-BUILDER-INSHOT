<?php 

if (!empty($routesArray[1])){

    $url = "blogs?linkTo=url_blog&equalTo=".$routesArray[1];
    $method = "GET";
    $fields = array();

    $article = CurlController::request($url,$method,$fields);
    

    if($article->status == 200){

        $article = $article->results[0];
        
    }else{

        $url = "blogs?linkTo=tags_blog&search=".$routesArray[1];
        $method = "GET";
        $fields = array();

        $article = CurlController::request($url,$method,$fields);
    

    if($article->status == 200){

        $article = $article->results[0];

    }else{

        $article = null;

    }
        
    }

}


?>

<div id="wrapper" class="heiginf">
    <!--Content -->
    <div class="content">
        <section class="big-pad-sec">
            <div class="container">
                <!-- post -->
                <div class="post fl-wrap fw-post">
                    <h2><span><?php echo urldecode($article->title_blog) ?></span></h2>
                    <ul class="blog-title-opt">
                        <li><?php echo TemplateController::formatDate(5,urldecode($article->date_created_blog)) ?></li>
                    </ul>
                    <!-- blog media -->
                    <div class="blog-media fl-wrap">
                        <div class="single-slider fl-wrap" data-effects="slide">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                <?php foreach (explode(",",urldecode($article->gallery_blog)) as $index => $item): ?>

                                        <div class="swiper-slide"><img src="<?php echo $item ?>" 
                                             alt="<?php echo urldecode($article->title_blog) ?>">
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
                                <?php foreach (explode(",",urldecode($article->tags_blog)) as $index => $item): ?>

                                    <li><a href="/blog/<?php echo urlencode($item) ?>"><?php echo $item ?></a></li>

                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php echo urldecode($article->article_blog) ?>
                    </div>
                    <div class="content-nav fl-wrap">
                        <ul>
                            <?php foreach ($blog as $key => $value): shuffle($blog); ?>

                                <?php if ($key < 2): ?>

                                     <li>
                                        <span>
                                        <?php if ($key == 0): ?>
                                            Prev 
                                        <?php else: ?>  
                                            Next
                                        <?php endif ?> 
                                        </span>
                                          <a href="/blog/<?php echo urldecode($value->url_blog) ?>"><?php echo urldecode($value->title_blog) ?></a>
                                    </li>


                                <?php endif ?>
  
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <!-- post end-->
                <!-- post-author-->                                   
                <div class="post-author">
                    <div class="author-img">
                        <img alt='' src="<?php echo urldecode($profile->image_profile) ?>" style="width:100px">	
                    </div>
                    <div class="author-content">
                        <h5><a href="#"><?php echo urldecode($profile->name_profile) ?></a></h5>
                        <p><?php echo urldecode($profile->description_profile) ?></p>
                        <div class="author-social">
                            <ul>

                                <?php foreach (json_decode(urldecode($profile->socials_profile)) as $key => $value):  ?>

                                    <li>
                                        <a href="<?php echo $value->link ?>" target="_blank" ><?php echo $value->icon ?></a>
                                    </li>

                                <?php endforeach ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <!--post-author end-->
            
            </div>
        </section>
    </div>
    <!-- content  end -->  
</div>