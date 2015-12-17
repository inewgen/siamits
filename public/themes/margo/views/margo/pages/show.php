<!-- Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Pages</h2>
                <p><?php echo array_get($pages, 'title', '');?></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li><a href="<?php echo URL::to('pages');?>">Pages</a></li>
                    <li><?php echo array_get($pages, 'title', '');?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<!-- Start Content -->
<div id="content">
    <div class="container">
        <div class="row blog-post-page">
            <div class="col-md-9 blog-box">

              <!-- Start Single Post Area -->
                <div class="blog-post gallery-post">

                    <!-- Start Single Post (Gallery Slider) -->
                    <div class="post-head">
                        <div class="touch-slider post-slider">
<?php if (isset($pages['images']) && is_array($pages['images'])): ?>
<?php foreach ($pages['images'] as $key => $value): ?>
                            <div class="item" align="center">
                                <a class="lightbox" title="<?php echo $pages['title'];?>" href="<?php echo $value['url'];?>" data-lightbox-gallery="gallery1">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    <img alt="" src="<?php echo $value['url'];?>" height="300">
                                </a>
                            </div>
<?php endforeach;?>
<?php endif;?>
                        </div>
                    </div>
                    <!-- End Single Post (Gallery) -->
<?php
$dt = $pages['updated_at'];
$dt = new DateTime($dt);

$d = $dt->format('d');
$m = $dt->format('m');
$y = $dt->format('Y');

$dateObj = DateTime::createFromFormat('!m', $m);
$m = $dateObj->format('F');
?>
                    <!-- Start Single Post Content -->
                    <div class="post-content">
                        <div class="post-type"><i class="fa fa-rss-square"></i></div>
                        <h2><?php echo array_get($pages, 'title', '');?></h2>
                        <ul class="post-meta">
                            <li>By <a href="#"><?php echo array_get($author, 'name', '');?></a></li>
                            <li><?php echo $m;?> <?php echo $d;?>, <?php echo $y;?></li>
                            <li><a href="#"><?php echo array_get($pages, 'categories.title', '');?></a></li>
                            <li><a href="#"><span class="disp_views"><?php echo number_format(array_get($pages, 'views', '0'));?></span> Views</a></li>
                        </ul>
                        <p><?php echo $pages['description'];?></p>

<?php if ($reference = array_get($pages, 'reference', false)): ?>
                        <div class="post-bottom-tags">
                            <div class="post-share">
                                <i class="fa fa-thumb-tack"></i> ที่มา :
                                <span class="">
<?php if ($reference_url = array_get($pages, 'reference_url', false)): ?>
                                    <a href="<?php echo $reference_url;?>" target="_blank">
                                        <?php echo $reference;?>
                                    </a>
<?php else: ?>
                                    <?php echo $reference;?>
<?php endif;?>
                                </span>
                            </div>
                        </div>
<?php endif;?>

                        <div class="post-bottom-tags">
                            <div class="fb-like" 
                                data-href="<?php echo $url_share;?>" 
                                data-layout="button_count" 
                                data-action="like" 
                                data-show-faces="true" 
                                data-share="false">
                            </div>
                        </div>

						<div class="post-bottom-tags">
                            <div class="post-tags-list">
                            	<i class="fa fa-tags"></i> Tags :
<?php if ($tags = array_get($pages, 'tags', false)): ?>
<?php foreach ($tags as $tag): ?>
                                <a href="<?php echo URL::to('search');?>?s=<?php echo array_get($tag, 'title', '');?>"><?php echo array_get($tag, 'title', '');?></a>
