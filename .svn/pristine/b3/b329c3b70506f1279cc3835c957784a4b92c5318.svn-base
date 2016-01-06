<script>
    $(function() {
<?php $path = 'services/' . Yii::app()->user->getOrganID() . '/'; ?>
        var path = "<?php echo $path; ?>";
<?php for ($i = 0; $i <= $key; $i++) { ?>
            $("#file_upload<?php echo $i ?>").uploadify({
                'auto': true,
                'queueId': 'some_file+queue',
                'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
                'uploader': Yii_baseUrl + '/upload/ftpupload',
                'buttonText': '上传图片',
                'height': 25, //flash高
                'method': 'post',
                'formData': {'path': path},
                'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
                'queueSizeLimit': 1, //上传数量  
                'fileSizeLimit': '2MB', //上传文件的大小限制
                'onSWFReady': function() {
                    if ($("#showimglist<?php echo $i ?>").find("li").length >= 3) {
                        $("#file_upload<?php echo $i ?>").uploadify('disable', true);
                    }
                },
                'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                    var responeseDataObj = eval("(" + data + ")");
                    var errorinfo = '';
                    if (responeseDataObj && responeseDataObj.code == 200) {
                        var src_1 = "<?php echo F::uploadUrl() ?>";
                        var src = src_1 + responeseDataObj.fileurl;
                        var span = "<li><img  style='width:80px;height:80px;' src=" + src + "><span id='delfile' keyid=" + responeseDataObj.fileurl + " class='guanbi3'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span></li>";
                        $("#showimglist<?php echo $i ?>").append(span);
                        $("#eval_fm").append("<input type='hidden' name='goodsImages<?php echo $i ?>[]' value=" + responeseDataObj.fileurl + ">");
                    } else {
                        errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                        $("#file-upload-errorinfo").show();
                        $("#file-upload-errorinfo span").append(errorinfo);
                    }
                    if ($("#showimglist<?php echo $i ?>").find("li").length == 3) {
                        $("#file_upload<?php echo $i ?>").uploadify('disable', true);
                    }
                }
            });
    <?php } ?>
    });

</script>