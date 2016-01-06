<script>
    var uploadpath = 'servicer/images/inquiry/'+'<?php echo Yii::app()->user->getOrganID();?>'+'/';
    var visiturl = '<?php echo Yii::app()->params["ftpserver"]['visiturl']; ?>';
    var errorinfo='';
    
    setTimeout(function(){
        $("#upload_file_one").uploadify({
        'auto': true,
        'queueId': 'some_file+queue',
        'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader': Yii_baseUrl + '/upload/ftpupload',
        'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height': 80, //flash高
        'method': 'post',
        'formData': {'path': uploadpath},
        'buttonImage': Yii_theme_baseUrl + '/images/sc.png', //设置按钮图片
        'fileTypeExts': '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
        'queueSizeLimit': 1, //上传数量  
        'fileSizeLimit': '2MB', //上传文件的大小限制
        'onFallback': function() {
                    $('.loadflash').show();
                },
        'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
            var res = eval("(" + data + ")");
            if (res && res.code == 200) {
                
                var src = visiturl + res.fileurl;
                var span = "<img style='width:80px;height:80px;border:none' src=" + src + " key=" + res.fileurl + " app='one' ondblclick='deleteimg(this)'>" +
                        "<input type='hidden' name='inquiryImages[]' value=" + res.fileurl + ">" +
                        "<input type='hidden' name='inquiryImagesname[]' value=" + res.filename + ">"
                        ;
                $("#img_id_one").html(span);
                $('#upload_file_one').uploadify('stop');        // 停止上传
                $('#upload_file_one').uploadify('cancel');    // 清空队列
            } else {
                errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                $("#img_id_one").html(errorinfo);
            }
        }
    });
    },10);

 setTimeout(function(){
    $("#upload_file_two").uploadify({
        'auto': true,
        'queueId': 'some_file+queue',
        'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader': Yii_baseUrl + '/upload/ftpupload',
        'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height': 80, //flash高
        'method': 'post',
        'background': 'none',
        'formData': {'path': uploadpath},
        'buttonImage': Yii_theme_baseUrl + '/images/sc.png', //设置按钮图片
        'fileTypeExts': '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
        'queueSizeLimit': 1, //上传数量  
        'fileSizeLimit': '2MB', //上传文件的大小限制
        'onFallback': function() {
                    $('.loadflash').show();
                },
        'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
            var res = eval("(" + data + ")");
            var errorinfo = '';
            if (res && res.code == 200) {
                var src_1 = '<?php echo Yii::app()->params["FTPFileUrl"] ?>';
                var src = visiturl + res.fileurl;
                var span = "<img style='width:80px;height:80px;' src=" + src + " key=" + res.fileurl + " app='two' ondblclick='deleteimg(this)'>" +
                        "<input type='hidden' name='inquiryImages[]' value=" + res.fileurl + ">" +
                        "<input type='hidden' name='inquiryImagesname[]' value=" + res.filename + ">"
                $("#img_id_two").html(span);
            } else {
                errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                $("#img_id_two").html(errorinfo);
            }
        }
    });
  },10);
  
   setTimeout(function(){
    $("#upload_file_three").uploadify({
        'auto': true,
        'queueId': 'some_file+queue',
        'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader': Yii_baseUrl + '/upload/ftpupload',
        'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height': 80, //flash高
        'method': 'post',
        'background': 'none',
        'formData': {'path': uploadpath},
        'buttonImage': Yii_theme_baseUrl + '/images/sc.png', //设置按钮图片
        'fileTypeExts': '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
        'queueSizeLimit': 1, //上传数量  
        'fileSizeLimit': '2MB', //上传文件的大小限制
        'onFallback': function() {
                    $('.loadflash').show();
                },
        'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
            var res = eval("(" + data + ")");
            var errorinfo = '';
            if (res && res.code == 200) {
                var src_1 = '<?php echo Yii::app()->params["FTPFileUrl"] ?>';
                var src = visiturl + res.fileurl;
                var span = "<img style='width:80px;height:80px;' src=" + src + " key=" + res.fileurl + " app='three' ondblclick='deleteimg(this)'>" +
                        "<input type='hidden' name='inquiryImages[]' value=" + res.fileurl + ">" +
                        "<input type='hidden' name='inquiryImagesname[]' value=" + res.filename + ">"
                $("#img_id_three").html(span);
            } else {
                errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                $("#upload_file_three").hide();
                $("#img_id_three").html(errorinfo);
            }
        }
    });
 },10);
 
  setTimeout(function(){
    $("#upload_file_four").uploadify({
        'auto': true,
        'queueId': 'some_file+queue',
        'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader': Yii_baseUrl + '/upload/ftpupload',
        'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height': 80, //flash高
        'method': 'post',
        'background': 'none',
        'formData': {'path': uploadpath},
        'buttonImage': Yii_theme_baseUrl + '/images/sc.png', //设置按钮图片
        'fileTypeExts': '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
        'queueSizeLimit': 1, //上传数量  
        'fileSizeLimit': '2MB', //上传文件的大小限制
        'onClearQueue': function(queueItemCount) {
            alert(queueItemCount + ' file(s) was removed !');
        },
        'onFallback': function() {
                    $('.loadflash').show();
                },
        'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
            var res = eval("(" + data + ")");
            var errorinfo = '';
            if (res && res.code == 200) {
                var src_1 = '<?php echo Yii::app()->params["FTPFileUrl"] ?>';
                var src = visiturl + res.fileurl;
                var span = "<img style='width:80px;height:80px;' src=" + src + " key=" + res.fileurl + " app='four' ondblclick='deleteimg(this)'>" +
                        "<input type='hidden' name='inquiryImages[]' value=" + res.fileurl + ">" +
                        "<input type='hidden' name='inquiryImagesname[]' value=" + res.filename + ">"
                $("#img_id_four").html(span);
            } else {
                errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                $("#upload_file_four").hide();
                $("#img_id_four").html(errorinfo);
            }
        }
    });
 },10);
 
  setTimeout(function(){
    $("#upload_file_five").uploadify({
        'auto': true,
        'queueId': 'some_file+queue',
        'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader': Yii_baseUrl + '/upload/ftpupload',
        'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height': 80, //flash高
        'method': 'post',
        'background': 'none',
        'formData': {'path': uploadpath},
        'buttonImage': Yii_theme_baseUrl + '/images/sc.png', //设置按钮图片
        'fileTypeExts': '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
        'queueSizeLimit': 1, //上传数量  
        'fileSizeLimit': '2MB', //上传文件的大小限制
        'onFallback': function() {
                    $('.loadflash').show();
                },
        'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
            var res = eval("(" + data + ")");
            var errorinfo = '';
            if (res && res.code == 200) {
                var src_1 = '<?php echo Yii::app()->params["FTPFileUrl"] ?>';
                var src = visiturl + res.fileurl;
                var span = "<img style='width:80px;height:80px;' src=" + src + " key=" + res.fileurl + " app='five' ondblclick='deleteimg(this)'>" +
                        "<input type='hidden' name='inquiryImages[]' value=" + res.fileurl + ">" +
                        "<input type='hidden' name='inquiryImagesname[]' value=" + res.filename + ">"
                $("#img_id_five").html(span);
            }
        }
    });
     },10);
</script>