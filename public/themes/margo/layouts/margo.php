<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

<head>

    <!-- Basic -->
    <title><?php echo Theme::get('title'); ?></title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="<?php echo Theme::get('description'); ?>">
    <meta name="author" content="SiamiTs">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="<?php echo URL::to('public/themes/margo');?>/assets/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo URL::to('public/themes/margo');?>/assets/css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/responsive.css" media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/red.css" title="red" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/jade.css" title="jade" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/green.css" title="green" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/blue.css" title="blue" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/beige.css" title="beige" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/cyan.css" title="cyan" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/orange.css" title="orange" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/peach.css" title="peach" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/pink.css" title="pink" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/purple.css" title="purple" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/sky-blue.css" title="sky-blue" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::to('public/themes/margo');?>/assets/css/colors/yellow.css" title="yellow" media="screen" />
    <?php echo Theme::asset()->styles(); ?>

    <!-- Margo JS  -->
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.migrate.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/modernizrr.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.appear.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/count-to.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.textillate.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.lettering.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/jquery.parallax.js"></script>
    <?php echo Theme::asset()->scripts(); ?>
    <!-- <script type="text/javascript" src="<?php echo URL::to('public/themes/margo');?>/assets/js/script.js"></script> -->

    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63483372-1', 'auto');
  ga('send', 'pageview');
</script>

    <!-- Full Body Container -->
    <div id="container">


        <!-- Start Header Section -->
        <div class="hidden-header"></div>
        <?php echo Theme::partial('header'); ?>
        <!-- End Header Section -->

        <?php echo Theme::content(); ?>
        
        <!-- Start Footer Section -->
        <?php echo Theme::partial('footer'); ?>
        <!-- End Footer Section -->


    </div>
    <!-- End Full Body Container -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <div id="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
            <div class="dot3"></div>
        </div>
    </div>

    <?php echo Theme::asset()->container('footer')->scripts();?>
    <?php echo Theme::asset()->container('inline_script')->scripts();?>

</body>

</html>