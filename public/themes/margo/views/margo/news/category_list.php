<!--Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>News</h2>
                <p>Category</p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li><a href="<?php echo URL::to('news');?>">News</a></li>
                    <li>Category</li>
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
                        <span>News Category</span>
                    </h4>

<?php if (isset($category) && is_array($category)) :?>
<?php foreach ($category as $key => $value) :
?>
                    <!-- Post 1 -->
                    <div class="col-md-4 post-row">
                        <h4 class="post-title">
                            <a href="<?php echo URL::to('news/category/'.$value['id']);?>">
                                <img width="200" height="143" alt="" src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 200, 143, array_get($value, 'images.0.name', ''));?>" />
                                <br>
                                <?php echo htmlspecialchars($value['title']); ?>
                            </a>
                        </h4>
                        <div class="post-content">
                            <p>
                               <?php echo htmlspecialchars($value['description']); ?> 
                            </p>
                        </div>
                    </div>
<?php endforeach;?>
<?php endif;?>

<?php if(count($category) == 0): ?>
                     <div class="call-action call-action-boxed call-action-style1 clearfix">
                        <!-- Call Action Button -->
                        <div class="button-side" style="margin-top:8px;">
                            <a href="<?php echo URL::to('');?>" class="btn-system border-btn btn-large">
                                <i class="icon-gift-1"></i> Go to home page
                            </a>
                        </div>
                        <!-- Call Action Text -->
                        <h2 class="primary"><strong>SORRY,</strong> DATA NOT FOUND</h2>
                        <p>Please click button to home page</p>
                    </div>
<?php endif; ?>

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
                    <form action="<?php echo URL::to('news');?>" method="get">
                        <input type="search" placeholder="Enter Keywords..." name="s" value="<?php echo array_get($param, 's'. '');?>" />
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
                            <a href="<?php echo URL::to('news');?>">All</a>
                        </li>
<?php if (isset($categories) && is_array($categories)) :?>
<?php foreach ($categories as $key => $value) : ?>
                        <li>
                            <a href="<?php echo URL::to('news/category');?>/<?php echo $key;?>"><?php echo $value;?></a>
                        </li>
<?php endforeach;?>
<?php endif;?>
                    </ul>
                </div>
                <!-- Popular Posts widget -->
                <div class="widget widget-popular-posts">
                    <h4>Popular News 
                        <span class="head-line"></span>
                    </h4>
                    <ul>
<?php if (isset($pnews) && is_array($pnews)) :?>
<?php foreach ($pnews as $key => $value) :?>
                        <li>
                            <div class="widget-thumb">
                                <a href="<?php echo URL::to('news/'.$value['id']);?>">
                                    <img src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 65, 65, array_get($value, 'images.0.name', ''));?>" alt="" />
                                </a>
                            </div>
                            <div class="widget-content">
                                <h5>
                                    <a href="<?php echo URL::to('news/'.$value['id']);?>"><?php echo htmlspecialchars($value['title']); ?></a>
                                </h5>
                                <span>View (<?php echo array_get($value, 'views', '0'); ?>)</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
<?php endforeach;?>
<?php endif;?>
                    </ul>
                </div>
                <!-- Video Widget -->
                <div class="widget">
                    <h4>Video 
                        <span class="head-line"></span>
                    </h4>
                    <div>

<?php if(isset($youtube) && is_array($youtube)): ?>
<?php foreach ($youtube as $key => $value): ?>
                        <iframe src="https://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>" width="800" height="450"></iframe>
<?php endforeach;?>
<?php endif;?>
                    </div>
                </div>
                <!-- Tags Widget -->
                <!--<div class="widget widget-tags">
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
                </div>-->

                <div class="widget widget-tags">
                    <h4>Follow us
                        <span class="head-line"></span>
                    </h4>
                    <div class="fb-follow" data-href="https://www.facebook.com/siamits" data-width="200" data-height="200" data-layout="standard" data-show-faces="true"></div>
                </div>

            </div>
            <!--End sidebar-->
        </div>
    </div>
</div>
<!-- End Content