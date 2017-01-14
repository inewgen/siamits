
<?php
if (isset($layout) && is_array($layout)) {
    foreach ($layout as $key => $value) {
        // Banners
        if ($value == 'banners') {
            getBanners($banners);
        }

        // Services
        if ($value == 'service') {
            getServices();
        }

        // Subbanners
        if ($value == 'subbanners') {
            getSubbanners();
        }

        // Video
        if ($value == 'video') {
            getYoutube($youtube);
        }

        // Hnews
        if ($value == 'hnews') {
            getHighlightNews($news['highlight']);
        }

        // News
        if ($value == 'news') {
            getNews($news['general']);
        }

        // Hpages
        if ($value == 'hpages') {
            getHighlightPages($pages['highlight'], $quotes);
        }

        // Pages
        if ($value == 'pages') {
            getPages($pages['general']);
        }

        // Urls
        if ($value == 'urls') {
            getClient();
        }
    }
}
?>

<?php

// Banners
function getBanners($banners)
{?>
    <!--Start Home Page Slider -->
    <section id="home">
        <!-- Carousel -->
        <div id="main-slide" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ol class="carousel-indicators">
    <?php foreach ($banners as $key => $banner): ?>
            <li data-target="#main-slide" data-slide-to="<?php echo $key;?>" <?php if ($key == '0'): ?>class="active"<?php endif;?>></li>
    <?php endforeach;?>
            </ol>
            <!--/ Indicators end-->

            <!-- Carousel inner -->
            <div class="carousel-inner">
    <?php foreach ($banners as $key => $banner): ?>
                <div class="item <?php if ($key == '0'): ?>active<?php endif;?>">
                    <img class="img-responsive" src="<?php echo array_get($banner, 'images.0.url', '');?>" alt="slider" width="1440" height="500">
                    <div class="slider-content">
                        <div class="col-md-12 text-center">
                            <h2 class="animated2">
                              <span><?php echo $banner['title'];?></span>
                            </h2>
                            <h3 class="animated3">
                                <span><?php echo $banner['subtitle'];?></span>
                            </h3>
    <?php if ($banner['button'] == '1' && !empty($banner['button_title'])): ?>
                            <p class="animated4"><a href="<?php echo $banner['button_url'];?>" class="slider btn btn-primary"><?php echo $banner['button_title'];?></a>
                            </p>
    <?php endif;?>
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
<?php
}

// Services
function getServices()
{?>
    <!-- Start Services Section -->
    <div class="section service">
        <div class="container">
            <div class="row">

                <!-- Start Service Icon 1 -->
                <div class="col-md-3 col-sm-6 service-box service-center" data-animation="fadeIn" data-animation-delay="01">
                    <a href="<?php echo URL::to('pages/category/4');?>">
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
                    <a href="<?php echo URL::to('pages/category/1');?>">
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
                    <a href="<?php echo URL::to('pages/category/6');?>">
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
                    <a href="<?php echo URL::to('pages/category/5');?>">
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
                    <a href="<?php echo URL::to('clips');?>">
                        <div class="service-icon">
                            <i class="fa fa-download icon-large"></i>
                        </div>
                        <div class="service-content">
                            <h4>Clips VDO</h4>
                            <p>แหล่งรวบรวมคลิปวีดีโอ ต่าง ๆ จาก youtube</p>
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
<?php
}

// Subbanners
function getSubbanners()
{?>
    <!-- Start Subbanners Section -->
    <div class="section purchase" style="background: url(<?php echo getImageLink('img', 'patterns', '15', 'jpg', 1440, 500, 'bg.jpg');?>) fixed repeat;">
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
    <!-- End Subbanners Section -->
<?php
}

// Youtube
function getYoutube($youtube)
{?>
    <!-- Start Youtube Section -->
    <div  class="section service">
        <div class="container">
            <!-- Start Recent Projects Carousel -->
            <div class="recent-projects">
                <h4 class="classic-title">
                    <span>Popular Video Feed</span>
                </h4>
                <div class="projects-carousel touch-carousel">

    <?php if (isset($youtube) && is_array($youtube)): ?>
    <?php foreach ($youtube as $key => $value): ?>
                    <div class="portfolio-item item">
                        <div class="portfolio-border">
                            <div class="portfolio-thumb">

                            <?php if (isMobile()): ?>
                                <iframe class="video-iframe" title="" type="text/html" src="http://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>?rel=0&autohide=1&showinfo=0" frameborder=0 allowfullscreen="true"></iframe>
                            <?php else: ?>
                                <a class="lightbox" data-lightbox-type="ajax" href="https://www.youtube.com/watch?v=<?php echo array_get($value, 'id', '');?>">
                                    <div class="thumb-overlay">
                                        <i class="fa fa-play"></i>
                                    </div>
                                    <img alt="" src="<?php echo array_get($value, 'images.medium', '');?>" />
                                </a>
                            <?php endif;?>

                            </div>
                            <div class="portfolio-details youtube-details">
                                <!-- <a class="lightbox" data-lightbox-type="ajax" href="https://www.youtube.com/watch?v=<?php echo array_get($value, 'id', '');?>"> -->
                                    <h5><?php echo array_get($value, 'title', '');?></h5>
                            <?php if ($channelTitle = array_get($value, 'channelTitle', false)): ?>
                                    <span><?php echo $channelTitle;?></span>
                            <?php endif;?>
                                    <span><font color="color">Youtube</font> <span class="hide-sm"><i class="fa fa-youtube-square fa-4"></i>&nbsp;&nbsp;</span>
                                        <!-- <img src="<?php echo getImageLink('img', 'default', 'youtube_logo', 'jpg', 40, 30, 'youtube.jpg');?>"> -->
                                    </span>
                                <!-- </a> -->
                            </div>
                        </div>
                    </div>
    <?php endforeach;?>
    <?php endif;?>

                </div>
            </div>
            <!-- End Recent Projects Carousel -->
        </div>
        <!-- .container -->
    </div>
    <!-- End Youtube Section -->
<?php
}

