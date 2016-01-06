<?php
$this->pageTitle = Yii::app()->name . '-' . "服务管理";
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '服务管理',
);
?>
<link href="<?php echo F::themeUrl(); ?>/css/manage.css" type="text/css" rel="stylesheet">

<script>
    $(document).ready(function(){
        $("#type  option[value='<?php echo $type; ?>'] ").attr("selected",true);
        $("#time  option[value='<?php echo $time; ?>'] ").attr("selected",true);
    })
</script>
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl(); ?>/css/yxgl.css"/>
<div class="bor_back m-top5">

    <p class="txxx txxx3">服务记录列表
    </p>
    <p style="height:2px">
        <span class="xjd" style="display: block;float: right;margin-top: -34px;"><a href="<?php echo Yii::app()->createUrl('/servicer/servicemanage/checkcars'); ?>" style="font-weight:400;">添加</a></span>
    </p>
    <div class="txxx_info4">
        <form action="<?php echo Yii::app()->createUrl('servicer/servicemanage/index'); ?>" method="post"  target="_self">    
            <div class="gsxx" style="margin:10px 20px">
                <p class="m-top5">
                    <label class="label1 m_left12">车牌号：</label>
                    <input type="text" name="plate" class="width150 input" value="<?php echo $plate; ?>">
                    <label class="label1 m_left40">服务类型：</label>
                    <select id="type" class="width88 select " name="type" value="<?php echo $type; ?>">
                        <option value="">请选择</option>
                        <option value="1">日常保养</option>
                        <option value="2">配件服务</option>
                        <option value="3">全部服务</option>
                    </select>
                    <label class="label1 m_left40">车主姓名：</label>
                    <input type="text" name="name" class="width150 input"  style="margin-left:7px" value="<?php echo $name; ?>">
                </p>
                <p class="m-top5">

                    <label class="label1 ">登记时间：</label>
                    <select id="time" class="width88 select" name="time">
                        <option value="">显示全部</option>
                        <option value="1">一周内</option>
                        <option value="2">一月内</option>
                        <option value="3">三月内</option>
                        <option value="4">六月内</option>
                        <option value="5">一年内</option>
                    </select>
                    <input type="submit" value="查   询"  class="submit m_left65" >
                </p>



            </div>
        </form>
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'ajaxUpdate' => true,
            'id'=>'car_service_list',
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                ),
                array(// display 'author.username' using an expression
                    'name' => '登记时间',
                    'value' => 'CHtml::encode(date("Y-m-d H:i:s",$data->CreateTime))',
                ),
                array(// display 'author.username' using an expression
                    'name' => '车主姓名',
                    'value' => 'CHtml::encode($data->vehicle->owner->Name)',
                ),
                array(// display 'author.username' using an expression
                    'name' => '车牌号',
                    'value' => 'CHtml::encode($data->vehicle->LicensePlate)',
                ),
                array(// display 'author.username' using an expression
                    'name' => '手机号',
                    'value' => 'CHtml::encode($data->vehicle->owner->Phone)',
                ),
                array(// display 'author.username' using an expression
                    'name' => '服务类型',
                    'value' => 'CHtml::encode($data->ServiceType)',
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{view}{update}{delete}',
                    'buttons' => array(
                        'view' => array(
                            'label' => '详情',
                            'url' => 'Yii::app()->createUrl("/servicer/servicemanage/detail",array("id"=>$data->ID))'
                        ),
                        'update' => array(
                            'label' => '编辑',
                            'url' => 'Yii::app()->createUrl("/servicer/servicemanage/edit",array("id"=>$data->ID))'
                        ),
                          'delete' => array
                    (
                    'label' => '删除',
                    'visible' => 'true',
                    'click' => 'function(){
                          var bool=confirm("您确定要删除吗");
                         if(bool==false)
                         {
                          return false;
                         }
                          $.ajax({
                              url: $(this).attr("href"),
                              type:"get",
                              dataType:"JSON",
                              success:function(data)
                              {
                                if(data !=1){
                                 alert("删除失败");
                                 return false;
                                }else if(data==1){
                                   alert("删除成功");
                                   $.fn.yiiGridView.update(
                                   "car_service_list"
                                   )
                                   return false;
                                }
                              }
                          })
                          return false;
                        }',
                    'url' => 'Yii::app()->createUrl("/servicer/servicemanage/deleteservice",array("id"=>$data->ID))',
                ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>