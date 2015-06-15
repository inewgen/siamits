<?php
Theme::asset()->add('dataTables-bootstrap', 'public/themes/adminlte2/plugins/iCheck/all.css');
Theme::asset()->add('bootstrap3-wysihtml5', 'public/themes/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
Theme::asset()->add('uploadify-css', 'public/themes/adminlte2/plugins/uploadify/uploadify.css');
Theme::asset()->add('ace-css', 'public/themes/adminlte2/plugins/css/ace.thumbnails.css');

Theme::asset()->container('footer')->add('jquery-ui.min', 'http://code.jquery.com/ui/1.11.2/jquery-ui.min.js');
Theme::asset()->container('footer')->add('bootstrap3-wysihtml5.all.min', 'public/themes/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
Theme::asset()->container('footer')->add('bootbox', 'public/themes/adminlte2/plugins/bootbox/bootbox.min.js');
Theme::asset()->container('footer')->add('validate', 'public/themes/adminlte2/plugins/jQuery/jquery.validate.min.js');
Theme::asset()->container('footer')->add('uploadify', 'public/themes/adminlte2/plugins/uploadify/jquery.uploadify.min.js');
?>

<script type="text/javascript">
    var num_images = 0;
    $(function () {
        <?php $timestamp = time();?>
        $('#file_upload').uploadify({
            'formData'     : {
                'section': 'banners',
                'user_id': '<?php echo $user->id;?>',
                'timestamp': '<?php echo $timestamp;?>',
                'token':     '<?php echo md5(Config::get("web.siamits-keys") . $timestamp);?>'
            },
            'removeCompleted' : true,
            //'debug'    : true,
            'multi'    : false,
            'swf'      : '<?php echo URL::to("public/themes/adminlte2");?>/plugins/uploadify/uploadify.swf',
            'uploader' : '<?php echo URL::to("images/uploads");?>',
            'onUploadSuccess' : function(file, data, response) {
                console.log(data);
                var data      = jQuery.parseJSON(data);
                var status_code = data.status_code;
                if(status_code != '0'){
                    var error       = data.data;
                    bootbox.dialog({
                      message: error,
                      buttons: {
                        success: {
                          label: "ตกลง",
                          className: "btn-small btn-primary"
                        }
                      }
                    });
                }else if(status_code == '0'){
                    var id        = data.data.id;
                    var url       = data.data.url;
                    var code      = data.data.code;
                    var user_id   = data.data.user_id;
                    var extension = data.data.extension;

                    var url_img = '<?php echo URL::to("public");?>/uploads/'+user_id+'/'+code+'.'+extension;

                    $('#images').val('');
                    var img_upload_tag = ''+
                    '<div id="'+id+'" align="center"><ul class="ace-thumbnails">'+
                        '<li>'+
                            '<a href="javascript:void(0)">'+
                                '<img alt="200x200" src="'+ url +'" width="100%" height="">'+
                            '</a>'+
                            '<!--<div class="tools tools-bottom">'+
                                '<a href="javascript:void(0)" onclick="return image_delete(\''+id+'\',\''+code+'\', \''+user_id+'\', \''+extension+'\');" title="Delete">'+
                                    '<i class="fa fa-fw fa-trash-o"></i>'+
                                '</a>'+
                                '<a class="copy-link-wrap" href="javascript:void(0)" title="Copy Link" data="'+url_img+'">'+
                                    '<i class="fa fa-fw fa-link"></i>'+
                                '</a>'+
                            '</div>-->'+
                        '</li>'+
                    '</ul><input type="hidden" name="images[]" value="'+id+'">'+
                    '</div>';

                    $("#show_image_upload").html(img_upload_tag);

                    num_images++;
                }
                //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            } 
        });

        $("#frm_main").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'text-red',
            focusInvalid: true,
            rules: {
                // position: "required",
<?php if(!isset($banners['images']) || !is_array($banners['images'])):?>
                images: "required",
<?php endif;?>
            },
            messages: {
                // position: "This field is required",
<?php if(!isset($banners['images']) || !is_array($banners['images'])):?>
                images: "This field is required",
<?php endif;?>
            }
        });
    });
</script>
