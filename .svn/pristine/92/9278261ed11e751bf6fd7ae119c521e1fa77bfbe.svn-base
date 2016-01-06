<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?<?php echo time();?>'></script>
<script>
    $(function(){
        //文件上传
<?php $path = 'customer/' . Yii::app()->user->id . '/'; ?>
        var path = "<?php echo $path; ?>";
        $("#file_upload").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader'	: Yii_baseUrl + '/upload/ftpupload',
            // 'uploader'	:Yii_baseUrl + '/servicer/servicequestion/uploadfile',
            'buttonText': '上传附件',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 25,//flash高
            'method'    : 'post',
            'formData'  :{'path':path},
            'fileDesc' : 'image/word/excel' ,
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.jpeg;*.doc;*.docx;*.xls;*.xlsx',
            'queueSizeLimit' : 1,                         //上传数量  
            'fileSizeLimit':'2MB',                         //上传文件的大小限制
            'overrideEvents' : [ 'onDialogClose', 'onUploadError', 'onSelectError' ],
            'onSWFReady': function(){    
            }, 
            'onFallback': function() {
                    $('.loadflash').show();
                },
            'onSelectError':function(file, errorCode, errorMsg) { 
                var msgText = "上传失败\n";  
                switch (errorCode) {  
                    case SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED:   
                        msgText += "每次最多上传 " + this.settings.queueSizeLimit + " 个文件;同一个文件可以上传多次";  
                        break;  
                    case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:  
                        msgText += "文件大小超过限制( " + this.settings.fileSizeLimit + " )";  
                        break;  
                    case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:  
                        msgText += "文件大小为0";  
                        break;  
                    case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:  
                        msgText += "文件格式不正确，仅限 " + this.settings.fileTypeExts;  
                        break;  
                    default:  
                        msgText += "错误代码：" + errorCode + "\n" + errorMsg;  
                }  
                alert(msgText);  
            },
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var res = eval("(" + data + ")");
                var errorinfo = '';
                if(res && res.code == 200){
                    $('#showfile').show();
                    var html = '<li>' + res.filename + '<a name="delfile" href="javascript:void(0)" style="float:right" class="color_blue" path="' + res.fileurl + '" filename="' + res.filename + '">' + '删除</a></li>';
                    $('#addul').append(html);
                }else{
                    errorinfo += '文件' + res.filename + '上传失败！错误原因：' + res.msg + '<br />';
                    alert(errorinfo);
                }
                if($('#addul').find('li').length==5){
                    //$("#file_upload").uploadify('settings','buttonText','上传已到限制');
                    $("#file_upload").uploadify('disable',true);
                }
            }
        });
    })  
    
    //删除附件
    $(document).on("click","#addul [name=delfile]",function(){
        var path=$(this).attr('path');
        var url=Yii_baseUrl + '/upload/ftpdelfile';
        $.post(url, {'path':path},function(res){});
        $(this).parent('li').remove();
        if($('#addul').find('li').length==0){
            $('#showfile').hide();
            $("#file_upload").uploadify('disable',true);
        }
        if($('#addul').find('li').length>0&&$("#addul").find("li").length<5){
            $("#file_upload").uploadify('disable',false);
        }
    })
    
    //把附件加入隐藏域
    function fileaddhide(){
        var name='';
        var path='';
        $('#addul').find('a').each(function(){
            name+=$(this).attr('filename')+',;,';
            path+=$(this).attr('path')+',';
        })
        $('#FileName').val(name.substr(0,name.length-3));
        $('#FileUrl').val(path.substr(0,path.length-1));  
    }
</script>