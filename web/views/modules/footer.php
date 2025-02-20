 <!-- footer -->
<footer class="fixed-footer">
    <div class="policy-box">
        <span>&#169; Inshot <? echo date("Y")  ?>  /  All rights reserved. </span>
    </div>
    <div class="swiper-pagination footer-counter"></div>
    <div class="footer-social">
        <ul>

             <?php foreach (json_decode(urldecode($profile->socials_profile)) as $key => $value):  ?>

                <li><a href="<?php echo $value->link ?>" target="_blank"><?php echo $value->icon ?>
                <span><?php echo $value->tipo ?></span></a></li>
                
             <?php endforeach ?>

            
        </ul>
    </div>
</footer>