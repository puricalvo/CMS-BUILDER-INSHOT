<!--=============== wrapper ===============-->
<div id="wrapper" class="fullsceen-wrap">
                <!--Content -->
                <div class="content full-height">
                    <div class="slider-wrap homecarousel hompad  lightgallery lg-synk">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <!-- swiper-slide--> 
                                <div class="swiper-slide">
                                    <div class="intro-title full-height">
                                        <div class="intro-title-wrap alt">
                                            <h2><?php echo $profile->name_profile ?></h2>
                                            <h3><?php echo $profile->about_profile ?></h3>
                                            <span class="separator sep-b"></span>
                                            <div class="clearfix"></div>
                                            <a href="/portfolio" class="btn">View Portfolio</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- swiper-slide end--> 
                            <?php if (!empty($photos)): shuffle($photos); ?> 

                                <?php foreach ($photos as $key => $value): ?>

                                    <?php if ($key < 7): ?>

                                        <!-- swiper-slide-->  
                                        <div class="swiper-slide">
                                            <img  src="<?php echo urldecode($value->file_photo) ?>" alt="<?php echo urldecode($value->title_photo) ?>">
                                            <div class="thumb-info">
                                                <h3><?php echo urldecode($value->title_photo) ?></h3>
                                                <p><?php echo urldecode($value->description_photo) ?></p>
                                            </div>
                                        </div>
                                        <!-- swiper-slide end--> 
                                     
                                    <?php endif ?>

                                <?php endforeach ?>

                            <?php endif ?>
                             
                            </div>
                            <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                        </div>
                    </div>
                </div>
                <!-- content  end -->  
            </div>