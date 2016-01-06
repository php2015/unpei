<script>
$(function(){
    //alert(Yii_theme_baseUrl);
    var fileClass = "<?php echo Commonmodel::getOrganID(); ?>";   
    $("#file_upload").uploadify({
        'auto'	: true,
        'queueId'	: 'some_file+queue',
        'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
        'uploader'	: Yii_baseUrl + '/upload/uploadify',
        'buttonText': '上传商品图片',
        //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
        'height'    : 24,//flash高
        'method'    : 'post',
        'formData'  :{'fileClass':fileClass,'add':'0','role':'first'},
        //   'buttonImage' : Yii_theme_baseUrl + '/images/btns/btn.jpg',//设置按钮图片
        'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
        // 'fileTypeExts': '*.gif; *.jpg ; *.png;*.bmp',
        'queueSizeLimit' : 5,                         //上传数量  
        'fileSizeLimit':'2MB',                         //上传文件的大小限制
        'button_image_url':'about:blank',
        'onUploadStart': function (file) {
             var imgarr=new Array();
              $("#showimglist .showimages").each(function(){
                   imgarr.push($(this).find('span[name=urlimg]').attr('imgname'));
              });
              if($.inArray(file.name, imgarr)!=-1){ 
                $.messager.show({title:'提示信息',msg:'上传失败'+file.name+'已经上传'}) 
//                    $('#file_upload').uploadify('stop');        // 停止上传
                   $('#file_upload').uploadify('cancel', file.id);    // 清空队列
//                    return false;
                }
              
         },
        //'onCancel'  : function(file){alert(file.name +' was canceled !');},
        'onClearQueue' : function(queueItemCount){alert(queueItemCount +' file(s) was removed !');},
        //'onQueueComplete' : function (queueData){ alert(queueData.uploadsSuccessful +' files were successfully !')},
        //'onComplete' : funComplete,                      //完成上传任务
        'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
            var responeseDataObj = eval("(" + data + ")");
            // alert(responeseDataObj.filename);
            if(responeseDataObj && responeseDataObj.code == 200){
                var src_1 = "<?php echo F::uploadUrl() ?>";
                var src = src_1+responeseDataObj.filename;
                var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+src+">"+
                    "<input type='hidden' name='goodsImages[]' value="+responeseDataObj.filename+">"+
                   "<span name='urlimg' add='add' onclick='xximage(this)' key="+responeseDataObj.filename+" imgname="+responeseDataObj.ImgName+" class='close icon-close-green xx'></span></span>";
                $("#showimglist").append(span);
//                $('#file_uploaddetc').uploadify('stop');        // 停止上传
                $('#file_uploaddetc').uploadify('cancel', file.id);    // 清空队列
                $.messager.show({title:'提示信息',msg:responeseDataObj.msg})
                //    $("#hidden_upnames").append("<input type='hidden' name='goodsImages[]' value="+responeseDataObj.filename+">");
            }else{
//                $('#file_upload').uploadify('stop');        // 停止上传
                $('#file_upload').uploadify('cancel', file.id);    // 清空队列
                $.messager.show({title:'提示信息',msg:responeseDataObj.msg})
            }
        }
    });
})
////删除图片发生的事件
//$(document).delegate(".photoID",'click',function(){
//    var imageName = $(this).next("img").attr('id');
//    var imageID = $(this).next("img").attr('name');
//    var deleurl = Yii_baseUrl + "/dealer/marketing/deleteimage";
//    $.ajax({
//        url: deleurl,
//        type: "POST",
//        data: {
//            'imageName': imageName
//        },
//        dataType: "json",
//        success:function(data){
//            // alert(data);
//            if(data==1){
//                $("#"+imageID).remove();
//            }
//        }
//    });
//})
////开始上传
//$(document).delegate('#file-upload-start','click',function(){
//    successNum = 0;
//    errorNum = 0;
//    $("#file-upload-totalinfo").html("");
//    $("#file-upload-errorinfo").hide();
//    $("#file-upload-errorinfo span").html("");	
//    $('#file_upload').uploadify('upload','*');
//    return false;	
//});
//
//// 检测图片
//$(function(){
//    //alert(Yii_theme_baseUrl);
//    var fileClass = "<?php echo Commonmodel::getOrganID(); ?>";
//    $("#file_uploaddetc").uploadify({
//        'auto'	: true,
//        'queueId'	: 'some_file+queue',
//        'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
//        'uploader'	: Yii_baseUrl + '/dealer/marketing/uploadify',
//        'buttonText': '上传检测图片',
//        //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
//        'height'    : 24,//flash高
//        'method'    : 'post',
//        'formData'  :{'fileClass':fileClass},
//        //   'buttonImage' : Yii_theme_baseUrl + '/images/btns/btn.jpg',//设置按钮图片
//        // 'fileTypeExts': '*.gif; *.jpg ; *.png;*.bmp',
//        'queueSizeLimit' : 1,                         //上传数量  
//        'fileSizeLimit':'3MB',                         //上传文件的大小限制
//          'button_image_url':'about:blank',
//        //'onCancel'  : function(file){alert(file.name +' was canceled !');},
//        'onClearQueue' : function(queueItemCount){alert(queueItemCount +' file(s) was removed !');},
//        'onSelectError' : function (file, errorCode, errorMsg) {
//            if(errorCode == SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE){
//
//                this.queueData.errorMsg = "不能传空文件!!";
//
//            }
//        },
//        //'onQueueComplete' : function (queueData){ alert(queueData.uploadsSuccessful +' files were successfully !')},
//        //'onComplete' : funComplete,                      //完成上传任务
//        'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
//            var responeseDataObj = eval("(" + data + ")");
//            // alert(responeseDataObj.filename);
//            var errorinfo = '';
//            if(responeseDataObj && responeseDataObj.code == 200){
//                    var src_1 = "<?php echo F::uploadUrl() ?>";
//                var src = src_1+responeseDataObj.filename;
//                var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+src+">"+
//                    "<input type='hidden' name='detcImages' value="+responeseDataObj.filename+">"+
//                    "<span onclick='xximage(this)' key="+responeseDataObj.filename+" class='close icon-close-green xx'></span></span>";
//                $("#showimglist-detc").append(span);
                //  $("#showimglist-detc").append("<input type='hidden' name='detcImages' value="+responeseDataObj.filename+">");
//            }else{
//                errorinfo += '文件' + responeseDataObj.filename + '上传失败！错误原因：' + responeseDataObj.msg + '<br />';
//                $("#file-upload-errorinfo").show();
//                $("#file-upload-errorinfo span").append(errorinfo);
//            }
//        }
//    });
//})
//  
////开始上传
//$(document).delegate('#file-upload-start-detc','click',function(){
//    successNum = 0;
//    errorNum = 0;
//    $("#file-upload-totalinfo").html("");
//    $("#file-upload-errorinfo").hide();
//    $("#file-upload-errorinfo span").html("");	
//    $('#file_upload-detc').uploadify('upload','*');
//    return false;	
//});

</script>
