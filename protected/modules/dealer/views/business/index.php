<style>
    .dt-left{float:left;width:518px;}
    .dt-right{width:200px;float:left;}
    .dttable{width:100%;}
    .dttable tr{height:30px;}
    .label{width: 80px;}
    #showimglist img { margin-left:5px;}
</style>
<div style='display:<?php echo $display ?>'> <!-- 展示 -->
    <div class="dtdiv inner-padding auto_height">
        <div class='title title-dashed'>
            <a class='float-r icon-pencil' href="<?php echo Yii::app()->createUrl('dealer/business/index/flag/update'); ?>">修改</a>
            基础信息
        </div>
<!--        <div class='form-list'>-->
            <div class="dt-left">
                <table class="dttable" style="table-layout: fixed;word-wrap:break-word;">
                    <tr >
                        <td align="right" width=110>机构名称:</td>
                        <td width=165><?php echo $model['organName']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" width=110>成立年份:</td>
                        <td width=165><?php echo $model['FoudingDate']; ?>年</td>
                        <td align="right" width=110>店铺面积:</td>
                        <td width=165><?php echo $model['StoreSize']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" width=110>年销售额:</td>
                        <td width=165><?php echo $model['SaleMoney']; ?>元</td>
                        <td align="right" width=110>经营地域:</td>
                        <td width=165><?php Area::showCity($model['BusinessScope']); ?></td>
                    </tr>
                    <tr>
                        <td align="right" width="110">机构简介:</td>
                        <td colspan="3" ><?php echo $model['organIntroduction']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="dt-right">		
                <div id="images" class="row" style="display:inline-block;">
                    <?php if (!empty($model['organPhoto'])): ?>
                        <?php $src = F::uploadUrl() . $model['organPhoto'] ?>
                        <img src="<?php echo $src; ?>" alt="<?php echo $photo['organName'] ?>" style="width:200px;height:190px;">
                    <?php endif; ?>
                </div>
            </div>
<!--        </div>-->
    </div>
    <div class="dtdiv inner-padding auto_height">
        <div class='title title-dashed'>联系方式</div>
        <div style="float:left;width:550px;height:180px;">	
            <table class="dttable">
                <tr>
                    <td width=110 align="right">手　　机:</td>
                    <td width=165><?php echo $model['Phone']; ?></td>
                    <td width=110 align="right">固定电话:</td>
                    <td width=165><?php echo $model['ContactPhone']; ?></td>
                </tr>
                <tr>
                    <td align="right">传　　真:</td>
                    <td><?php echo $model['Fax']; ?></td>
                    <td align="right">QQ 号 码:</td>
                    <td><?php echo $model['QQ']; ?></td>
                </tr>
                <tr>
                    <td align="right">邮　　箱:</td>
                    <td colspan="3"><?php echo $model['Email']; ?> </td>
                </tr>
                <tr>
                    <td align="right">地　　址:</td>
                    <td colspan="3"><?php
                    Area::showCity($model['province']);
                    Area::showCity($model['city']);
                    Area::showCity($model['area']);
                    ?></td>
                </tr>			
            </table>
        </div>
    </div>
    <div class=' jgcx photos content-rows15 bg-white' style="width:750px;">
        <div class='title'>&nbsp;&nbsp;机构照片</div>
        <div class='pos-r'style="width:765px;">
            <a href='javascript:;' class="arr-l scroll-left"></a>
            <div class="photos-list" style="width:750px;">
                <ul>
                    <?php if (!empty($organphotos)): ?>
                        <?php foreach ($organphotos as $k => $organphoto): ?>
                            <?php $src = F::uploadUrl() . $organphoto['photoName'] ?>
                            <li>
                                <?php $picurl = F::uploadUrl() . $value['photoName']; ?>
                                <a href="javascript:;;"><span class='showimages'>
                                        <img src="<?php echo $src; ?>" alt="<?php echo $photo['organName'] ?>" title="<?php echo $model['organPhoto']; ?>" style='width:120px;height:120px;'>
                                    </span></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <a href='javascript:;' class="arr-r scroll-right" style="background-color: #fff;"></a>
        </div>
    </div>

