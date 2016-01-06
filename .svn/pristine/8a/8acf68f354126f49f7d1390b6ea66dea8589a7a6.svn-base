<script>
    window.onload = function() {
        var fileClass = "<?php echo Commonmodel::getOrganID(); ?>";
//        setTimeout(function() {
        $("#file_upload").uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader': Yii_baseUrl + '/upload/uploadify',
            'buttonText': '上传商品图片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height': 25, //flash高
            'method': 'post',
//            'formData': {'fileClass': fileClass, 'role': identity},
            'formData': {'fileClass': fileClass, 'add': '0', 'role': 'second'},
            'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
            'queueSizeLimit': 5, //上传数量  
            'fileSizeLimit': '2MB', //上传文件的大小限制
            'onFallback': function() {
                $(".loadflash").show();
            },
            'onUploadStart': function(file) {
                if ($("#showimglist").find("li").length >= 5) {
                    alert('上传图片过多，请删除队列中超过的图片');
                    $('#file_upload').uploadify('stop');        // 停止上传
                    $('#file_upload').uploadify('cancel');    // 清空队列
                }
                var imgarr = new Array();
                $("#showimglist li").each(function() {
                    imgarr.push($(this).find('img[name=urlimg]').attr('imgname'));
                });
                if ($.inArray(file.name, imgarr) != -1) {
                    alert('上传失败' + file.name + '已经上传')
                    $('#file_upload').uploadify('stop');        // 停止上传
                    $('#file_upload').uploadify('cancel');    // 清空队列

                }

            },
            'onSWFReady': function() {
                if ($("#showimglist").find("li").length >= 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            },
            'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if (responeseDataObj && responeseDataObj.code == 200) {
//                    var src_1 = "<?php echo F::uploadUrl() ?>";
//                    var src = src_1 + responeseDataObj.filename;
//                    console.log(responeseDataObj);
                    var span = "<li class='float_l' style='margin-right:5px;'><img name='urlimg' add='add' ondblclick='xximage(this)' key=" + responeseDataObj.filename + "  idkey='1' imgname=" + responeseDataObj.ImgName + "  style='width:80px;height:80px;' src=" + responeseDataObj.ftpfileurl + "></li>";
                    $("#showimglist").append(span);
                } else {
                    errorinfo += '文件' + responeseDataObj.filename + '上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
                if ($("#showimglist").find("li").length == 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            }
        });
//        }, 10);
    }
</script>
