<!-- Start Footer Section -->
<footer>
    <div class="container">
        <div class="row footer-widgets">


            <!-- Start Subscribe & Social Links Widget -->
            <div class="col-md-3 col-xs-12">
                <div class="footer-widget mail-subscribe-widget">
                    <h4>Get news from us<span class="head-line"></span></h4>
                    <p>Join our mailing list to stay up to date and get notices about our new releases!</p>
                    <form class="subscribe" action="<?php echo URL::to('register');?>" method="get">
                        <!-- <input type="text" placeholder="mail@example.com"> -->
                        <input type="submit" class="main-button" value="Register">
                    </form>
                    <!-- <a class="main-button" href="<?php echo URL::to('register');?>">Register</a> -->
                </div>
                <div class="footer-widget social-widget">
                    <h4>Follow Us<span class="head-line"></span></h4>
                    <ul class="social-icons">
                        <li>
                            <a class="facebook" href="https://www.facebook.com/siamits" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <!-- <li>
                            <a class="twitter" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-twitter"></i></a>
                        </li> -->
                        <li>
                            <a class="google" href="https://plus.google.com/103098765144574170914" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <!-- <li>
                            <a class="dribbble" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-dribbble"></i></a>
                        </li>
                        <li>
                            <a class="linkdin" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a class="flickr" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-flickr"></i></a>
                        </li>
                        <li>
                            <a class="tumblr" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-tumblr"></i></a>
                        </li>
                        <li>
                            <a class="instgram" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="vimeo" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-vimeo-square"></i></a>
                        </li>
                        <li>
                            <a class="skype" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-skype"></i></a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!-- .col-md-3 -->
            <!-- End Subscribe & Social Links Widget -->


            <!-- Start Twitter Widget -->
            <div class="col-md-3 col-xs-12">
                <div class="footer-widget twitter-widget">
                    <h4>Members Feed<span class="head-line"></span></h4>
                    <ul id="members_feed">
                        <li>
                            <p><a href="<?php echo URL::to('members');?>">@siamitslab </a> สมัครสมาชิกยังไง เข้าเมนูไหน</p>
                            <span>9 April 2015</span>
                        </li>
                        <li>
                            <p><a href="<?php echo URL::to('members');?>">@siamitslab </a> เข้าใช้งานเว็บบอร์อย่างไร</p>
                            <span>9 April 2015</span>
                        </li>
                        <li>
                            <p><a href="<?php echo URL::to('members');?>">@siamitslab </a> เป็นเว็บไซต์ที่มีประโยชน์มากนะครับ</p>
                            <span>9 April 2015</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- .col-md-3 -->
            <!-- End Twitter Widget -->


            <!-- Start Flickr Widget -->
            <div class="col-md-3 col-xs-12">
                <div class="footer-widget flickr-widget">
                    <h4>IT New Gadget Feed<span class="head-line"></span></h4>
                    <ul class="flickr-list">
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr01', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr01', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr02', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr02', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr03', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr03', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr04', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr04', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr05', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr05', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr06', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr06', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr07', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr07', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr08', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr08', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo getImageLink('img', 'flickr', 'flickr09', 'jpg', 800, 531, 'flickr.jpg');?>" class="lightbox">
                                <img alt="" src="<?php echo getImageLink('img', 'flickr', 'flickr09', 'jpg', 72, 65, 'flickr.jpg');?>">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- .col-md-3 -->
            <!-- End Flickr Widget -->


            <!-- Start Contact Widget -->
            <div class="col-md-3 col-xs-12">
                <div class="footer-widget contact-widget" style="background: url(<?php echo URL::to('public/themes/margo');?>/assets/img/map.png) center bottom no-repeat;">
                    <h4><img src="<?php echo URL::to('public/themes/margo');?>/assets/img/simits_logo_footer.png" class="img-responsive" alt="Footer Logo" /></h4>
                    <p>เว็บไซต์รวบรวมความรู้ ข่าวสาร ความบันเทิง ทางด้านไอที และอื่น ๆ</p>
                    <ul>
                        <li><span>Phone Number:</span> +662 644 2390</li>
                        <li><span>Email:</span> <a href="mailto:support@siamits.com">support@siamits.com</a></li>
                        <li><span>Website:</span> <a href="http://www.siamits.com">www.siamits.com</a></li>
                    </ul>
                </div>
            </div>
            <!-- .col-md-3 -->
            <!-- End Contact Widget -->


        </div>
        <!-- .row -->

        <!-- Start Copyright -->
        <div class="copyright-section">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2015 SiamiTs - All Rights Reserved <!-- <a href="<?php echo URL::to('public/themes/margo');?>/http://graygrids.com">GrayGrids</a> --> </p>
                </div>
                <!-- .col-md-6 -->
                <div class="col-md-6">
                    <ul class="footer-nav">
                        <li><a href="<?php echo URL::to('sitemap');?>">Sitemap</a>
                        </li>
                        <li><a href="<?php echo URL::to('policy');?>">Privacy Policy</a>
                        </li>
                        <li><a href="<?php echo URL::to('contact');?>">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- .col-md-6 -->
            </div>
            <!-- .row -->
        </div>
        <!-- End Copyright -->

    </div>
</footer>
<!-- End Footer Section -->