</div> 
<div class='' style='display:<?php echo $display == 'none' ? 'block' : 'none' ?>'>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'dealer-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
            ));
    ?>
    <div class="dtdiv inner-padding">
        <div class='title title-dashed'>
            <a class='float-r' href="<?php echo Yii::app()->createUrl('dealer/business/index'); ?>">返回</a>
            基础信息
        </div>
        <div class='form-list'>
            <table class="dttable">
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构名称:', array('class' => 'label')); ?></td>
                    <td colspan=3>
                        <?php
                        echo $form->textField($model, 'organName', array(
                            'class' => 'easyui-validatebox width213 input',
                            "data-options" => "required:true",
                            'maxlength' => '100'));
                        ?>
                        <?php echo $form->error($model, 'organName', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                        <input type="hidden" id="dealerid" value="<?php echo $model['id'] ?>">
                    </td>
                </tr>
                <tr id="showjp" style="display:none">
                    <td colspan="4">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        嘉 配 ID:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $model['jiapartsId']; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        登录密码:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "******"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo Yii::app()->createUrl('user/profile/changepassword') ?>" style="color: green">修改密码</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        企业类型:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Companytype::showIdentity(); ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" width=50><?php echo $form->labelEx($model, '成立年份:', array('class' => 'label')); ?></td>
                    <td width=309>
                        <?php
                        $year = date('Y', time());
                        for ($i = 1990; $i <= $year; $i++) {
                            $data[$i] = $i . '年';
                        }
                        ?>
                        <?php echo $form->dropDownList($model, 'FoudingDate', $data, array('class' => 'width100 select')); ?>
                        <?php echo $form->error($model, 'FoudingDate', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                    <td align="right" width=50><?php echo $form->labelEx($model, '店铺面积:', array('class' => 'label')); ?></td>
                    <td width=409>
                        <?php
                        $data = array(
                            '小于100 平米' => '小于100平米',
                            '100~200 平米' => '100~200平米',
                            '200~300 平米' => '200~300平米',
                            '300~400 平米' => '300~400平米',
                            '400~500 平米' => '400~500平米',
                            '大于500 平米' => '大于500平米',
                        );
                        ?>
                        <?php echo $form->dropDownList($model, 'StoreSize', $data, array('class' => 'width118 select')); ?>
                        <?php echo $form->error($model, 'StoreSize', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" width=50><?php echo $form->labelEx($model, '年销售额:', array('class' => 'label')); ?></td>
                    <td width=309>
                        <?php
                        $data = array(
                            '100000' => '100000',
                            '500000' => '500000',
                            '1000000' => '1000000',
                            '2000000' => '2000000',
                            '5000000' => '5000000',
                            '10000000' => '10000000',
                            '30000000' => '30000000',
                            '50000000' => '50000000',
                            '80000000' => '80000000',
                            '一亿以上' => '一亿以上',
                                )
                        ?>
                        <?php echo $form->dropDownList($model, 'SaleMoney', $data, array('class' => 'width100 select')); ?>
                        <?php echo $form->error($model, 'SaleMoney', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                    <td align="right" width=50><?php echo $form->labelEx($model, '经营区域:', array('class' => 'label')); ?></td>
                    <td width=409>
                        <?php
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                        $state = '';
                        $state = CHtml::listData($state_data, "id", "name");
                        $s_default = $model->isNewRecord ? '' : $model->province;
                        echo $form->dropDownList($model, 'BusinessScope', $state, array(
                            'class' => 'width118 select',
                            'empty' => '请选择省份',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                )));
                        ?>
                        <?php echo $form->error($model, 'BusinessScope', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构照片:', array('class' => 'label')); ?></td>
                    <td colspan=3>
                        <!--                        <div id="image" class="row" style="display:inline-block;margin-top:10px;">
                        
                                                </div>-->
                        <div class="form-row" >
                            <input type='file' name='file_upload' id="file_upload">
                            <input type="hidden" value="上传" id="file-upload-start">
                            <!--        <label>	<a class="btn"  href="javascript:$('#file_upload').uploadify('upload','*')">上   传</a>
                                        <a href="javascript: $('#file_upload').uploadify('cancel','*')">清除所有</a></label>-->
                            <p id='hidden_upnames'></p>
                            <div class="form-row" id="showimglist" style=" position: relative;">
                                <?php if (!empty($organphotos)): ?>
                                    <?php foreach ($organphotos as $k => $organphoto): ?>
                                        <?php $src = F::uploadUrl() . $organphoto['photoName'] ?>
                                        <span class='showimages'>
                                            <img src="<?php echo $src; ?>" alt="<?php echo $photo['organName'] ?>" title="<?php echo $model['organPhoto']; ?>" style="width:100px; height:100px;">
                                            <span onclick='xximage(this)' key="<?php echo $organphoto['photoName'] ?>" class='close icon-close-green xx'></span>
                                            <?php // echo $k; ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>       <!--显示上传的图片-->

                        </div>
                <!--						<input type='file' name='file_upload' id="file_upload" class="span5" />文件格式为:*.jpg;*.png;*.gif 最大上传文件2M
                                                                <span style="color:red; margin-left:20px;" id="message"></span>-->

                    </td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构简介:', array('class' => 'label')); ?></td>
                    <td colspan=3>
                        <?php echo $form->textArea($model, 'organIntroduction', array('class' => 'width527 textarea', 'maxLength' => 255, 'style' => 'vertical-align: top; height: 100px;')); ?>
                        <?php echo $form->error($model, 'organIntroduction', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="dtdiv inner-padding">
        <div class='title title-dashed'>联系方式</div>
        <div class='form-list'>
            <table class="dttable">
                <tr>
                    <td width=50><?php echo $form->labelEx($model, '手　　机:', array('class' => 'label')); ?></td>
                    <td width=309><?php
                        echo $form->textField($model, 'Phone', array(
                            'class' => 'easyui-validatebox width90 input',
                            'validtype' => 'mobile',
                            "data-options" => "required:true",
                            "maxlength" => '18'));
                        ?>
                        <?php echo $form->error($model, 'Phone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                    <td width=50><?php echo $form->labelEx($model, '固定电话:', array('class' => 'label')); ?></td>
                    <td width=409><?php
                        echo $form->textField($model, 'ContactPhone', array(
                            'class' => 'easyui-validatebox width100 input',
                            'validtype' => 'telephone',
                            "maxlength" => '60'));
                        ?>
                        <?php echo $form->error($model, 'ContactPhone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '传　　真:', array('class' => 'label')); ?></td>
                    <td><?php echo $form->textField($model, 'Fax', array('class' => 'easyui-validatebox width90 input')); ?>
                        <?php echo $form->error($model, 'Fax', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                    <td align="right"><label class="label">QQ 号 码:</label></td>
                    <td><?php
                        echo $form->textField($model, 'QQ', array(
                            'class' => 'easyui-validatebox width90 input',
                            'validtype' => 'QQ',
                            "maxlength" => '12'));
                        ?>
                        <?php echo $form->error($model, 'QQ', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '邮　　箱:', array('class' => 'label')); ?></td>
                    <td colspan=3><?php
                        echo $form->textField($model, 'Email', array(
                            'class' => 'easyui-validatebox width213 input',
                            'validtype' => 'email',
                            "data-options" => "required:true",
                            "maxlength" => '64'));
                        ?>
                        <?php echo $form->error($model, 'Email', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '地　　址:', array('class' => 'label')); ?></td>
                    <td colspan="3"><?php
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                        $state = CHtml::listData($state_data, "id", "name");
                        $s_default = $model->isNewRecord ? '' : $model->province;
                        echo $form->dropDownList($model, 'province', $state, array(
                            'class' => 'width144 select',
                            'empty' => '请选择省份',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                // 'url'=>CController::createUrl('dynamiccities'), //url to call
                                'url' => Yii::app()->request->baseUrl . '/Common/dynamiccities', //url to call
                                'update' => '#Dealer_city', //lector to update
                                'data' => 'js:"province="+jQuery(this).val()',
                                )));

                        //empty since it will be filled by the other dropdown
                        $c_default = $model->isNewRecord ? '' : $model->city;
                        if (!$model->isNewRecord) {
                            $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->province));
                            $city = CHtml::listData($city_data, "id", "name");
                        }

                        $city_update = $model->isNewRecord ? array() : $city;
                        echo '&nbsp;' . $form->dropDownList($model, 'city', $city_update, array(
                            'class' => 'width144 select',
                            'empty' => '请选择城市',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/Common/dynamicdistrict', //url to call
                                'update' => '#Dealer_area', //lector to update
                                'data' => 'js:"city="+jQuery(this).val()',
                                )));
                        $d_default = $model->isNewRecord ? '' : $model->area;
                        if (!$model->isNewRecord) {
                            $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->city));
                            $district = CHtml::listData($district_data, "id", "name");
                        }
                        $district_update = $model->isNewRecord ? array() : $district;
                        echo '&nbsp;' . $form->dropDownList($model, 'area', $district_update, array(
                            'class' => 'width144 select',
                            'empty' => '请选择地区',
                                )
                        );
                        ?>
                        <?php echo $form->error($model, 'province', array('style' => 'color: red')); ?></td>
                </tr>
                <tr><td colspan=4 align="center"></td></tr>
                <tr><td colspan=4 align="center">
                        <?php echo CHtml::button('保存资料', array('class' => 'submit', 'style' => "margin-right:58px;")); ?></td></tr>
            </table>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- /content -->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.css">
<script type="text/javascript">
    $(document).ready(function(){
        //处理IE中maxlength无用问题
        $("textarea[maxlength]").keyup(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        });
        //复制的字符处理问题
        $("textarea[maxlength]").blur(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        }); 
        $(".submit").click(function(){
            var name=$("#Dealer_organName").val();
            var phone=$("#Dealer_Phone").val();
            var email=$("#Dealer_Email").val();
            $.getJSON(Yii_baseUrl+'/dealer/business/checkorgan',{
                name:name,
                phone:phone,
                email:email
            },function(result){
                if(result.result){
                    $.messager.confirm('提示框', '您确定要保存吗?',function(result){
                        if(result){
                            $("#dealer-form").submit();
                        }
                    });
                }else{
                    $.messager.alert('提示', result.message, 'info');
                }
            });
        });
        $("#dealer-form").form({
            url:Yii_baseUrl + '/dealer/business/savedealerorgan',
            success:function(data){
                var data = eval('('+data+')');
                if(data=='OK'){
                    window.location.href=Yii_baseUrl + '/dealer/business/index';
                }else if(data=='NoOk'){
                    $.messager.alert('提示',"保存失败",'info');
                }else{
                    $("#message").html(data);
                }
            }
        });
        $("table tbody tr").removeClass("bg-green-light");
        $("table tbody tr").live({
            mouseout: function() {
                $(this).removeClass("tr-hover");
            },
            mouseover: function() {
                $(this).removeClass("tr-hover");
            }
        });
		
        $("#Dealer_organName").click(function(){
            //	$("#showjp").toggle();
            //alert(123);
        });
        var url=Yii_baseUrl;
        $("#Dealer_province").change(function(){
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(url+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#Dealer_area").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#Dealer_area");
                        }); 
                    }
                });
            }else{
                $("#Dealer_area").empty();
                $("<option value=''>请选择地区</option>").appendTo("#Dealer_area");
            }
        });
        //        $(".icon-close-green").click(function(){
        //            var dealerid = $("#dealerid").val();
        //            var imageName = $(this).prev("img").attr('title');
        //            //			alert(imageName);
        //            var bool = confirm("确定要删除图片吗？");
        //            if(bool){
        //                var url = Yii_baseUrl + "/dealer/business/deleteImage";
        //                $.ajax({
        //                    url: url,
        //                    type: "POST",
        //                    data: {
        //                        'imageName': imageName,
        //                        'dealerid': dealerid
        //                    },
        //                    dataType: "json",
        //                    success:function(data){
        //                        // alert(data);
        //                        if(data==1){
        //                            $(".icon-close-green").prev('img').remove();
        //                            $("#colseimage").remove();
        //                            setTimeout("location.reload();",500);
        //                        }
        //                    }
        //                });
        //            }
        //        });
		
    })