// Highlight news
function getHighlightNews($data)
{
    ?>
    <!-- Start Highlight News Section -->
    <div>
        <div class="container">
            <div class="row">
                <br><br>
                <div class="col-md-8">

                    <!-- Start Recent Posts Carousel -->
                    <div class="latest-posts">
                        <h4 class="classic-title"><span>Hilight News</span></h4>
                        <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2">

    <?php if (isset($data) && is_array($data)): ?>
    <?php foreach ($data as $key => $value): ?>
    <?php
$dt = $value['updated_at'];
    $dt = new DateTime($dt);

    $d = $dt->format('d');
    $m = $dt->format('m');

    $dateObj = DateTime::createFromFormat('!m', $m);
    $m = $dateObj->format('M');
    ?>
                            <div class="post-row item">
                                <div class="left-meta-post">
                                    <div class="post-date"><span class="day"><?php echo $d;?></span><span class="month"><?php echo $m;?></span></div>
                                    <div class="post-type"><i class="fa fa-picture-o"></i></div>
                                </div>
                                <h5 class="post-title">
                                    <a href="<?php echo URL::to('news/' . $value['id']);?>">
                                        <img width="250" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 250, 179, array_get($value, 'images.0.name', ''));?>" alt=""/>
                                        <br>
                                        <?php echo htmlspecialchars($value['title']);?>
                                    </a>
                                </h5>
                                <div class="post-content">

                                    <p>
                                    <?php echo htmlspecialchars($value['sub_description']);?>
                                    <a class="read-more" href="<?php echo URL::to('news/' . $value['id']);?>">Read More...</a>
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
                    <h4 class="classic-title"><span>Weather</span></h4>

                    <!-- Start Testimonials Carousel -->
                    <div class="custom-carousel show-one-slide touch-carousel" data-appeared-items="1">

                        <!-- Testimonial 1 -->
                        <div class="classic-testimonials item">
                            <div class="testimonial-content" id="weather_7">

                            </div>
                        </div>

                        <!-- Testimonial 2 -->
    <?php for ($i = 1; $i <= 6; $i++): ?>
                        <div class="classic-testimonials item">
                            <div class="testimonial-content" id="weather_<?php echo $i;?>">

                            </div>
                        </div>
    <?php endfor;?>

                    </div>
                    <!-- End Testimonials Carousel -->

                </div>
            </div>
        </div>
    </div>
    <!-- End Highlight News Section -->
<?php
}

// Highlight pages
function getHighlightPages($data, $quotes)
{
    ?>
    <!-- Start Highlight News Section -->
    <div>
        <div class="container">
            <div class="row">
                <br><br>
                <div class="col-md-8">

                    <!-- Start Recent Posts Carousel -->
                    <div class="latest-posts">
                        <h4 class="classic-title"><span>Hilight Pages</span></h4>
                        <div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="2">

    <?php if (isset($data) && is_array($data)): ?>
    <?php foreach ($data as $key => $value): ?>
    <?php
$dt = $value['updated_at'];
    $dt = new DateTime($dt);

    $d = $dt->format('d');
    $m = $dt->format('m');

    $dateObj = DateTime::createFromFormat('!m', $m);
    $m = $dateObj->format('M');
    ?>
                            <div class="post-row item">
                                <div class="left-meta-post">
                                    <div class="post-date"><span class="day"><?php echo $d;?></span><span class="month"><?php echo $m;?></span></div>
                                    <div class="post-type"><i class="fa fa-picture-o"></i></div>
                                </div>
                                <h5 class="post-title">
                                    <a href="<?php echo URL::to('pages/' . $value['id']);?>">
                                        <img width="250" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 250, 179, array_get($value, 'images.0.name', ''));?>" alt=""/>
                                        <br>
                                        <?php echo htmlspecialchars($value['title']);?>
                                    </a>
                                </h5>
                                <div class="post-content">

                                    <p>
                                    <?php echo htmlspecialchars($value['sub_description']);?>
                                    <a class="read-more" href="<?php echo URL::to('pages/' . $value['id']);?>">Read More...</a>
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

