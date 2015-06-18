<?php
Theme::asset()->add('dataTables-bootstrap', 'public/themes/adminlte2/plugins/iCheck/all.css');
Theme::asset()->add('uploadify-css', 'public/themes/adminlte2/plugins/uploadify/uploadify.css');
Theme::asset()->add('ace-css', 'public/themes/adminlte2/plugins/css/ace.thumbnails.css');
Theme::asset()->add('icheck-css', 'public/themes/adminlte2/plugins/iCheck/all.css');
Theme::asset()->add('tagsinput-css', 'public/themes/adminlte2/plugins/jQuery-Tags-Input-master/src/jquery.tagsinput.css');
Theme::asset()->add('tagsinput-css2', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css');

Theme::asset()->container('footer')->add('jquery-ui.min', 'http://code.jquery.com/ui/1.11.2/jquery-ui.min.js');
Theme::asset()->container('footer')->add('bootbox', 'public/themes/adminlte2/plugins/bootbox/bootbox.min.js');
Theme::asset()->container('footer')->add('validate', 'public/themes/adminlte2/plugins/jQuery/jquery.validate.min.js');
Theme::asset()->container('footer')->add('uploadify', 'public/themes/adminlte2/plugins/uploadify/jquery.uploadify.min.js');
Theme::asset()->container('footer')->add('ckeditor', 'public/themes/adminlte2/plugins/ckeditor2/ckeditor.js');
// Theme::asset()->container('footer')->add('zclip', 'public/themes/adminlte2/plugins/zclip/jquery.zclip.js');
Theme::asset()->container('footer')->add('tagsinput', 'public/themes/adminlte2/plugins/jQuery-Tags-Input-master/src/jquery.tagsinput.js');
Theme::asset()->container('footer')->add('icheck', 'public/themes/adminlte2/plugins/iCheck/icheck.min.js');
Theme::asset()->container('footer')->add('fastclick', 'public/themes/adminlte2/plugins/fastclick/fastclick.min.js');
?>

<script type="text/javascript">
    var num_images = <?php echo $num_image;?>;

    $(function () {

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

        var url_to_autocomplete_api = '<?php echo URL::to("news/tags");?>';
    
        $('#tags').tagsInput({
            'autocomplete_url': url_to_autocomplete_api,
            'height':'100px',
            'width':'100%',
            'interactive':true,
            'defaultText':'add a tag',
            'delimiter': [','],
            'removeWithBackspace' : true,
            'minChars' : 0,
            'maxChars' : 0, //if not provided there is no limit
            'placeholderColor' : '#666666'
        });

        CKEDITOR.config.extraPlugins = 'toolbar';
        CKEDITOR.replace( 'description', {
            // Reset toolbar settings, so full toolbar will be generated automatically.
            toolbar: null,
            toolbarGroups: null,
            removeButtons: null,
            height: 400
        } );

        $("#frm_main").validate({
            ignore: [],
            errorElement: 'span',
            errorClass: 'text-red',
            focusInvalid: true,
            rules: {
                title: "required",
                sub_description: "required",
                description: "required",
                position: "required",
                status: "required",
                tags: "required",
                type: "required",
                images_code: "required",
                category_id: "required",
            },
            messages: {
                image: "This field is required",
                sub_description: "This field is required",
                description: "This field is required",
                position: "This field is required",
                status: "This field is required",
                tags: "This field is required",
                type: "This field is required",
                images_code: "This field is required",
                category_id: "This field is required",
            }
        });

        <?php $timestamp = time();?>
        $('#file_upload').uploadify({
            'formData'     : {
                'w': '150',
                'section': 'news',
                'user_id': '<?php echo $user->id;?>',
                'timestamp': '<?php echo $timestamp;?>',
                'token':     '<?php echo md5(Config::get("web.siamits-keys") . $timestamp);?>'
            },
            'removeCompleted' : true,
            //'debug'    : true,
            'multi'    : true,
            'swf'      : '<?php echo URL::to("public/themes/adminlte2");?>/plugins/uploadify/uploadify.swf',
            'uploader' : '<?php echo URL::to("images/uploads");?>',
            'onUploadSuccess' : function(file, data, response) {
                console.log(data);
                var data      = jQuery.parseJSON(data);
                var status_code = data.status_code;
                if(status_code == '2000'){
                    alert(data.data);
                }else if(status_code != '0'){
                    var error       = data.data.message;
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
                    var url_real       = data.data.url_real;
                    var code      = data.data.code;
                    var user_id   = data.data.user_id;
                    var extension = data.data.extension;

                    var w = 150;
                    var show_hover_button = true;

                    $('#images_code').val(code);

                    var img_upload_tag = ''+
                    '<div id="'+id+'" align="center"><ul class="ace-thumbnails">'+
                        '<li>'+
                            '<a href="javascript:void(0)">'+
                                '<img alt="'+w+'" src="'+ url +'" width="'+w+'" height="">'+
                            '</a>';
                    if(show_hover_button){
                        img_upload_tag = img_upload_tag +
                            '<div class="tools tools-bottom">'+
                                '<a href="javascript:void(0)" onclick="return image_delete(\''+id+'\',\''+code+'\', \''+user_id+'\', \''+extension+'\');" title="Delete">'+
                                    '<i class="fa fa-fw fa-trash-o"></i>'+
                                '</a>'+
                                '<a class="copy-link-wrap" id="copy_link_'+num_images+'" href="javascript:void(0)" title="Copy Link" data="'+url_real+'">'+
                                    '<i class="fa fa-fw fa-link"></i>'+
                                '</a>'+
                            '</div>';
                    }   
                        img_upload_tag = img_upload_tag +
                        '</li>'+
                    '</ul><input type="hidden" name="images['+num_images+']" value="'+id+'">'+
                    '</div>';

                    $("#show_image_upload").append(img_upload_tag);

                    $('#copy_link_'+num_images).click(function() {
                        var url_real = $(this).attr('data');
                        
                        bootbox.dialog({
                          message: "<input id='image_link' type='text' size='85' value='"+$(this).attr('data')+"'/>",
                          buttons: {
                            success: {
                              label: "ตกลง",
                              className: "btn-small btn-primary"
                            }
                          }
                        });

                        $("#image_link").click(function() {
                            $(this).select();
                        });
                    });

                    num_images++;
                }
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            } 
        });
        
        $('.copy-link-wrap').click(function() {
            var url_real = $(this).attr('data');
            
            bootbox.dialog({
              message: "<input id='image_link' type='text' size='85' value='"+$(this).attr('data')+"'/>",
              buttons: {
                success: {
                  label: "ตกลง",
                  className: "btn-small btn-primary"
                }
              }
            });

            $("#image_link").click(function() {
                $(this).select();
            });
        });
    });

    function image_delete(id, code, user_id, extension){
        bootbox.confirm("คุณต้องการลบหรือไม่", function(result) {
            if(result){
                console.log("Success");
                if(num_images == 1){
                    $('#images_code').val('');
                }
                num_images--;
                console.log("Success");
                $('#'+id).remove();
                // $.ajax({
                //     type: "GET",
                //     url: "<?php echo URL::to('images/delete');?>",
                //     data: 'id='+id+'&code='+code+'&user_id='+user_id+'&extension='+extension,
                //     dataType: "json",
                //     success: function(data) {
                        
                //         if(data.status_code == '0')
                //         {   
                //             if(num_images == 1){
                //                 $('#images_code').val('');
                //             }
                //             num_images--;
                //             console.log("Success");
                //             $('#'+id).remove();
                //         }else{
                //             var message_i = data.status_txt;
                //             bootbox.dialog({
                //               message: message_i,
                //               buttons: {
                //                 success: {
                //                   label: "ตกลง",
                //                   className: "btn-small btn-primary"
                //                 }
                //               }
                //             });
                //             console.log(data);
                //         }
                //         $('.order_up_down').attr("disabled", false);
                //         processing = false;
                //     },
                //     error: function(){
                //         bootbox.dialog({
                //           message: "Can't delete this item!",
                //           buttons: {
                //             success: {
                //               label: "ตกลง",
                //               className: "btn-small btn-primary"
                //             }
                //           }
                //         });
                //         console.log("Unsuccess");
                //     }
                // });
            }
        });
    }
</script>
