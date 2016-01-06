<style>    
    .wlxx_lm{ height:30px; line-height:30px; background:#EFF4FA; border-bottom:1px solid #C9D5E3}
    .ylr{ background:#eff4fa; margin:10px 0px 10px 90px; width:730px; padding:15px 10px 10px}
    .ylr_ul{ margin:15px 10px 10px 90px}
    .ylr_ul li{ line-height:25px}
    .f_weight {font-weight: bold;}
    .jxs_area{ height:35px; line-height:36px; background:#f7f7f7; border:1px solid #ddd; margin:10px}
    .float_r {float: right;}
    .color_blue {color: blue;}
    .zdiul {margin-top:5px;margin-left:15px;min-height:30px;height:auto;}
    .zdiul li {width:30%;float:left;margin-right:10px;margin-bottom:5px;list-style: none outside none;}
    .m_left20{ margin-left:20px}
    .txxx {border-bottom: 1px solid #c9d5e3;color:#0065bf;font-size:14px;font-weight:bold;height:35px;line-height:35px;text-indent:15px;}
    .m-top { margin-top: 10px;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 物流管理';
$this->breadcrumbs = array(
    '内容管理' => Yii::app()->createUrl('logistics/index'),
    '物流列表'
);
$this->menu = array(
    array('label' => '新建物流信息', 'icon' => 'plus', 'url' => array('add')),
);
?>
<div class="bor_back m-top" style="height:auto; position:relative">
    <div class="txxx_info5">
        <p style="margin-top:5px;"><span class="add m_left"></span><a href="<?php echo Yii::app()->createUrl('/logistics/add') ?>" class="add_wz alternative">新建物流信息</a></p>
        <?php
        $this->widget('bootstrap.widgets.TbListView', array(
            'dataProvider' => $lists,
            'ajaxUpdate' => false,
            'itemView' => 'lists',
            'id' => 'loglists'
        ));
        ?>
    </div>
</div>
<script>
    //删除物流信息
    $(document).on("click",".dellog",function(){
        if(confirm("你确定要删除此条物流信息?"))
        { 
            var id=$(this).attr('logid');
            var url=Yii_baseUrl+'/backend.php/logistics/del';
            var yiicsrf="<?php echo Yii::app()->request->csrfToken; ?>";
            $.post(url,{'logid':id,'YII_CSRF_TOKEN':yiicsrf},function(res){
                if(res.count>0){
                    location.reload();
                }else{
                    alert('删除失败');
                }
            },'json')
        }
    })
</script>