<?php foreach ($quotes as $key => $value): ?>
                        <!-- Testimonial 2 -->
                        <div class="classic-testimonials item">
                            <div class="testimonial-content">
                                <img src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 320, 180, array_get($value, 'images.0.name', ''));?>" alt="" />
                                <p>&nbsp;</p>
                                <p><?php echo array_get($value, 'description', '');?></p>
                            </div>
                            <div class="testimonial-author"><?php echo array_get($value, 'author', '');?></div>
                        </div>
<?php endforeach;?>

                    </div>
                    <!-- End Testimonials Carousel -->

                </div>
            </div>
        </div>
    </div>
    <!-- End Highlight News Section -->
<?php
}

// News
function getNews($data)
{
    ?>
    <!-- Start News Section -->
    <div class="project">
        <div class="container">
            <!-- Start Recent Projects Carousel -->
            <div class="recent-projects">
                <h4 class="classic-title">
                    <span>Recent News</span>
                </h4>
            </div>

            <!-- Start Recent Posts Carousel -->
            <div class="row latest-posts-classic">

    <?php if (isset($data) && is_array($data)): ?>
    <?php foreach ($data as $key => $value):
        $dt = $value['updated_at'];
        $dt = new DateTime($dt);

        $d = $dt->format('d');
        $m = $dt->format('m');
        $y = $dt->format('Y');

        $dateObj = DateTime::createFromFormat('!m', $m);
        $m = $dateObj->format('M');
        ?>
	                <!-- Post 1 -->
	                <div class="col-md-3 post-row">
	                    <div class="left-meta-post">
	                        <div class="post-date">
	                            <span class="day">
	                                <?php echo $d;?>
	                            </span>
	                            <span class="month">
	                                <?php echo $m;?>
	                            </span>
	                        </div>
	                        <div class="post-type"><i class="fa fa-picture-o"></i></div>
	                    </div>
	                    <h5 class="post-title">
	                        <a href="<?php echo URL::to('news/' . $value['id']);?>">
	                            <img width="200" height="143" alt="" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 200, 143, array_get($value, 'images.0.name', ''));?>" />
	                            <br>
	                            <?php echo htmlspecialchars($value['title']);?>
	                        </a>
	                    </h5>
	                    <div class="post-content">
	                        <p>
	                            <?php echo htmlspecialchars(mb_substr($value['sub_description'], 0, 70, 'UTF-8'));?>
	                            <a class="read-more" href="<?php echo URL::to('news/' . $value['id']);?>">
	                                Read More...
	                            </a>
	                        </p>
	                    </div>
	                </div>
	    <?php endforeach;?>
    <?php endif;?>

            </div>
        </div>
    </div>
<?php
}

// Pages
function getPages($data)
{
    ?>
    <!-- Start News Section -->
    <div class="project">
        <div class="container">
            <!-- Start Recent Projects Carousel -->
            <div class="recent-projects">
                <h4 class="classic-title">
                    <span>Recent Pages</span>
                </h4>
            </div>

            <!-- Start Recent Posts Carousel -->
            <div class="row latest-posts-classic">

    <?php if (isset($data) && is_array($data)): ?>
    <?php foreach ($data as $key => $value):
        $dt = $value['updated_at'];
        $dt = new DateTime($dt);

        $d = $dt->format('d');
        $m = $dt->format('m');
        $y = $dt->format('Y');

        $dateObj = DateTime::createFromFormat('!m', $m);
        $m = $dateObj->format('M');
        ?>
	                <!-- Post 1 -->
	                <div class="col-md-3 post-row">
	                    <div class="left-meta-post">
	                        <div class="post-date">
	                            <span class="day">
	                                <?php echo $d;?>
	                            </span>
	                            <span class="month">
	                                <?php echo $m;?>
	                            </span>
	                        </div>
	                        <div class="post-type"><i class="fa fa-picture-o"></i></div>
	                    </div>
	                    <h5 class="post-title">
	                        <a href="<?php echo URL::to('pages/' . $value['id']);?>">
	                            <img width="200" height="143" alt="" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 200, 143, array_get($value, 'images.0.name', ''));?>" />
	                            <br>
	                            <?php echo htmlspecialchars($value['title']);?>
	                        </a>
	                    </h5>
	                    <div class="post-content">
	                        <p>
	                            <?php echo htmlspecialchars(mb_substr($value['sub_description'], 0, 70, 'UTF-8'));?>
	                            <a class="read-more" href="<?php echo URL::to('pages/' . $value['id']);?>">
	                                Read More...
	                            </a>
	                        </p>
	                    </div>
	                </div>
	    <?php endforeach;?>
    <?php endif;?>

            </div>
        </div>
    </div>
<?php
}

// Client
function getClient()
{?>
    <!-- Start Client/Partner Section -->
    <div class="project">
        <div class="container">
            <!-- Start Recent Projects Carousel -->
            <div class="recent-projects">
                <h4 class="classic-title">
                    <span>Suggestion Website URLs</span>
                </h4>
            </div>

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
        <!-- .container -->
    </div>
    <!-- End Client/Partner Section -->
<?php
}
?>

