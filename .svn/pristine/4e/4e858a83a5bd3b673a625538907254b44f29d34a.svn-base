<script>
    $(function(){
        //alert(Yii_theme_baseUrl);
<?php $organID = Commonmodel::getOrganID() ?>
<?php $identity = Commonmodel::getIdentity($organID); ?>
        var fileClass =  <?php echo Commonmodel::getOrganID(); ?>;
        var identity=<?php echo $identity['identity']; ?>;
        $("#file_upload").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
           // 'uploader'	: Yii_baseUrl + '/dealer/marketing/uploadify2',
            'uploader'	: Yii_baseUrl + '/upload/uploadify',
            'buttonText': '上传机构照片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 24,//flash高
            'method'    : 'post',
            'formData'  :{'fileClass':fileClass,'identity':identity},
            //   'buttonImage' : Yii_theme_baseUrl + '/images/btns/btn.jpg',//设置按钮图片
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
            //'fileTypeExts': '*.gif; *.jpg ; *.png;*.bmp',
            'queueSizeLimit' : 5,                         //上传数量  
            'fileSizeLimit':'3MB',                         //上传文件的大小限制
            //'onCancel'  : function(file){alert(file.name +' was canceled !');},
            'onClearQueue' : function(queueItemCount){alert(queueItemCount +' file(s) was removed !');},
            //'onQueueComplete' : function (queueData){ alert(queueData.uploadsSuccessful +' files were successfully !')},
            //'onComplete' : funComplete,                      //完成上传任务
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                // alert(responeseDataObj.filename);
                var errorinfo = '';
                
                if(responeseDataObj && responeseDataObj.code == 200){
                    var sh=0;
                    $("#service-form").find(".showimages").find("img").each(function(){
                        sh++;
                    })
                    if(sh<5){
                        <?php $organID = Commonmodel::getOrganID(); ?> 
                        var src_1 = "<?php echo F::uploadUrl() ?>";
                        var src = src_1+responeseDataObj.filename;
                        var span = "<span class='showimages'><img style='width:80px;height:80px;' src="+src+">"+
                            "<span key="+responeseDataObj.filename+" class='close icon-close-green xx'></span>"+
                            "<input type='hidden' name='organImages[]' value="+responeseDataObj.filename+"></span>";
                        $("#showimglist").append(span);
                    }
                    //$("#hidden_upnames").append("<input type='hidden' name='organImages[]' value="+responeseDataObj.filename+">");
                }else{
                    errorinfo += '文件' + responeseDataObj.filename + '上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
            }
        });
    })
    //开始上传
    $(document).delegate('#file-upload-start','click',function(){
        successNum = 0;
        errorNum = 0;
        $("#file-upload-totalinfo").html("");
        $("#file-upload-errorinfo").hide();
        $("#file-upload-errorinfo span").html("");	
        $('#file_upload').uploadify('upload','*');
        return false;	
    });
</script>