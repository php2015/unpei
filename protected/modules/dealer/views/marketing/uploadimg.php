<style>
    fieldset.import {
        border: 2px solid #D4D4D4;
        margin: 0;
        padding: 5px;
        width: 752px;
        /*overflow-x: scroll;*/
    }
    .importgoodslist{
        width: 2000px;
        /*overflow-x: scroll;*/
    }
        /**隐藏进度条**/
     .uploadify-queue{ display: none;} 
     
.format_p {
    margin-top: -20px;
}

.format_label {
    margin-left: 140px;
}
.form-row{
    position: relative;
}
</style>
<!--商品详情弹框开始-->
<!--弹出上传商品的对话框-->

<div id="uploadimg" modal=true class="easyui-dialog" style="width:750px;height:450px;padding:10px" closed="true" buttons="#uploadimg-buttons">


    <fieldset class="import" style="width:670px;"> 
        <legend>导入商品图片</legend>
        <div class="form-row">
          <label class="format_label">(上传的图片格式应为gif、jpg、png、jpeg,最佳大小为350px*350px)</label> <!--
            <select id="selectgoodsName" class='select'>
            </select>-->
            <p class="format_p">  
                <input type='file' name='betch_uploadimg' id="betch_uploadimg">
                <input type="hidden" value="上传" id="file-upload-start">
               <!-- <p class="form-row" id="showimglist-img" style=" position: relative;"> </p> -->       <!--显示上传的图片-->
            </p>
             
        </div>
        <div id='beatchimgList' style="width: 650px;">
        </div>
    </fieldset>
    <input value="0" id="goodsimg_name" type="hidden"/>
</div>
<div id="uploadimg-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-ok" onclick="importgoods()">保存</a><!--onclick="$('#importgoods_dlg').dialog('close');"-->
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#uploadimg').dialog('close');" >关闭</a>
</div>
<script>
    //当关闭弹窗时执行
