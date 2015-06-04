<div class="register-box">
    <div class="register-logo">
        <a href="<?php echo URL::to('/');?>"><img src="<?php echo URL::to('public/themes/default');?>/assets/img/siamits_logo_140x40.png"/></a>
    </div>

    <div class="register-box-body">

<?php if(Session::has('message')): ?>
         <p class="login-box-msg"><font color="green"><?php echo (null !== Session::get('message')) ? Session::get('message') : '';?></font></p>
<?php endif; ?>
<?php if(Session::has('error')): ?>
         <p class="login-box-msg"><font color="red"><?php echo (null !== Session::get('error')) ? Session::get('error') : '';?></font></p>
<?php endif; ?>

        <p class="login-box-msg">Forgot Password</p>
        <form action="<?php echo URL::to('forgot');?>" method="post" id="frm_main" enctype="multipart/form-data">
            <?php if(!Session::has('message')): ?>
            <div class="form-group has-feedback">
                <input name="email" id="email" type="text" class="form-control" placeholder="Email" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send email for reset password</button>
                </div>
                <!-- /.col -->
            </div>
            <?php endif;?>
        </form>
        <?php if(Session::has('message')): ?>
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo URL::to('login');?>">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Go to sing in page</button>
                </a>
            </div>
        </div>
        <?php endif;?>
        <!-- <a href="<?php echo URL::to('');?>" class="text-center">Go to sign in page</a> -->
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->