<?php   if(isMobile()):
            $height = 'auto';
        else:
            $height = '100px';
        endif;
?>

<style type="text/css">
    .youtube-details2 {
      height: <?php echo $height;?>
    }
</style>

<!--Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Clips VDO</h2>
                <p></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li>Clips VDO</li>
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

            <div class="col-md-12 page-content">
                <!-- Search Widget -->
                <div class="widget widget-search">
                    <form action="<?php echo URL::to('clips');?>" method="get">
                        <input type="search" placeholder="Enter Keywords..." name="s" value="<?php echo array_get($param, 's'. '');?>" />
                        <button class="search-btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="hr1" style="margin-bottom:30px;"></div>

            <!-- Page Content -->
            <div class="col-md-12 page-content">

                <!-- Divider -->
                <div class="row latest-posts-classic" id="youtube_content">
                    <!-- Classic Heading -->
                    <!-- <h4 class="classic-title">
                        <span>Clips VDO</span>
                    </h4> -->

    <?php if(isset($youtube['results']) && is_array($youtube['results'])): ?>
    <?php foreach ($youtube['results'] as $key => $value): ?>
                <div class="col-md-3 youtube-row">
                    <div class="portfolio-item item">
                        <div class="portfolio-border">

                            <div class="portfolio-thumb video-container video-fitvids">

                            <?php if(isMobile()): ?>
                                <iframe class="video-iframe" title="" type="text/html" src="http://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>?rel=0&autohide=1&showinfo=0" frameborder=0 allowfullscreen="true"></iframe>
                            <?php else: ?>
                                <a class="lightbox" data-lightbox-type="ajax" href="https://www.youtube.com/watch?v=<?php echo array_get($value, 'id', '');?>">
                                    <div class="thumb-overlay">
                                        <i class="fa fa-play"></i>
                                    </div>
                                    <img alt="" src="<?php echo array_get($value, 'images.medium', '');?>" />
                                </a>
                            <?php endif; ?>

                            </div>
                            <div class="portfolio-details youtube-details2">
                                <!-- <a class="lightbox" data-lightbox-type="ajax" href="https://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>"> -->
                                    <h5><?php echo array_get($value, 'title', '');?></h5>
                            <?php if($channelTitle = array_get($value, 'channelTitle', false)): ?>
                                    <span><?php echo $channelTitle;?></span>
                            <?php endif;?>
                                    <span><font color="color">Youtube</font> <span class="hide-sm"><i class="fa fa-youtube-square fa-4"></i>&nbsp;&nbsp;</span> 
                                       
                                    </span>
                                <!-- </a> -->
                            </div>

                        </div>
                    </div>
                </div>
    <?php endforeach;?>
    <?php endif;?>


                </div>
                <!-- Divider -->
                <div class="hr1" style="margin-bottom:30px;"></div>

<?php if(!empty($param['nextPageToken'])): ?>
                <p class="text-center">
                    <a href="javascript:void(0)" class="btn-system btn-large btn-gray btn-block loadmore" id="btn_loadmore">
                        Load More
                        <!-- <i class="fa fa-refresh fa-spin"></i> Loading ... -->
                    </a>
                </p>

                <div class="hr1" style="margin-bottom:30px;"></div>
<?php endif;?>

<?php if(isset($pagination)): ?>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- <div class="dataTables_info" id="tb_pages_info">Showing <?php echo $pagination->getFrom();?>
                        to <?php echo $pagination->getTo();?>
                        of <?php echo $pagination->getTotal();?> entries
                        </div> -->
                        <div class="dataTables_info" id="tb_pages_info">Search Result <?php echo number_format($pagination->getTotal());?> entries
                        </div>
                    </div>
                </div>
<?php endif;?>
                <div class="clearfix"></div>
                <div class="hr1" style="margin-bottom:30px;"></div>
                <div class="row latest-posts-classic">
                    <!-- Classic Heading -->
                    <h4 class="classic-title">
                        <span>Follow us</span>
                    </h4>
                    
                    <div class="fb-follow" 
                    data-href="https://www.facebook.com/siamits" 
                    data-colorscheme="light"
                    data-layout="button_count" 

                    data-show-faces="true"></div>
                </div>
                
            </div>
            <!-- End Page Content-->
            
        </div>
    </div>
</div>
<!-- End Content