<?php endforeach;?>
<?php endif;?>

                            </div>
                            <div class="post-share">
                                <!-- <span><i class="fa fa-share-alt"></i> Like This Post:</span> -->
                            </div>
                        </div>

                        <div class="post-bottom-tags">
                            <div class="post-tags-list">
                            	<i class="fa fa-eye"></i> Views : <span class="disp_views"><?php echo number_format(array_get($pages, 'views', '0'));?></span>
                        	</div>

                        </div>
                        <div class="post-bottom clearfix">
                            <div class="post-tags-list">

                            	<button id="btn_likes" type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    Like
                                </button>
                                <span class="disp_likes">
                                    <?php echo number_format(array_get($pages, 'likes', '0'));?>
                                </span>

                                <button id="btn_unlikes" type="button" class="btn btn-default btn-sm">
                                    <i class="fa fa-thumbs-o-down"></i>
                                    Unlike
                                </button>
                                <span class="disp_unlikes">
                                    <?php echo number_format(array_get($pages, 'unlikes', '0'));?>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="hr1" style="margin-bottom:30px;"></div>
                            <div class="post-share">
                                <span><i class="fa fa-share-alt"></i> Share This Post:</span>
                                <!-- <a class="facebook" href="https://www.facebook.com/dialog/feed?app_id=876049622442009&display=popup&caption=<?php echo $pages['title'];?>&link=http://www.siamits.dev/pages/40&redirect_uri=http://www.siamits.dev/pages/40"><i class="fa fa-facebook"></i></a>
                                <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                <a class="gplus" href="#"><i class="fa fa-google-plus"></i></a>
                                <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                <a class="mail" href="#"><i class="fa fa-envelope"></i></a> -->
                                <div class="fb-share-button" data-href="<?php echo $url_share;?>" data-layout="button_count"></div>
                                <a href="https://plus.google.com/share?url=<?php echo $url_share;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                                    <img src="https://www.gstatic.com/images/icons/gplus-16.png" alt="Share on Google+"/>
                                </a>
                            </div>

                        </div>

                        <div class="author-info clearfix">
                            <div class="author-image">
                                <a href="#">
                                    <img src="<?php echo getImageLink('image', array_get($author, 'images.0.user_id', ''), array_get($author, 'images.0.code', ''), array_get($author, 'images.0.extension', ''), 70, 70, array_get($author, 'images.0.name', ''));?>" alt="" />
                          		</a>
                            </div>
                            <div class="author-bio">
                                <h4>About The Author</h4>
                                <p><?php echo array_get($author, 'name', '');?></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Post Content -->

                </div>
                <!-- End Single Post Area -->

                <!-- Start Comment Area -->
                <div id="comments">

                	<a name="addcomments" id="addcomments"></a>
					<?php checkAlertMessage();?>

                	<!-- Start Respond Form -->
                    <div id="respond">
                        <h2 class="respond-title">Leave a reply</h2>
                        <form id="frm_main" role="form" method="post" action="<?php echo URL::to('pages/addcomment');?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name<span class="required">*</span></label>
                                    <input id="name" name="name" type="text" value="" size="30" aria-required="true">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input id="email" name="email" type="text" value="" size="30" aria-required="true">
                                </div>
                                <!--<div class="col-md-4">
                                    <label for="url">Website<span class="required">*</span></label>
                                    <input id="url" name="url" type="text" value="" size="30" aria-required="true">
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="message">Add Your Comment<span class="required">*</span></label>
                                    <textarea id="message" name="message" cols="45" rows="8" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                            		<div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo Config::get('web.recaptch-site-key');?>"></div>
                            	</div>
                            </div>
                            <p>&nbsp;

                            </p>
                            <div class="row">
                            	<div class="col-md-12">
                                	<input name="commentable_id" type="hidden" id="commentable_id" value="<?php echo array_get($pages, 'id', '');?>">
                                    <input name="referer" type="hidden" id="referer" value="<?php echo URL::to('pages');?>/<?php echo array_get($pages, 'id', '');?>#addcomments">
                                    <input name="user_id" type="hidden" id="user_id" value="">
                                    <input name="submit" type="submit" id="submit" value="Submit Comment">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Respond Form -->

                    <div class="row">
                    <h4 class="classic-title">
                        <span></span>
                    </h4>
                    <h2 class="comments-title">(<?php echo number_format($comments_num);?>) Comments</h2>
                    <ol class="comments-list">

<?php if (isset($comments) && is_array($comments)): ?>
<?php foreach ($comments as $comment): ?>
<?php
$dt = $comment['updated_at'];
$dt = new DateTime($dt);

$d = $dt->format('d');
$m = $dt->format('m');
$y = $dt->format('Y');
$t = $dt->format('H:i:s');