//    $('#uploadimg').dialog({   
//        onBeforeClose:function(){
//         
//        }
//  }); 
  
  function afterSave(){
         $("#beatchimgList").empty();
            $('#dg').datagrid('unselectAll');
            $.each(caridobj,function(k,v){
                caridobj[k]=false;
            });
  }
  //保存
    function importgoods(){
        var urlimg=0;
        var url =" <?php echo Yii::app()->createUrl('dealer/marketing/Addimg'); ?>";
        $("#beatchimgList .showimglist-img .showimages").each(function(){
            if($(this).find('span[name=urlimg]').attr('goodsid')){
                urlimg += ','+$(this).find('span[name=urlimg]').attr('key');
                urlimg += ';'+$(this).find('span[name=urlimg]').attr('goodsid');
                urlimg += ';'+$(this).find('span[name=urlimg]').attr('imgname');
            }     
        })
        if(urlimg==0){
            $.messager.show({
                title: '提示信息',
                msg:'没有上传图片，请上传图片'
            });
            return false;
        }
        $.getJSON(url,{urlimg:urlimg},function(data){
            if(data.success == 1){
                $.messager.show({
                    title: '提示信息',
                    msg: data.errorMsg
                });
                afterSave();
                $('#uploadimg').dialog('close');
//                $('#dg').datagrid('unselectAll');
//                $('#uploadimg').dialog('close');
//                $("#beatchimgList").empty();
//                $.each(caridobj,function(k,v){
//                    caridobj[k]=false;
//                });     
            }else{
                $.messager.show({
                    title: '错误信息',
                    msg: data.errorMsg
                });
            }
        }); 
    }
    var caridobj={};
    var goodsno=0;
    //删除整个商品图片
    function xximages(goodsid,goodsno){
        var key = $("#"+goodsid+"s").attr('key');
        var xxurl = Yii_baseUrl +"/dealer/marketing/DelImgGoods";
        $.getJSON(xxurl,{goodsid:goodsid},function(result){
            if(result){
//              $("#"+goodsno).remove(); 
              $.messager.show({title:'提示信息',msg:'删除成功'})  
            }else{
                if(!key){
                    $.messager.show({title:'提示信息',msg:'删除失败'})  
                    return false; 
                }

            }

        })
        $("#"+goodsno).remove(); 
        caridobj[goodsno]=false;
        goodsno=0;
    }
    //开始上传
    $(document).delegate('#file-upload-start-detc','click',function(){
        successNum = 0;
        errorNum = 0;
        $("#file-upload-totalinfo").html("");
        $("#file-upload-errorinfo").hide();
        $("#file-upload-errorinfo span").html("");	
        $('#file_upload-detc').uploadify('upload','*');
        return false;	
    });
    //开始上传

    $(function(){
        var fileClass = "<?php echo Commonmodel::getOrganID(); ?>";
        $("#betch_uploadimg").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader'	: Yii_baseUrl + '/upload/uploadify',
            'buttonText': '上传商品图片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 24,//flash高
            'method'    : 'post',
            'onUploadStart': function (file) {
                if(file.type!='.gif' && file.type!='.jpg' && file.type!='.png' && file.type!='.jpeg'){
                     $.messager.show({title:'提示信息',msg:'上传图片格式错误，请上传jpg，png，gif，jpeg格式的图片。'})
                }
                var imgarr=new Array();
               $("#beatchimgList .showimglist-img .showimages").each(function(){
                    imgarr.push($(this).find('span[name=urlimg]').attr('imgname'));
                })
                if($.inArray(file.name, imgarr)!=-1){ 
                      $.messager.show({title:'提示信息',msg:'上传失败'+file.name+'已经上传'})
//                    $.messager.alert('提示信息','图片已上传','info');
    //              $(this).find('span[imgname='+file.name+']').remove(); 
                   $('#betch_uploadimg').uploadify('cancel', file.id);    // 清空队列
               //    $('#betch_uploadimg').uploadify('cancel');  // 取消第一个上传文件
                }
            } ,
            'formData'  :{'fileClass':fileClass,'add':'1','role':'second'},
//            'removeTimeout' : 0,//上传完成后，删除进度条
            //   'buttonImage' : Yii_theme_baseUrl + '/images/btns/btn.jpg',//设置按钮图片
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
            'queueSizeLimit' :30,                         //上传数量  
            'fileSizeLimit':'2MB',                         //上传文件的大小限制
            'button_image_url':'about:blank',
            //'onCancel'  : function(file){alert(file.name +' was canceled !');},
            'onClearQueue' : function(queueItemCount){alert(queueItemCount +' file(s) was removed !');},
            'onSelectError' : function (file, errorCode, errorMsg) {
                if(errorCode == SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE){
                    this.queueData.errorMsg = "不能传空文件!!";
                }
            },
            //'onQueueComplete' : function (queueData){ alert(queueData.uploadsSuccessful +' files were successfully !')},
            //'onComplete' : funComplete,                      //完成上传任务
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                if(responeseDataObj && responeseDataObj.code == 200){
                    if(!caridobj[responeseDataObj.GoodsNO]){
                         caridobj[responeseDataObj.GoodsNO]=false;
                    }
                    if(!caridobj[responeseDataObj.GoodsNO]){
                        var div = "<div class='form-row' mun='1' id='"+responeseDataObj.GoodsNO+"' style='height:auto; border:1px solid 	green;'><span><label style='width:641px;display:block;float:left'>"+responeseDataObj.GoodsName+":</label> <span name='spanxx' id='"+responeseDataObj.GoodsID+"s' key='0' onclick=xximages('"+responeseDataObj.GoodsID+"','"+responeseDataObj.GoodsNO+"')  class='close icon-close-green xx'></span></span>"
                        +"<p class='showimglist-img'>"
                        +"</p>"
                        +"</div>";
                        $("#beatchimgList").append(div);
                        caridobj[responeseDataObj.GoodsNO]=true;
                        var url =" <?php echo Yii::app()->createUrl('dealer/marketing/Geturl'); ?>";
                        $.getJSON(url,{GoodsID:responeseDataObj.GoodsID},function(data){
                            if(data){
                                var themurl = " <?php echo F::uploadUrl();  ?>";
                                $.each(data,function(index,val){
                                    var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+themurl+val.ImageUrl+">"+
                                     "<input type='hidden' name='detcImages' value="+val.ImageUrl+">"+
                                     "<span name='urlimg' onclick='xximage(this)' key="+val.ImageUrl+" imgname="+val.ImageName+" class='close icon-close-green xx'></span></span>";
                                    $("#"+responeseDataObj.GoodsNO+" .showimglist-img").append(span);
                                })
                            }
                        });
                    }
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1+responeseDataObj.filename;

                    var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+src+">"+
                        "<input type='hidden' name='detcImages' value="+responeseDataObj.filename+">"+
                        "<span name='urlimg' onclick='xximage(this)'goodsid="+responeseDataObj.GoodsID+"  imgname="+responeseDataObj.ImgName+" key="+responeseDataObj.filename+" class='close icon-close-green xx'></span></span>";
                    $("#"+responeseDataObj.GoodsNO+" .showimglist-img").append(span);
                    $("#"+responeseDataObj.GoodsID+"s").attr('key','1');
                    $('#betch_uploadimg').uploadify('cancel', file.id);
                    
                }else{
                    if(responeseDataObj.code == 150){
                        $("#"+responeseDataObj.GoodsNO).remove(); 
                    }
                    $('#betch_uploadimg').uploadify('cancel', file.id);    // 清空队列
                    $.messager.show({title:'提示信息',msg:responeseDataObj.msg})
                }
            }
        });
    });
</script>