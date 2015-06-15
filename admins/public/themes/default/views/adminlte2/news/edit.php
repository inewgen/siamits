<div class="content-wrapper" style="min-height: 948px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit News
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo URL::to('');?>">
                    <i class="fa fa-dashboard"></i> Home
                </a>
            </li>
            <li>
                Edit News
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Message Success -->
        <?php if($success = Session::has('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>
                <i class="icon fa fa-check"></i>
                <?php echo (null !== Session::get('success')) ? Session::get('success') : '';?>
            </h4>         
        </div>
        <?php endif; ?>

        <!-- Message Error -->
        <?php if($error = Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>
                <i class="icon fa fa-ban"></i>
                <?php echo (null !== Session::get('error')) ? Session::get('error') : '';?>
            </h4>
        </div>
        <?php endif; ?>

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">News Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="frm_add_news" role="form" method="post" action="<?php echo URL::to('news');?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" placeholder="" name="title" class="form-control" value="<?php echo htmlspecialchars($news['title']);?>">
                            </div>
                            <div class="form-group">
                                <label for="">Sub Description</label>
                                <input type="text" placeholder="" name="sub_description" class="form-control" value="<?php echo htmlspecialchars($news['sub_description']);?>" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                     <?php echo htmlspecialchars($news['description']);?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tags</label>
                                <input type="text" placeholder="" name="tags" id="tags" class="form-control" value="<?php echo $news['tags'];?>">
                            </div>
                            <div class="form-group">
                                <label for="">Position</label>
                                <input type="text" placeholder="" name="position" class="form-control" value="<?php echo $news['position'];?>">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="text" placeholder="" name="status" class="form-control" value="<?php echo $news['status'];?>">
                            </div>
                            <div class="form-group">
                                <label for="">Reference</label>
                                <input type="text" placeholder="" name="reference" class="form-control" value="<?php echo htmlspecialchars($news['reference']);?>">
                            </div>
                            <div class="form-group">
                                <label for="">Reference URLs</label>
                                <input type="text" placeholder="" name="reference_url" class="form-control" value="<?php echo $news['reference_url'];?>">
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category_id" class="form-control">
                            <?php if(isset($categories) && is_array($categories)):?>
                            <?php foreach ($categories as $key => $value): ?>
                                    <option value="<?php echo $value['id'];?>"<?php if($news['categories']['id'] == $value['id']):?> selected="selected"<?php endif;?>><?php echo $value['title'];?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="">Type</label>
                                <select name="type" class="form-control">
                                    <option value="1"<?php if($news['type'] == '1'):?> selected="selected"<?php endif;?>>ทั่วไป</option>
                                    <option value="2"<?php if($news['type'] == '2'):?> selected="selected"<?php endif;?>>Hightlight</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="">Socials Share</label>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" class="minimal"/>
                                </label>
                                <label>
                                    &nbsp;Share with Facebook.
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="">Images</label>
                                <input placeholder="" class="form-control" id="file_upload" name="file_upload" type="file" multiple="true">
                                <input type="hidden" name="images" id="images" value="<?php echo array_get($news, 'images.0.ids', '');?>">
                                <div id="show_image_upload" style="hight:150">
<?php if(isset($news['images']) && is_array($news['images'])):?>
<?php foreach ($news['images'] as $key => $image): ?>
                                    <div id="<?php echo $image['code'];?>"><ul class="ace-thumbnails">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img alt="150x150" src="<?php echo $image['url'];?>" width="150" height="150">
                                            </a>
                                            <div class="tools tools-bottom">
                                                <a href="javascript:void(0)" onclick="return image_delete('<?php echo $image['code'];?>', '<?php echo $news['member_id'];?>', '<?php echo $image['extension'];?>');" title="Delete">
                                                    <i class="fa fa-fw fa-trash-o"></i>
                                                </a>
                                                <a class="copy-link-wrap" href="javascript:void(0)" title="Copy Link" data="<?php echo URL::to('public');?>/uploads/<?php echo $news['member_id'];?>/news/<?php echo $image['code'];?>.<?php echo $image['extension'];?>">
                                                    <i class="fa fa-fw fa-link"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul><input type="hidden" name="images_arr[<?php echo $image['code'];?>]" value="<?php echo $image['code'];?>">
                                    </div>
<?php endforeach;?>
<?php endif;?>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-danger" type="reset">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>

                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="member_id" value="<?php echo $member_id;?>">
                        <input type="hidden" name="ids" value="<?php echo $ids;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
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