$dateObj = DateTime::createFromFormat('!m', $m);
$m = $dateObj->format('F');
?>
                        <li>
                        	<a name="comments<?php echo array_get($comment, 'number', '');?>" id="comments<?php echo array_get($comment, 'number', '');?>"></a>
                            <div class="comment-box clearfix">
                                <div class="avatar">
                                <img src="<?php echo getImageLink('img', 'avatar', 'm01', 'png', 70, 70, 'avatar.png');?>" alt="" />
                                </div>
                                <div class="comment-content">
                                    <div class="comment-meta">
                                        <span class="comment-by">(#<?php echo array_get($comment, 'number', '');?>) By <?php echo array_get($comment, 'name', '');?></span>
                                        <span class="comment-date"><?php echo $m;?> <?php echo $d;?>, <?php echo $y;?> at <?php echo $t;?></span>
                                        <span class="reply-link"><?php echo array_get($comment, 'ip', '');?></span>
                                        <!--<span class="reply-link"><a href="#">Reply</a></span>-->
                                    </div>
                                    <p><?php echo array_get($comment, 'message2', '');?></p>
                                </div>
                            </div>
                        </li>
<?php endforeach;?>
<?php endif;?>

                    </ol>
                    </div>

                    <?php if (isset($pagination)): ?>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="dataTables_info" id="tb_pages_info">Showing <?php echo $pagination->getFrom();?>
                            to <?php echo $pagination->getTo();?>
                            of <?php echo $pagination->getTotal();?> entries
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                    <?php if (isset($param) && !empty($param)): ?>
                                    <?php echo $pagination->appends($param)->links();?>
                                    <?php else: ?>
                                    <?php echo $pagination->links();?>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>

                </div>
                <!-- End Comment Area -->

            </div>

            <!--Sidebar-->
            <div class="col-md-3 sidebar right-sidebar">
                <!-- Search Widget -->
                <div class="widget widget-search">
                    <form action="<?php echo URL::to('pages');?>" method="get">
                        <input type="search" placeholder="Enter Keywords..." name="s" value="<?php echo array_get($param, 's' . '');?>" />
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
                            <a href="<?php echo URL::to('pages');?>">All</a>
                        </li>
<?php if (isset($categories) && is_array($categories)): ?>
<?php foreach ($categories as $key => $value): ?>
                        <li>
                            <a href="<?php echo URL::to('pages/category');?>/<?php echo $key;?>"><?php echo $value;?></a>
                        </li>
<?php endforeach;?>
<?php endif;?>
                    </ul>
                </div>
                <!-- Popular Posts widget -->
                <div class="widget widget-popular-posts">
                    <h4>Popular Pages
                        <span class="head-line"></span>
                    </h4>
                    <ul>
<?php if (isset($ppages) && is_array($ppages)): ?>
<?php foreach ($ppages as $key => $value): ?>
                        <li>
                            <div class="widget-thumb">
                                <a href="<?php echo URL::to('pages/' . $value['id']);?>">
                                    <img src="<?php echo getImageLink('image', array_get($value, 'images.0.user_id', ''), array_get($value, 'images.0.code', ''), array_get($value, 'images.0.extension', ''), 65, 65, array_get($value, 'images.0.name', ''));?>" alt="" />
                                </a>
                            </div>
                            <div class="widget-content">
                                <h5>
                                    <a href="<?php echo URL::to('pages/' . $value['id']);?>"><?php echo htmlspecialchars($value['title']);?></a>
                                </h5>
                                <span>View (<?php echo array_get($value, 'views', '0');?>)</span>
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

<?php if (isset($youtube) && is_array($youtube)): ?>
<?php foreach ($youtube as $key => $value): ?>
<?php if ($key != 0): ?>
						<br />
<?php endif;?>
						<iframe width="800" height="450" src="https://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>" frameborder="0" allowfullscreen></iframe>
                        <!--<iframe src="https://www.youtube.com/embed/<?php echo array_get($value, 'id', '');?>" width="800" height="450"></iframe>-->
<?php endforeach;?>
<?php endif;?>
                    </div>
                </div>
                <!-- Tags Widget -->
                <div class="widget widget-tags">
                    <h4>Tags
                        <span class="head-line"></span>
                    </h4>
                    <div class="tagcloud">

<?php if ($tags = array_get($pages, 'tags', false)): ?>
<?php foreach ($tags as $tag): ?>
                                <a href="<?php echo URL::to('search');?>?s=<?php echo array_get($tag, 'title', '');?>"><?php echo array_get($tag, 'title', '');?></a>
<?php endforeach;?>
<?php endif;?>

                    </div>
                </div>

                <div class="widget widget-tags">
                    <h4>Follow us
                        <span class="head-line"></span>
                    </h4>
                    <div class="fb-follow" data-href="https://www.facebook.com/siamits" data-layout="button_count" data-show-faces="true"></div>
                </div>

            </div>
            <!--End sidebar-->
        </div>
    </div>
</div>
<!-- End Content