<script>
    var isfirst = false;   //判断是否第一次删除图片
    $(function() {
<?php $path = Yii::app()->user->getIdentity() . '/' . Yii::app()->user->getOrganID() . '/BLPhoto/'; ?>
        var path = "<?php echo $path; ?>";
        setTimeout(function(){
        $("#BLPoto_upload").uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': '<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.swf',
            'uploader': '<?php echo F::baseUrl(); ?>/upload/ftpupload',
            'buttonText': '上传营业执照图片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height': 25, //flash高
            'method': 'post',
            'formData': {'path': path},
            'fileTypeExts': '*.jpg; *.png; *.bmp; *.jpeg',
            'queueSizeLimit': 1, //上传数量  
            'fileSizeLimit': '3MB', //上传文件的大小限制
            onSWFReady: function() {
                if ($("#upload_photo").find("li").length >= 1) {
                    $("#BLPoto_upload").uploadify('disable', true);
                }
            },
            'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if (responeseDataObj && responeseDataObj.code == 200) {
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1 + responeseDataObj.fileurl;
                    var span = "<li><img  style='width:240px;height:150px;' src=" + src + "><span id='delphoto' keyid=" + responeseDataObj.fileurl + " class='guanbi4'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span></li>";
                    $("#BLPoto").attr('value', responeseDataObj.fileurl);
                    $("#showBLPhotolist").append(span);
                } else {
                    errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
                $("#BLPoto_upload").uploadify('disable', true);
            }
        });
        },10);
    })

    //删除附件
    $(document).on("click", "#delphoto", function() {
        var del = 1;
        if (isfirst) {
            var path = $(this).attr('keyid');
            var url = '<?php echo F::baseUrl(); ?>/upload/ftpdelfile';
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: {'path': path},
                async: false,
                success: function(res) {
                    if (res.res != 1) {
                        del = 0;
                        alert('删除失败');
                    }
                }
            })
        }
        if (del == 0)
            return;
        $(this).parent('li').remove();
        $("#BLPoto").attr('value', '');
        $("#BLPoto_upload").uploadify('disable', false);
        isfirst = true;
    })
</script>