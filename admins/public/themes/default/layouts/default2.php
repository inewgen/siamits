<!DOCTYPE html>
<html>
    <head>
        <title><?php echo Theme::get('title'); ?></title>
        <link rel="shortcut icon" href="<?php echo Config::get('url.siamits-web');?>/favicon.ico" type="image/x-icon" />
        <meta charset="utf-8">
        <meta name="keywords" content="<?php echo Theme::get('keywords'); ?>">
        <meta name="description" content="<?php echo Theme::get('description'); ?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo URL::to('public/themes/adminlte2');?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo URL::to('public/themes/adminlte2');?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

        <?php echo Theme::asset()->styles(); ?>
        <?php echo Theme::asset()->scripts(); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="<?php echo Theme::get('classbody'); ?>">
        <?php //echo Theme::partial('header'); ?>

        <div class="login-page">
            <?php echo Theme::content(); ?>
        </div>

        <?php //echo Theme::partial('footer'); ?>

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo URL::to('public/themes/adminlte2');?>/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo URL::to('public/themes/adminlte2');?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <?php echo Theme::asset()->container('footer')->scripts();?>
        <?php echo Theme::asset()->container('inline_script')->scripts();?>
    </body>
</html>