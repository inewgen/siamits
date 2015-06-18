<!--Start Home Page Slider -->
<section id="home">
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
<?php foreach ($banners as $key => $banner): ?>
        <li data-target="#main-slide" data-slide-to="<?php echo $key;?>" <?php if($key == '0'):?>class="active"<?php endif;?>></li>
<?php endforeach;?>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
<?php foreach ($banners as $key => $banner): ?>
            <div class="item <?php if($key == '0'):?>active<?php endif;?>">
                <img class="img-responsive" src="<?php echo array_get($banner, 'images.0.url', '');?>" alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated2">
                          <span><?php echo $banner['title'];?></span>
                        </h2>
                        <h3 class="animated3">
                            <span><?php echo $banner['subtitle'];?></span>
                        </h3>
<?php       if($banner['button'] == '1' && !empty($banner['button_title'])):?>
                        <p class="animated4"><a href="<?php echo $banner['button_url'];?>" class="slider btn btn-primary"><?php echo $banner['button_title'];?></a>
                        </p>
<?php       endif;?>
                    </div>
                </div>
            </div>
<?php endforeach;?>
            <!--/ Carousel item end -->
            
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="<?php echo URL::to('public/themes/margo');?>/#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="<?php echo URL::to('public/themes/margo');?>/#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
    </div>
    <!-- /carousel -->
</section>
<!-- End Home Page Slider -->

<!-- Start Services Section -->
<div class="section service">
    <div class="container">
        <div class="row">

            <!-- Start Service Icon 1 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                <a href="<?php echo URL::to('health');?>">
                    <div class="service-icon">
                        <i class="fa fa-leaf icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Health</h4>
                        <p>แหล่งรวบความรู้เกี่ยวกับสุขภาพ ทริปและเทคนิคในการลดน้ำหนัก และอีกมากมาย</p>

                    </div>
                </a>
            </div>
            <!-- End Service Icon 1 -->

            <!-- Start Service Icon 2 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="02">
                <a href="<?php echo URL::to('technology');?>">
                    <div class="service-icon">
                        <i class="fa fa-desktop icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Technology</h4>
                        <p>อัพเดทเทคโนโลยีสมัยใหม่ที่ก้าวหน้า ล้ำยุค ทันสมัย มาใหม่ได้ก่อนใคร</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 2 -->

            <!-- Start Service Icon 3 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="03">
                <a href="<?php echo URL::to('photography');?>">
                    <div class="service-icon">
                        <i class="fa fa-eye icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Photography</h4>
                        <p>รวมเทคนิดในการถ่ายภาพ การตกแต่งภาพสุดสวย สุดชิก ด้วยเทคนิดและวิธีการที่แปลกใหม่ ให้ภาพคุณดูดีมีสไตส์</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 3 -->

            <!-- Start Service Icon 4 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="04">
                <a href="<?php echo URL::to('programming');?>">
                    <div class="service-icon">
                        <i class="fa fa-code icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Programming</h4>
                        <p>เรียนรู้การเขียนโปรแกรม PHP ASP C# VB C และอีกมากมาย รวมเทคนิด และวิธีการเขียนโปรแกรมที่ดี</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 4 -->

            <!-- Start Service Icon 5 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="05">
                <a href="<?php echo URL::to('news');?>">
                    <div class="service-icon">
                        <i class="fa fa-rocket icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>News</h4>
                        <p>อัพเดทข่าวสารที่รวดเร็ว ทันใจ ทุกเรื่องราวความเคลื่อนไหว ทั้งสังคมไอที และอื่น ๆ</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 5 -->

            <!-- Start Service Icon 6 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="06">
                <a href="<?php echo URL::to('pages');?>">
                    <div class="service-icon">
                        <i class="fa fa-css3 icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Pages</h4>
                        <p>แหล่งรวมบทความสาระความรู้ต่าง ๆ ทิกและเทคนิดต่าง ๆ มากมาย</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 6 -->

            <!-- Start Service Icon 7 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="07">
                <a href="<?php echo URL::to('gallery');?>">
                    <div class="service-icon">
                        <i class="fa fa-download icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Gallery</h4>
                        <p>แหล่งรวบรวมภาพถ่าย ภาพแต่ง และภาพต่าง ๆ ที่สวยงาม</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 7 -->

            <!-- Start Service Icon 8 -->
            <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="08">
                <a href="<?php echo URL::to('support');?>">
                    <div class="service-icon">
                        <i class="fa fa-umbrella icon-large"></i>
                    </div>
                    <div class="service-content">
                        <h4>Help & Support</h4>
                        <p>รวมการใช้งานเว็บไซ์ คำถามตอบมากมายจากสมาชิก เกี่ยวกับเว็บไซ์ และอื่น ๆ</p>
                    </div>
                </a>
            </div>
            <!-- End Service Icon 8 -->

        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- End Services Section -->


