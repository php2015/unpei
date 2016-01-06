<script>
    $(function() {
<?php $path = 'servicer/' . $OrganID . '/ShopPhoto/'; ?>
        var path = "<?php echo $path; ?>";
        setTimeout(function(){
        $("#ShopPoto_upload").uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader': Yii_baseUrl + '/upload/ftpupload',
            'buttonText': '上传门店照片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height': 25, //flash高
            'method': 'post',
            'formData': {'path': path},
            'fileTypeExts': '*.jpg; *.png; *.bmp; *.jpeg',
            'queueSizeLimit': 1, //上传数量  
            'fileSizeLimit': '2MB', //上传文件的大小限制
            'onSWFReady': function() {
                if ($("#showShopPhotolist").find("li").length >= 3) {
                    $("#ShopPoto_upload").uploadify('disable', true);
                }
            },
            'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if (responeseDataObj && responeseDataObj.code == 200) {
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1 + responeseDataObj.fileurl;
                    var span = "<li style='margin-right:10px'><img  style='width:120px;height:90px;' src=" + src + "><span id='delShopphoto' keyid=" + responeseDataObj.fileurl + " class='guanbi3'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span></li>";
                    $("#ShopPoto").val($("#ShopPoto").val()+","+responeseDataObj.fileurl);
                    $("#showShopPhotolist").append(span);
                } else {
                    errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
                if ($("#showShopPhotolist").find("li").length == 3) {
                    $("#ShopPoto_upload").uploadify('disable', true);
                }
            }
        });
        },10);
    });

    //删除附件
    $(document).on("click", "#delShopphoto", function() {
        var del = 1;
        var path = $(this).attr('keyid');
        var url = Yii_baseUrl + '/upload/ftpdelfile';
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
        });
        $.ajax({
            url: Yii_baseUrl + '/member/company/delshopshoto',
            dataType: 'json',
            type: 'post',
            data: {'path': path},
            async: false,
            success: function(res) {
                if (res != 1) {
                    console.log('删除数据失败');
                }
            }
        });
        if (del == 0)
            return;
        $(this).parent('li').remove();
        $("#delShopPoto").attr('value', $("#delShopPoto").val()+","+path);
        $("#ShopPoto_upload").uploadify('disable', false);
    })
</script>