</script>
<script>
    $(function(){
        //alert(Yii_theme_baseUrl);
       <?php $organID=Commonmodel::getOrganID()?>
        <?php $identity=Commonmodel::getIdentity($organID);?>
        var fileClass =  <?php echo Commonmodel::getOrganID();?>;
        var identity=<?php echo $identity['identity'];?>;
        $("#file_upload").uploadify({
            'auto'	: true,
            'queueId'	: 'some_file+queue',
            'swf'	: Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
          //  'uploader'	: Yii_baseUrl + '/dealer/marketing/uploadify2',
            'uploader'	: Yii_baseUrl + '/upload/uploadify',
            'buttonText': '上传机构图片',
            //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
            'height'    : 24,//flash高
            'method'    : 'post',
            'formData'  :{'fileClass':fileClass,'identity':identity},
            //   'buttonImage' : Yii_theme_baseUrl + '/images/btns/btn.jpg',//设置按钮图片
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.jpeg',
            // 'fileTypeExts': '*.gif; *.jpg ; *.png;*.bmp',
            'queueSizeLimit' : 5,                         //上传数量  
            'fileSizeLimit':'3MB',                         //上传文件的大小限制
            //'onCancel'  : function(file){alert(file.name +' was canceled !');},
            //  'onClearQueue' : function(queueItemCount){alert(queueItemCount +' file(s) was removed !');},
            //'onQueueComplete' : function (queueData){ alert(queueData.uploadsSuccessful +' files were successfully !')},
            //'onComplete' : funComplete,                      //完成上传任务
            'onUploadSuccess':function(file, data, response){//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                // alert(responeseDataObj.filename);
                var errorinfo = '';
                if(responeseDataObj && responeseDataObj.code == 200){
<?php $organID = Commonmodel::getOrganID(); ?> 
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1+responeseDataObj.filename;
                    var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+src+"><span onclick='xximage(this)' key="+responeseDataObj.filename+" class='close icon-close-green xx'></span><input type='hidden' name='goodsImages[]' value="+responeseDataObj.filename+"></span>";
                    $("#showimglist").append(span);
                   // $("#hidden_upnames").append("<input type='hidden' name='goodsImages[]' value="+responeseDataObj.filename+">");
                }else{
                    errorinfo += '文件' + responeseDataObj.filename + '上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
            },
        });
    })
    // 删除图片
    function xximage(obj){
        var xximage = obj.getAttribute("key");
        // alert(xximage);
        // $("#goodsImage").remove();
        // alert(123);
        var xxurl = Yii_baseUrl +"/dealer/business/deleteimg";
        $.getJSON(xxurl,{xximage:xximage},function(result){
        })
    }
   
</script>

