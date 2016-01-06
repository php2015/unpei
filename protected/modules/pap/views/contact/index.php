<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; width:100px; text-indent:0}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    .tb_head li{ float:left; color:#fff ; text-align:center}
    .tb_head .sp_info{ width:380px}
    .tb_head .price{ width:150px}
    .tb_head .shuliang{ width:95px}
    .tb_head .s_fukuan{ width:160px}
    .tb_head .caozuo{ width:90px}
    .sp_plcl a{ padding:0px 5px}
    .sp_plcl{ border:1px solid #ccc; display:inline-block; height:20px; line-height:20px;}
    .mbx4{ background:#eff4fa;}
    .mbx4 span{  color:#666}
    span.zwq_color{ color:#fb540e}
    .splb_order{ width:780px}
    .splb_order li{ height:100px; border-bottom:1px solid #ccc; border-right:1px solid #ccc}
    div.div_info{ text-align:left}
    .splb_order .price,.splb_order .shuliang,.splb_order .s_fukuan{ line-height:100px}
    .splb_order .price{ font-weight:400}
    li.last{ border-bottom:none}
    /*    .zkss{display:inline-block; width:100px; height:26px; cursor:pointer}
        .zkss2{display:inline-block; width:100px; height:26px; cursor:pointer}
        .zkss{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px -26px;}
        .zkss2{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px 0px;;}*/
    .zwq_chuxiao_info{ width:270px}
    .cuxiao{ line-height:100px; text-align:center; margin-right:5px; width:120px}
    .yicuxiao{ color:#ccc}
    .cuxiao button{ margin-top:35px}
    span.cxsp{ border:1px solid #ebebeb; margin-left:10px; padding:3px 10px; background:#fff}
    span.cxsp a{ color:#999; font-weight:400}
    .m-left5{ margin-left:5px}
    .m_left185{ margin-left:185px}
    .cx_cz span{ line-height:15px;}
    .m-top20{ margin-top:20px}
    .m_left120{ margin-left:120px}
    .cankaojia{ text-decoration:line-through}
    .m_left34{margin-left:34px; margin-left:38px\9}
    .add_progoods{*margin-top:-35px}
    .submit3{background: url(<?php echo F::themeUrl() ?>/images/images/submit3.jpg) no-repeat; width:100px}
    .add_progoods{display:block;float: right;margin-right:35px;} 
    .add_progoods a:hover{color:#FB540E;text-decoration: underline}
    .zwq_name a{ font-size:14px}

    .OrganName{width:200px;white-space:nowrap; overflow:hidden;text-overflow:ellipsis;}
    .OrganName a{display:block;height:20px; width:200px;white-space:nowrap; overflow: hidden;text-overflow:ellipsis;}

</style>
<?php
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '客户管理',
);
?>    

<div class="bor_back m-top" >
    <p class="txxx">客户管理</p>
    <div class="">
        <form method="get" action="<?php echo Yii::app()->createUrl('pap/contact/index') ?>">
            <p style="padding-top: 5px;">
                <label>&nbsp;&nbsp;机构名称：</label>
                <input type="text" name="OrganName" class=" input input3" value="<?php echo $OrganName ?>">
                <label  class=" m_left24">电话：</label>
                <input type="text" name="Phone" class=" input input3" value="<?php echo $Phone ?>">
                <input type="submit" class="submit f_weight  m_left"  value="搜 索">
            </p>
        </form>
    </div>
    <br />
    <div class="ddgl_content3 m_top10 bor_back">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                    'value' => '$data[rowNO]',
                ),
                array(
                    'header' => '机构名称',
                    'name' => 'OrganName',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data[OrganName]))',
                ),
                array(// display 'author.username' using an expression
                    'name' => '客户级别',
                    'value' => 'ContactService::getServicelv($data[ID])',
                ),
                array(// display 'author.username' using an expression
                    'name' => '电话',
                    'value' => '$data[Phone]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '邮箱',
                    'value' => '$data[Email]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '修改时间',
                    'value' => 'ContactService::getpdateTime($data[ID])',
                ),
                array(// display 'author.username' using an expression
                    'name' => '地址',
                    'value' => 'CHtml::encode(Area::getCity($data[Province]) . Area::getCity
($data[City]) . Area::getCity($data[Area]))'
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{update}',
                    'buttons' => array(
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/pap/contact/editlist",array
("id"=>$data[ID]))'
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".grid-view").find("tbody tr").each(function() {
            var OrganName = $(this).find("td:eq(1)").find("a").html();
            $(this).find("td:eq(1)").addClass('OrganName');
            $(this).find("td:eq(1)").find("a").attr("title", OrganName);
        });
    });
</script>