<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />

<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
</style><?php
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '营销参数设置' => Yii::app()->createUrl('pap/discountset/index'),
    '客服管理'
);
$this->pageTitle = Yii::app()->name . ' - 客服管理';
?>

<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li><a href="<?php echo Yii::app()->createUrl('pap/discountset/index') ?>">价格管理 <span class="zwq_color"><?php echo $count[1] ?></a></span><span class="interval">  |</span></li>
            <li><a href="<?php echo Yii::app()->createUrl('pap/discountset/turnover') ?>">订单最小金额 </a><span class="interval">  |</span></li>
            <li class="current"><a href="<?php echo Yii::app()->createUrl('pap/cs/index') ?>">客服管理 </a><span class="interval">  |</span></li>
        </ul>
    </div>

    <div style="margin-left:3px;margin-bottom:5px;">
        <span style="background-position: 0 -153px;text-indent:25px; line-height:35px" class="xjd">
            <a style="cursor:pointer;" href="<?php echo Yii::app()->createUrl('pap/cs/new'); ?>" id="new">新建客服</a></span>
    </div>
    <div class="ddgl_content3 m_top10 bor_back "  >
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $lists,
            'id' => 'cslists',
            'columns' => array(
                array(
                    'name' => '客服名称',
                    'value' => '$data[Name]',
                ),
                array(
                    'name' => '客服QQ',
                    'value' => '$data[QQ]',
                ),
                array(
                    'name' => '创建时间',
                    'value' => 'date("Y-m-d H:i",$data[CreateTime])',
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{update}{delete}',
                    'buttons' => array(
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/pap/cs/new",array("id"=>$data[ID]))'
                        ),
                        'delete' => array(
                            'label' => '删除',
                            'url' => 'Yii::app()->createUrl("/pap/cs/del",array("id"=>$data[ID]))',
                            'click' => 'function(){
                                if(confirm("你确定要删除此条客服数据?")){
                                      var url=$(this).attr("href");
                                      $.getJSON(url,{},function(res){
                                            if(res.res==1){
                                               alert("删除成功");
                                               location.reload();
                                            }else{
                                               alert("删除失败");
                                            }
                                      })
                                }
                                return false;
                            }',
                        )
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>
<script>
    $(function(){
        $('#new').click(function(){
            if($('#cslists tbody tr').length==5){
                alert('最多只能添加5个客服');
                return false;
            }
        })
    })
</script>

