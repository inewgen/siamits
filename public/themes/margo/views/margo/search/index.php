<!--Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Search</h2>
                <p></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li>Search</li>
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
            <div class="col-md-12 page-content">

                <!-- Divider -->
                <div class="row latest-posts-classic">
                    <!-- Classic Heading -->
                    <h4 class="classic-title">
                        <span>
                        	Search Results
                        	<font color="green">
                       			<?php echo $pagination->getTotal();?>
                        	</font>
                        	entries
                        </span>
                    </h4>

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
		                    <div class="col-md-12 post-row">
								<div class="left-meta-post">
									<div class="post-date">
										<span class="day"><?php echo $d;?></span>
		                                <span class="month"><?php echo $m;?></span>
									</div>
									<div class="post-type">
		<?php if (array_get($value, 'tagable_type', '') == 'news'): ?>
										<i class="fa fa-rss-square"></i>
		<?php elseif (array_get($value, 'tagable_type', '') == 'pages'): ?>
										<i class="fa fa-paperclip"></i>
		<?php else: ?>
										<i class="fa fa-file-o"></i>
		<?php endif;?>
									</div>
								</div>
								<h3 class="post-title"><a href="<?php echo URL::to(array_get($value, 'tagable_type', '') . '/' . array_get($value, 'tagable_id', ''));?>"><?php echo array_get($value, 'content.title', '');?></a></h3>
								<div class="post-content">
									<p><?php echo array_get($value, 'content.sub_description', '');?></p>
								</div>
							</div>
		<?php endforeach;?>
<?php endif;?>

                </div>
                <!-- Divider -->
                <div class="hr1" style="margin-bottom:30px;"></div>

<?php if (isset($pagination)): ?>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="dataTables_info" id="tb_news_info">Showing <?php echo $pagination->getFrom();?>
                        to <?php echo $pagination->getTo();?>
                        of <?php echo $pagination->getTotal();?> entries
                        </div>
                    </div>
                    <div class="col-xs-8">
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
            <!-- End Page Content-->

        </div>
    </div>
</div>
<!-- End Content