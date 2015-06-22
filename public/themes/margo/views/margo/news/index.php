<!--Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>News</h2>
                <p></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li>News</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<!-- Start Content -->
<div id="content">
    <div class="container">
        <div class="row sidebar-page">
            <!-- Page Content -->
            <div class="col-md-9 page-content">

                <!-- Divider -->
                <div class="row latest-posts-classic">
                    <!-- Classic Heading -->
                    <h4 class="classic-title">
                        <span>News</span>
                    </h4>

<?php if (isset($news) && is_array($news)) :?>
<?php foreach ($news as $key => $value) :
                $dt = $value['updated_at'];
                $dt = new DateTime($dt);

                $d = $dt->format('d');
                $m = $dt->format('m');
                $y = $dt->format('Y');

                $dateObj   = DateTime::createFromFormat('!m', $m);
                $m = $dateObj->format('M');
?>
                    <!-- Post 1 -->
                    <div class="col-md-4 post-row">
                        <div class="left-meta-post">
                            <div class="post-date">
                                <span class="day"><?php echo $d;?></span>
                                <span class="month"><?php echo $m;?></span>
                            </div>
                            <div class="post-type">
                                <i class="fa fa-picture-o"></i>
                            </div>
                        </div>
                        <h5 class="post-title">
                            <a href="<?php echo URL::to('news/'.$value['id']);?>">
                                <img width="200" height="143" alt="" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 200, 143, array_get($value, 'images.0.name', ''));?>" />
                                <br>
                                <?php echo htmlspecialchars($value['title']); ?>
                            </a>
                        </h5>
                        <div class="post-content">
                            <p>
                               <!--  <?php echo htmlspecialchars($value['sub_description']); ?> 
                                <a class="read-more" href="<?php echo URL::to('news/'.$value['id']);?>">
                                    Read More...
                                </a> -->
                            </p>
                        </div>
                        <div class="team-member modern">
                            <!-- Memebr Social Links -->
                            <div class="member-socail">
                                <a class="facebook" href="#" alt="Share facebook"><i class="fa fa-facebook"></i></a>
                                <a class="twitter" href="#" alt="Share facebook"><i class="fa fa-twitter"></i></a>
                                <a class="gplus" href="#" alt="Share google plus"><i class="fa fa-google-plus"></i></a>
                                <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                <a class="flickr" href="#"><i class="fa fa-flickr"></i></a>
                                <a class="mail" href="#"><i class="fa fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
<?php endforeach;?>
<?php endif;?>

                </div>
                <!-- Divider -->
                <div class="hr1" style="margin-bottom:30px;"></div>

<?php if(isset($pagination)): ?>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="tb_news_info">Showing <?php echo $pagination->getFrom();?>
                        to <?php echo $pagination->getTo();?>
                        of <?php echo $pagination->getTotal();?> entries
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination">
                                <?php if(isset($param) && !empty($param)): ?>
                                <?php echo $pagination->appends($param)->links();?>
                                <?php else: ?>
                                <?php echo $pagination->links();?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
<?php endif;?>
                
            </div>
            <!-- End Page Content-->
            <!--Sidebar-->
            <div class="col-md-3 sidebar right-sidebar">
                <!-- Search Widget -->
                <div class="widget widget-search">
                    <form action="#">
                        <input type="search" placeholder="Enter Keywords..." />
                        <button class="search-btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <!-- Categories Widget -->
                <div class="widget widget-categories">
                    <h4>Categories 
                        <span class="head-line"></span>
                    </h4>
                    <ul>
                        <li>
                            <a href="#">Brandign</a>
                        </li>
                        <li>
                            <a href="#">Design</a>
                        </li>
                        <li>
                            <a href="#">Development</a>
                        </li>
                        <li>
                            <a href="#">Graphic</a>
                        </li>
                    </ul>
                </div>
                <!-- Popular Posts widget -->
                <div class="widget widget-popular-posts">
                    <h4>Popular Post 
                        <span class="head-line"></span>
                    </h4>
                    <ul>
                        <li>
                            <div class="widget-thumb">
                                <a href="#">
                                    <img src="images/blog-mini-01.jpg" alt="" />
                                </a>
                            </div>
                            <div class="widget-content">
                                <h5>
                                    <a href="#">How To Download The Google Fonts Catalog</a>
                                </h5>
                                <span>Jul 29 2013</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="widget-thumb">
                                <a href="#">
                                    <img src="images/blog-mini-02.jpg" alt="" />
                                </a>
                            </div>
                            <div class="widget-content">
                                <h5>
                                    <a href="#">How To Download The Google Fonts Catalog</a>
                                </h5>
                                <span>Jul 29 2013</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="widget-thumb">
                                <a href="#">
                                    <img src="images/blog-mini-03.jpg" alt="" />
                                </a>
                            </div>
                            <div class="widget-content">
                                <h5>
                                    <a href="#">How To Download The Google Fonts Catalog</a>
                                </h5>
                                <span>Jul 29 2013</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div>
                <!-- Video Widget -->
                <div class="widget">
                    <h4>Video 
                        <span class="head-line"></span>
                    </h4>
                    <div>
                        <iframe src="http://player.vimeo.com/video/63322694?byline=0&amp;portrait=0&amp;badge=0" width="800" height="450"></iframe>
                    </div>
                </div>
                <!-- Tags Widget -->
                <div class="widget widget-tags">
                    <h4>Tags 
                        <span class="head-line"></span>
                    </h4>
                    <div class="tagcloud">
                        <a href="#">Portfolio</a>
                        <a href="#">Theme</a>
                        <a href="#">Mobile</a>
                        <a href="#">Design</a>
                        <a href="#">Wordpress</a>
                        <a href="#">Jquery</a>
                        <a href="#">CSS</a>
                        <a href="#">Modern</a>
                        <a href="#">Theme</a>
                        <a href="#">Icons</a>
                        <a href="#">Google</a>
                    </div>
                </div>
            </div>
            <!--End sidebar-->
        </div>
    </div>
</div>
<!-- End Content