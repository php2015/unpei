 <?php if(empty($model['service']))$model['service'] = new Service(); ?>
 <div id="edit" class='cont' style="display: none">
      	<div class="bor_back m-top">
            <p class="txxx">基础信息</p>
            <div class="txxx_info4 gs_info">
            <div class="m_left80">
             <?php
			    $form = $this->beginWidget('CActiveForm', array(
			        'id' => 'serviceformdata',
			    	'action' => Yii::app()->baseurl.'/servicer/servicecompany/index',
			        'htmlOptions' => array(
			            'enctype' => 'multipart/form-data',
			        ),
			    ));
			?>
             <p>
             <label>机构名称：</label>
             <?php
            	echo $form->textField($model, 'OrganName', array(
                	'class' => 'width250 input',
                    "data-options" => "required:true",
                    'maxlength' => '100'));
             ?>
             <?php echo $form->error($model, 'OrganName', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
             </p>
             <p>
             <label>成立年份：</label>
             <?php
             	$year = date('Y', time());
             	for ($i = 1980; $i <= $year; $i++) {
             		$data[$i] = $i . '年';
             	}
             ?>
             <?php echo $form->dropDownList($model, 'FoundDate', $data, array('class' => 'select')); ?>
             <label class=" m_left185">工 位 数：</label>
             <?php
                        echo $form->dropDownList($model['service'], 'PositionCount', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20',
                                ), array('class' => 'select'));
                    ?>
             </p>
             <p>
             <label>技师人数：</label>
             <?php
                        echo $form->dropDownList($model['service'], 'TechnicianCount', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20',
                                ), array('class' => 'select'));
                    ?>
             <label class=" m_left185">停车位数：</label>
             <?php
                        echo $form->dropDownList($model['service'], 'ParkingDigits', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20',
                                ), array('class' => 'select'));
                    ?>
             </p>
             <p>
             <label style="vertical-align:top">预约模式：</label>
             	<?php
                        echo $form->dropDownList($model['service'], 'ReservationMode', array(
                            '不需要担保' => '不需要担保',
                            '需要担保' => '需要担保',
                                ), array('class' => 'select'));
                    ?>
              <label class=" m_left185">店铺面积：</label>
             <?php
             	echo $form->dropDownList($model['service'], 'ShopArea', array(
                            '小于100㎡' => '小于100㎡',
                            '100㎡~200㎡' => '100㎡~200㎡',
                            '200㎡~300㎡' => '200㎡~300㎡',
                            '300㎡~400㎡' => '300㎡~400㎡',
                            '400㎡~500㎡' => '400㎡~500㎡',
                            '500㎡以上' => '500㎡以上',
                                ), array('class' => 'select'));
             ?>
             </p>
             <p>
             <label style="vertical-align:top">营业时间：</label>
             	<?php
                        echo Chtml::dropDownList('OpenTime[]', $opentime['0'], array(
                            '周一' => '周一',
                        	'周二' => '周二',
                        	'周三' => '周三',
                        	'周四' => '周四',
                        	'周五' => '周五',
                        	'周六' => '周六',
                        	'周七' => '周日',
                                ), array('class' => 'select'));
                       	echo Chtml::dropDownList('OpenTime[]', $opentime['1'], array(
                            '周一' => '周一',
                        	'周二' => '周二',
                        	'周三' => '周三',
                        	'周四' => '周四',
                        	'周五' => '周五',
                        	'周六' => '周六',
                        	'周七' => '周日',
                                ), array('class' => 'select'));
                         echo Chtml::dropDownList('OpenTime[]', $opentime['2'], array(
                            '0:00' => '0:00','1:00' => '1:00','2:00' => '2:00','3:00' => '3:00',
                            '4:00' => '4:00','5:00' => '5:00','6:00' => '6:00','7:00' => '7:00',
                            '8:00' => '8:00','9:00' => '9:00','10:00' => '10:00','11:00' => '11:00',
                            '12:00' => '12:00','13:00' => '13:00','14:00' => '14:00','15:00' => '15:00',
                            '16:00' => '16:00','17:00' => '17:00','18:00' => '18:00','19:00' => '19:00',
                            '20:00' => '20:00','21:00' => '21:00','22:00' => '22:00','23:00' => '23:00',
                                ), array('class' => 'select'));
                         echo Chtml::dropDownList('OpenTime[]', $opentime['3'], array(
                            '0:00' => '0:00','1:00' => '1:00','2:00' => '2:00','3:00' => '3:00',
                            '4:00' => '4:00','5:00' => '5:00','6:00' => '6:00','7:00' => '7:00',
                            '8:00' => '8:00','9:00' => '9:00','10:00' => '10:00','11:00' => '11:00',
                            '12:00' => '12:00','13:00' => '13:00','14:00' => '14:00','15:00' => '15:00',
                            '16:00' => '16:00','17:00' => '17:00','18:00' => '18:00','19:00' => '19:00',
                            '20:00' => '20:00','21:00' => '21:00','22:00' => '22:00','23:00' => '23:00',
                                ), array('class' => 'select'));
                    ?>
             </p>
             <p>
             <label style="vertical-align:top">机构简介：</label>
             	<?php echo $form->textArea($model, 'Introduction', array('size' => 255, 'maxLength' => 200, 'class'=>"textarea textarea2")); ?>
                <?php echo $form->error($model, 'Introduction', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                (机构简介最多为200字)
             </p>
             <div style="margin-top: 15px;"><div style="vertical-align:top" class="float_l">机构照片：</div> 
             <div class="float_l" style="margin-left:10px"><input type='file' name='file_upload' id="file_upload">
             <input type="hidden" value="上传" id="file-upload-start">
             <span style="line-height:25px;color:#888">图片最多上传5张</span></div>
             <div style="clear:both"></div>
             </div>
             <div class="upload_img m_left65">
                <ul>
                <div class="form-row" id="showimglist" style=" position: relative;">
	                <?php if (!empty($organphotos)): ?>
	                <?php foreach ($organphotos as $k => $organphoto): ?>
                	<li style="margin-right:5px">
                 	<img src="<?php echo F::uploadUrl() . $organphoto['Path']; ?>" style="width:80px;height:80px;">
                 	<span id="delfile" keyid="<?php echo $organphoto['Path'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl();?>/images/guanbi3.png"></span>
                  	</li>
	                <?php endforeach; ?>
	                <?php endif; ?>
                </div>
                <input type='hidden' value='' id="photoId" name='photoId' class='width114 input'>
                <div style="clear:both"></div>
                </ul>
             </div>
             </div>
            </div>  
         </div>
         <div class="bor_back m-top" style="margin-bottom:5px;padding-bottom:10px">
              <p class="txxx">联系方式</p>
            <div class="txxx_info4">
               <div class=" m_left80 gs_info">
                      <p>
                      <label>手&nbsp;&nbsp;机：</label>
                      <?php
                        echo $form->textField($model, 'Phone', array(
                            'class' => 'input',
                            'validtype' => 'mobile',
                            "data-options" => "required:true",
                            "maxlength" => '18'
                        ));
                        ?>
                        <?php echo $form->error($model, 'Phone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                      </p>
                      <p>
                      <label>邮&nbsp;&nbsp;箱：</label>
                      <?php
                        echo $form->textField($model, 'Email', array(
                            'class' => 'input',
                            'validtype' => 'email',
                            "data-options" => "required:true",
                            "maxlength" => '64'
                        ));
                        ?>
                        <?php echo $form->error($model, 'Email', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                      </p>
                      <p>
                      <label>qq&nbsp;&nbsp;号：</label>
                      <?php
                        echo $form->textField($model, 'QQ', array(
                            'class' => 'input',
                            'validtype' => 'QQ',
                            "maxlength" => '12'));
                        ?>
                        <?php echo $form->error($model, 'QQ', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                      </p>
                      <p>
                      <label">传&nbsp;&nbsp;真：</label>
                      <?php
                        echo $form->textField($model, 'Fax', array(
                            'class' => 'input',
                            "maxlength" => '15'));
                        ?>
                        <?php echo $form->error($model, 'Fax', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                      </p>
                      <p>
                      <label>座&nbsp;&nbsp;机：</label>
                      <?php 
                      	$telPhone = explode(",", $model->TelPhone);
                      	$j = 5;
                      	for ($i=0;$i<4;$i++){
                      		if ($j==5 && empty($telPhone[$i]))$j=$i;
                      	?>
                      		<input type="text" key="<?php echo $i;?>" class="input" maxlength="12" name="telPhone[]" value="<?php echo $telPhone[$i];?>" <?php if(empty($telPhone[$i]) && $i!=0) echo 'style="display:none"';?>/>
                      	<?php }?>
                      	<span id="addTel"><a style="cursor:pointer;">添加</a></span>
                      </p>
                      <p>
                      <label>地&nbsp;&nbsp;址：</label>
                      <?php
                        /*echo $form->textField($model, 'Address', array(
                            'class' => 'easyui-validatebox width213 input',
                            "data-options" => "required:true",
                            "maxlength" => '64'
                        ));*/
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));

                        $state = CHtml::listData($state_data, "ID", "Name");
                        $s_default = $model->isNewRecord ? '' : $model->Province;
                        echo $form->dropDownList($model, 'Province', $state, array(
                            'class' => 'select',
                            'empty' => '请选择省份',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                                'update' => '#Organ_City', //selector to update
                                'data' => 'js:"province="+jQuery(this).val()',
                                )));

                        //empty since it will be filled by the other dropdown
                        $c_default = $model->isNewRecord ? '' : $model->City;
                        if (!$model->isNewRecord) {
                            $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->Province));
                            $city = CHtml::listData($city_data, "ID", "Name");
                        }

                        $city_update = $model->isNewRecord ? array() : $city;
                        echo $form->dropDownList($model, 'City', $city_update, array(
                            'class' => 'select',
                            'empty' => '请选择城市',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                                'update' => '#Organ_Area', //selector to update
                                'data' => 'js:"city="+jQuery(this).val()',
                                )));
                        $d_default = $model->isNewRecord ? '' : $model->Area;
                        if (!$model->isNewRecord) {
                            $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->City));
                            $district = CHtml::listData($district_data, "ID", "Name");
                        }
                        $district_update = $model->isNewRecord ? array() : $district;
                        echo $form->dropDownList($model, 'Area', $district_update, array(
                            'class' => 'select',
                            'empty' => '请选择地区',
                                )
                        );
                        ?>
					<?php
                        echo $form->textField($model, 'Address', array(
                            'class' => 'input',
                            ));
                   		?>
					  </p>
                     
                </div>
         
         
            </div>
         </div>
         <div class="bor_back m-top">
            <p class="txxx">营业执照</p>
            <div class="txxx_info4 gs_info">
            <div class="m_left80">
             <p>
             <label class="m_left12">注册号：</label>
             <?php
            	echo $form->textField($model, 'Registration', array(
                	'class' => 'width250 input',
                    "data-options" => "required:true",
                    'maxlength' => '15'));
             ?>
             <?php echo $form->error($model, 'Registration', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
             </p>
             <div style="margin-top: 15px;"><div style="vertical-align:top" class="float_l">执照照片：</div> 
             <div class="float_l" style="margin-left:10px"><input type='file' name='BLPoto_upload' id="BLPoto_upload">
             <input type="hidden" value="上传" id="file-upload-start">
             </div>
             <div style="clear:both"></div>
             </div>
             <div class="upload_img upload_photo m_left65">
                <ul>
                <div class="form-row" id="showBLPhotolist" style=" position: relative;">
	                <?php if (!empty($model['BLPoto'])): ?>
                	<li style="margin-right:5px">
                 	<img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:80px;height:80px;" />
                 	<span id="delphoto" keyid="<?php echo $model['BLPoto'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl();?>/images/guanbi3.png" /></span>
                  	</li>
	                <?php endif; ?>
                </div>
                <input type='hidden' value='<?php echo $model['BLPoto'] ?>' id="BLPoto" name='BLPoto' class='width114 input'/>
                <div style="clear:both"></div>
                </ul>
             </div>
             </div>
            </div>  
         </div>
         <?php $this->renderPartial("uploadBLPhoto");$this->endWidget();?>
         <p class="m-top20" align="center"><input id="save" type="submit" class="submit" value="保存"><button id="cancel" class="button3">取消</button></p>
      </div>
   <script type="text/javascript">
    $(document).ready(function(){
			$("#cancel").click(function(){
				window.location.href = '<?php echo Yii::app()->createUrl("servicer/servicecompany/index");?>';
			});
        })
   </script>