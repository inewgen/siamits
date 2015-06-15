<div class="content-wrapper" style="min-height: 948px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Banner
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo URL::to('');?>">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li>
                Add Banner
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Message Success -->
        <?php if($success = Session::get('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>
                <i class="icon fa fa-check"></i>
                Success! <?php echo $success['message']; ?>
            </h4>         
        </div>
        <?php endif;?>

        <!-- Message Error -->
        <?php if($message = $errors->first()): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>
                <i class="icon fa fa-ban"></i>
                Errors! <?php echo $message; ?>
            </h4>
        </div>
        <?php endif;?>

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Banner Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="frm_add_banners" role="form" method="post" action="<?php echo URL::to('banners/add');?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" placeholder="" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Subtitle</label>
                                <input type="text" placeholder="" name="subtitle" class="form-control">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="button" value="1" checked="checked"> <strong>Check me button status on</strong>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">Button title</label>
                                <input type="text" placeholder="" name="button_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Button url</label>
                                <input type="text" placeholder="" name="button_url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image Banner</label>
                                <input type="file" name="image" id="image">
                                <p class="help-block">Dimensions 1440 × 500 only</p>
                            </div>
                            <div class="form-group">
                                <label for="">Position</label>
                                <input type="text" placeholder="" name="position" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select name="type" class="form-control">
                                    <option value="1" selected="selected">Siamit web banner</option>
                                    <option value="2">Adds banner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="status" value="1" checked="checked"> <strong>Check me banner status on</strong>
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-danger" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                        <input type="hidden" name="member_id" value="1">
                        <input type="hidden" name="id_max" value="<?php echo $id_max;?>">
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>