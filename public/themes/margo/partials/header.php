<!-- Start Header Section -->        
<header class="clearfix">

    <!-- Start Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- Start Contact Info -->
                    <ul class="contact-details">
                        <li><a href="<?php echo URL::to('contact');?>" target="_blank"><i class="fa fa-map-marker"></i> Rachadapisek Rd, Bangkok, Thailand</a>
                        </li>
                        <li><a href="mailto:care.siamits@gmail.com"><i class="fa fa-envelope-o"></i> care.siamits@gmail.com</a>
                        </li>
                        <li><a href="<?php echo URL::to('contact');?>"><i class="fa fa-phone"></i> +662 644 2390</a>
                        </li>
                    </ul>
                    <!-- End Contact Info -->
                </div>
                <!-- .col-md-6 -->
                <div class="col-md-5">
                    <!-- Start Social Links -->
                    <ul class="social-list">
                        <li>
                            <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="https://plus.google.com/u/0/103098765144574170914/posts" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="https://www.facebook.com/siamits" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <!-- <li>
                            <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <!-- <li>
                            <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-dribbble"></i></a>
                        </li>
                        <li>
                            <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-flickr"></i></a>
                        </li>
                        <li>
                            <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-tumblr"></i></a>
                        </li>
                        <li>
                            <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-vimeo-square"></i></a>
                        </li>
                        <li>
                            <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="<?php echo URL::to('public/themes/margo');?>/#"><i class="fa fa-skype"></i></a>
                        </li>
                    </ul>
                    <!-- End Social Links -->
                </div>
                <!-- .col-md-6 -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .top-bar -->
    <!-- End Top Bar -->


    <!-- Start  Logo & Naviagtion  -->
    <div class="navbar navbar-default navbar-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Stat Toggle Nav Link For Mobiles -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- End Toggle Nav Link For Mobiles -->
                <a class="navbar-brand" href="<?php echo URL::to('');?>">
                    <!-- Logo color #01952e #000000 -->
                    <img alt="" src="<?php echo URL::to('public/themes/margo');?>/assets/img/siamits_logo_140x40.png">
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <!-- Stat Search -->
                <div class="search-side">
                    <a href="#" class="show-search"><i class="fa fa-search"></i></a>
                    <div class="search-form">
                        <form autocomplete="off" role="search" method="get" class="searchform" action="<?php echo URL::to('search');?>">
                            <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                        </form>
                    </div>
                </div>
                <!-- End Search -->
                <!-- Start Navigation List -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a <?php echo (preg_match( "/pages|news|gallery|webboard|contact/",Request::segment(1))) ? '' : 'class="active" ';?>href="<?php echo URL::to('');?>">Home</a>
                        <!-- <ul class="dropdown">
                            <li><a class="active" href="<?php echo URL::to('public/themes/margo');?>/index.html">Home Main Version</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-01.html">Home Version 1</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-02.html">Home Version 2</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-03.html">Home Version 3</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-04.html">Home Version 4</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-05.html">Home Version 5</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-06.html">Home Version 6</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/index-07.html">Home Version 7</a>
                            </li>
                        </ul> -->
                    </li>
                    <li>
                        <a <?php echo Request::is('pages*') ? 'class="active" ' : '';?>href="<?php echo URL::to('pages');?>">Pages</a>
                        <!-- <ul class="dropdown">
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/about.html">About</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/services.html">Services</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/right-sidebar.html">Right Sidebar</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/left-sidebar.html">Left Sidebar</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/404.html">404 Page</a>
                            </li>
                        </ul> -->
                    </li>
                    <li>
                        <a <?php echo Request::is('news*') ? 'class="active" ' : '';?>href="<?php echo URL::to('news');?>/">News</a>
                        <!-- <ul class="dropdown">
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/tabs.html">Tabs</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/buttons.html">Buttons</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/action-box.html">Action Box</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/testimonials.html">Testimonials</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/latest-posts.html">Latest Posts</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/latest-projects.html">Latest Projects</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/pricing.html">Pricing Tables</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/animated-graphs.html">Animated Graphs</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/accordion-toggles.html">Accordion & Toggles</a>
                            </li>
                        </ul> -->
                    </li>
                    <li>
                        <a <?php echo Request::is('gallery*') ? 'class="active" ' : '';?>href="<?php echo URL::to('gallery');?>">Gallery</a>
                        <!-- <ul class="dropdown">
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/portfolio-2.html">2 Columns</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/portfolio-3.html">3 Columns</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/portfolio-4.html">4 Columns</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/single-project.html">Single Project</a>
                            </li>
                        </ul> -->
                    </li>
                    <li>
                        <a <?php echo Request::is('webboard*') ? 'class="active" ' : '';?>href="<?php echo URL::to('webboard');?>">Webboard</a>
                        <!-- <ul class="dropdown">
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/blog.html">Blog - right Sidebar</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/blog-left-sidebar.html">Blog - Left Sidebar</a>
                            </li>
                            <li><a href="<?php echo URL::to('public/themes/margo');?>/single-post.html">Blog Single Post</a>
                            </li>
                        </ul> -->
                    </li>
                    <li><a <?php echo Request::is('contact*') ? 'class="active" ' : '';?>href="<?php echo URL::to('contact');?>">Contact</a>
                    </li>
                </ul>
                <!-- End Navigation List -->
            </div>
        </div>
    </div>
    <!-- End Header Logo & Naviagtion -->

</header>
<!-- End Header Section