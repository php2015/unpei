<script>
    var errorinfo='';
<?php $path = 'dealer/' . $OrganID . '/BrandPhoto/'; ?>
    $(function() {
        <?php if (!empty($data)):?>
        <?php foreach($data as $key => $val):?>
        $('#one_<?php echo $val['ID'];?>').uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader': Yii_baseUrl + '/upload/ftpupload',
            'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height': 80, //flash高
            'method': 'post',
            'formData': {'path': '<?php echo $path; ?>'},
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

                    var src = '<?php echo F::uploadUrl()?>' + res.fileurl;
                    var span = "<img style='width:80px;height:80px;border:none' src=" + src + " path=" + res.fileurl + " key = " + <?php echo $val['ID'];?> + " app='one' ondblclick='deleteimg(this)'>";
                    $("#img_<?php echo $val['ID'];?>_one").html(span);
                    $("#one_<?php echo $val['ID'];?>").uploadify('stop');        // 停止上传
                    $("#one_<?php echo $val['ID'];?>").uploadify('cancel');    // 清空队列
                    var url = Yii_baseUrl + '/member/company/savebrandphoto';
                    $.post(url, { 'id':<?php echo $val['ID']?>, 'path': res.fileurl,'type' : 1}, function(res) {
                        if (res.result == 1) {
                            alert(res.msg);
                        } else {
                            alert(res.msg);
                        }
                    }, 'json');
                } else {
                    errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                    $("#img_<?php echo $val['ID'];?>_one").html(errorinfo);
                }
            }
        });
        
        $('#two_<?php echo $val['ID'];?>').uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader': Yii_baseUrl + '/upload/ftpupload',
            'width': 80, //flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height': 80, //flash高
            'method': 'post',
            'formData': {'path': '<?php echo $path; ?>'},
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

                    var src = '<?php echo F::uploadUrl()?>' + res.fileurl;
                    var span = "<img style='width:80px;height:80px;border:none' src=" + src + " path=" + res.fileurl + " key = " + <?php echo $val['ID'];?> + " app='two' ondblclick='deleteimg(this)'>";
                    $("#img_<?php echo $val['ID'];?>_two").html(span);
                    $("#two_<?php echo $val['ID'];?>").uploadify('stop');        // 停止上传
                    $("#two_<?php echo $val['ID'];?>").uploadify('cancel');    // 清空队列
                    var url = Yii_baseUrl + '/member/company/savebrandphoto';
                    $.post(url, { 'id':<?php echo $val['ID']?>, 'path': res.fileurl,'type' : 2}, function(res) {
                        if (res.result == 1) {
                            alert(res.msg);
                        } else {
                            alert(res.msg);
                        }
                    }, 'json');
                } else {
                    errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                    $("#img_<?php echo $val['ID'];?>_two").html(errorinfo);
                }
            }
        });
        <?php 
            endforeach;
            endif;
        ?>
            });
            
            //删除图片
                    function deleteimg(obj) {
                        var path = $(obj).attr('path');
                        var key = $(obj).attr('key');
                        var app = $(obj).attr('app');
                        var del_url = Yii_baseUrl + '/upload/ftpdelfile';
                        $.post(del_url, {'path': path}, function(res) {
                            if (res.res == 1) {
                                var url = Yii_baseUrl + '/member/company/delbrandshoto';
                                $.post(url, {'key': key,'app' : app}, function(res) {
                                    if (res.result == 1) {
                                        $(obj).remove();
                                        alert(res.msg);
                                    } else {
                                        alert(res.msg);
                                    }
                                }, 'json');
                            } else {
                                alert('图片删除失败！');
                            }
                        }, 'json');
                    }
</script>