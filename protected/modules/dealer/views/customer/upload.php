<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?ver=<?php echo rand(0, 9999); ?>'></script>
<script><!--
    $(function(){
        //文件上传
<?php $path = 'customer/' . Yii::app()->user->id . '/'; ?>
        var path = "<?php echo $path; ?>";
        $("#file_upload").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader'	: Yii_baseUrl + '/upload/ftpupload',
            'buttonText': '上传附件',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 25,//flash高
            'method'    : 'post',
            'formData'  :{'path':path},
            'fileDesc' : 'image/word/excel' ,
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.jpeg;*.doc;*.docx;*.xls;*.xlsx',
            'queueSizeLimit' : 1,                         //上传数量  
            'fileSizeLimit':'2MB',                         //上传文件的大小限制
            'onSWFReady': function(){    
            },
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var res = eval("(" + data + ")");
                var errorinfo = '';
                if(res && res.code == 200){
                   $('#showfile').show();
                    var html = '<li>' + res.filename + '<a name="delfile" href="javascript:void(0)" style="float:right" class="color_blue" path="' + res.fileurl + '" filename="' + res.filename + '">' + '删除</a></li>';
                    $('#addul').append(html);
                }else{
                    errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
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
    --></script>