<!-- Start Purchase Section -->
<div class="section purchase" style="background: url(<?php echo URL::to('public/themes/margo');?>/assets/img/patterns/1.png) fixed repeat;">
    <div class="container">

        <!-- Start Video Section Content -->
        <div class="section-video-content text-center">

            <!-- Start Animations Text -->
            <h1 class="fittext wite-text uppercase tlt">
              <span class="texts">
                <span>Modern</span>
                <span>Clean</span>
                <span>Awesome</span>
                <span>Cool</span>
                <span>Great</span>
              </span>
                SiamiTs Website is Ready for <br/>Learning Society <strong>or</strong> Creative Society
            </h1>
            <!-- End Animations Text -->


            <!-- Start Buttons -->
            <a href="<?php echo URL::to('register');?>" class="btn-system btn-large border-btn btn-wite"><i class="fa fa-tasks"></i> Join with us</a>
            <!-- <a href="<?php echo URL::to('public/themes/margo');?>/#" class="btn-system btn-large btn-wite"><i class="fa fa-download"></i> Purchase This Now</a> -->

        </div>
        <!-- End Section Content -->

    </div>
    <!-- .container -->
</div>
<!-- End Purchase Section -->

<!-- Start Testimonials Section -->
<div>
    <div class="container">
        <div class="row">
            <br><br>
            <div class="col-md-8">

                <!-- Start Recent Posts Carousel -->
                <div class="latest-posts">
                    <h4 class="classic-title"><span>Hilight News</span></h4>
                    <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2">

<?php if(isset($news['highlight']) && is_array($news['highlight'])):?>
<?php foreach ($news['highlight'] as $key => $value):?>
<?php   
            $dt = $value['updated_at'];
            $dt = new DateTime($dt);

            $d = $dt->format('d');
            $m = $dt->format('m');

            $dateObj   = DateTime::createFromFormat('!m', $m);
            $m = $dateObj->format('M'); 
?>
                        <div class="post-row item">
                            <div class="left-meta-post">
                                <div class="post-date"><span class="day"><?php echo $d;?></span><span class="month"><?php echo $m;?></span></div>
                                <div class="post-type"><i class="fa fa-picture-o"></i></div>
                            </div>
                            <h3 class="post-title">
                            <a href="<?php echo URL::to('news/'.$value['id']);?>">
                            <?php echo htmlspecialchars($value['title']); ?>
                            </a></h3>
                            <div class="post-content">
                                <img src="<?php echo array_get($value, 'images.0.url', '');?>" alt="" width="200"/>
                                <p>
                                <?php echo htmlspecialchars($value['sub_description']); ?>
                                <a class="read-more" href="<?php echo URL::to('news/'.$value['id']);?>">Read More...</a>
                                </p>
                            </div>
                        </div>
<?php endforeach;?>
<?php endif;?>

                    </div>
                </div>
                <!-- End Recent Posts Carousel -->

            </div>

            <div class="col-md-4">

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Quotes</span></h4>

                <!-- Start Testimonials Carousel -->
                <div class="custom-carousel show-one-slide touch-carousel" data-appeared-items="1">
                    <!-- Testimonial 1 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <img src="<?php echo URL::to('public/themes/margo');?>/assets/img/steve_jobs.png" alt="" />
                            <p>Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.</p>
                            <br>
                            <p>ในบางครั้งเมื่อคุณสร้างนวัตกรรมคุณก็สร้างสิ่งที่ผิดพลาด สิ่งที่ดีที่สุดคือคุณยอมรับความผิดพลาดนั้นอย่างรวดเร็ว และ พัฒนามันในนวัตกรรมอื่นๆของคุณ</p>
                        </div>
                        <div class="testimonial-author"><span>Steve Jobs</span> - Cofounder, Chairman, and CEO of Apple Inc.</div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="testimonial-author"><span>John Doe</span> - Customer</div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="testimonial-author"><span>Steve Jobs</span> - Cofounder, Chairman, and CEO of Apple Inc.</div>
                    </div>
                </div>
                <!-- End Testimonials Carousel -->

            </div>
        </div>
    </div>
</div>
<!-- End Testimonials Section -->

<!-- Start Team Member Section -->
<div class="section last-news" style="background:#fff;">
    <div class="container">

        <!-- Start Big Heading -->
        <div class="big-title text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1><strong>Latest News</strong> and <strong>Pages</strong></h1>
        </div>
        <!-- End Big Heading -->

        <!-- Some Text -->
        <!-- <p class="text-center">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium <span class="accent-color sh-tooltip" data-placement="right" title="Simple Tooltip">doloremque laudantium</span>, totam rem aperiam, eaque ipsa quae ab illo inventore
        <br/>veritatis et quasi <span class="accent-color sh-tooltip" data-placement="bottom" title="Simple Tooltip">architecto</span> beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
 -->
        <!-- Start Team Members -->
        <div class="row">

<?php if(isset($news['general']) && is_array($news['general'])):?>
<?php foreach ($news['general'] as $key => $value):?>
<?php   
            $dt = $value['updated_at'];
            $dt = new DateTime($dt);

            $d = $dt->format('d');
            $m = $dt->format('m');
            $y = $dt->format('Y');

            $dateObj   = DateTime::createFromFormat('!m', $m);
            $m = $dateObj->format('M'); 
?>
            <!-- Start Memebr 1 -->
            <div class="col-md-3 col-sm-6 col-xs-12" data-animation="fadeIn" data-animation-delay="03">
                <div class="team-member modern">
                    <!-- Memebr Photo, Name & Position -->
                    <div class="member-photo">
                        <img alt="" src="<?php echo array_get($value, 'images.0.url', '');?>" />
                        <div class="member-name"><?php echo htmlspecialchars($value['title']); ?><span><?php echo $d;?> <?php echo $d;?> <?php echo $y;?></span>
                        </div>
                    </div>
                    <!-- Memebr Words -->
                    <div class="member-info">
                        <p><?php echo htmlspecialchars($value['sub_description']); ?><a class="read-more" href="<?php echo URL::to('news/'.$value['id']);?>">Read More...</a></p>
                    </div>
                    <!-- Memebr Social Links -->
                    <div class="member-socail">
                        <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="gplus" href="#"><i class="fa fa-google-plus"></i></a>
                        <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                        <a class="flickr" href="#"><i class="fa fa-flickr"></i></a>
                        <a class="mail" href="#"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <!-- End Memebr 1 -->
<?php endforeach;?>
<?php endif;?>

        </div>
        <!-- End Team Members -->

    </div>
    <!-- .container -->
</div> 
<!-- End Team Member Section -->

<!-- Start Client/Partner Section -->
<div class="partner">
    <div class="container">
        <div class="row">

            <!-- Start Big Heading -->
            <div class="big-title text-center">
                <h1>Suggestion Website <strong>URLs</strong></h1>
                <p class="title-desc">Popular we Recommend</p>
            </div>
            <!-- End Big Heading -->

            <!--Start Clients Carousel-->
            <div class="our-clients">
                <div class="clients-carousel custom-carousel touch-carousel navigation-3" data-appeared-items="5" data-navigation="true">

                    <!-- Client 1 -->
                    <div class="client-item item">
                        <a href="https://www.google.co.th" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_google.png" alt="" /></a>
                    </div>

                    <!-- Client 2 -->
                    <div class="client-item item">
                        <a href="http://www.sanook.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_sanook.png" alt="" /></a>
                    </div>

                    <!-- Client 3 -->
                    <div class="client-item item">
                        <a href="http://www.mthai.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_mthai.png" alt="" /></a>
                    </div>

                    <!-- Client 4 -->
                    <div class="client-item item">
                        <a href="http://www.kapook.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_kapook.png" alt="" /></a>
                    </div>

                    <!-- Client 5 -->
                    <div class="client-item item">
                        <a href="http://www.ch7.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_ch7.png" alt="" /></a>
                    </div>

                    <!-- Client 6 -->
                    <div class="client-item item">
                        <a href="http://www.thaitv3.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_thaitv3.png" alt="" /></a>
                    </div>

                    <!-- Client 7 -->
                    <div class="client-item item">
                        <a href="http://www.mcot.net" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_mcot.png" alt="" /></a>
                    </div>

                    <!-- Client 8 -->
                    <div class="client-item item">
                        <a href="http://www.posttoday.com" target="_blank"><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/urls_logo_posttoday.png" alt="" /></a>
                    </div>

                </div>
            </div>
            <!-- End Clients Carousel -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- End Client/Partner Section