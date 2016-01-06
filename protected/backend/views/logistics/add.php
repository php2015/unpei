<style>
    .color_red {color: red;}
    .wlxx_lm{ height:30px; line-height:30px; background:#EFF4FA; border-bottom:1px solid #C9D5E3}
    .ylr{ background:#eff4fa; margin:10px 0px 10px 90px; width:730px; padding:15px 10px 10px}
    .f_weight {font-weight: bold;}
    .jxs_area{ height:35px; line-height:36px; background:#f7f7f7; border:1px solid #ddd; margin:10px}
    .float_r {float: right;}
    .color_blue {color: blue;}
    .m_left20{ margin-left:20px}
    .txxx {border-bottom: 1px solid #c9d5e3;color:#0065bf;font-size:14px;font-weight:bold;height:35px;line-height:35px;text-indent:15px;}
    .m-top { margin-top: 10px;}
    .zdytext {background: none repeat scroll 0 0 #fff;border: 1px solid #dedede;width:748px;height: 70px;}
    .ylr_ul {min-height:30px;height:auto}
    .ylr_ul li {width:40%;float:left;margin-right:10px;}
    li{list-style: none outside none;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 物流管理';
$logid = Yii::app()->request->getParam('logid');
if ($logid) {
    $this->breadcrumbs = array(
        '物流管理' => Yii::app()->createUrl('logistics/index'),
        '修改物流配送'
    );
} else {
    $this->breadcrumbs = array(
        '物流管理' => Yii::app()->createUrl('logistics/index'),
        '添加物流配送'
    );
}
$this->menu = array(
    array('label' => '物流管理', 'icon' => 'cog', 'url' => array('index')),
);
if (!empty($datas['LogisticsDescription']))
    $clear = 0;
else {
    $clear = 1;
}
?>
<input type="hidden" id="logid" value="<?php echo $logid; ?>">
<div class="bor_back m-top" style="height:500px; position:relative">
    <p class="txxx">添加物流配送
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo Yii::app()->createUrl('logistics/index'); ?>" class="color_blue" style="font-weight:400">返回列表</a>
        </span>
    </p>

    <div  style="margin-left:2px">
        <div class="target_list">
            <p class="m-top m_left20"><span class="color_red">*</span><span>公司名称：</span>
                <input type="text" class="input input3  width200" maxlength="20" id="name" value="<?php echo $datas['LogisticsCompany']; ?>"></p>
            <p class="m-top m_left20"><span class="color_red">*</span><span>发货地址：</span>
                <?php
                $pdata = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
                $state = CHtml::listData($pdata, "ID", "Name");
                echo CHtml::dropDownList('Province', '', $state, array(
                    'class' => 'width118 select',
                    'empty' => '请选择省份',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/backend.php/admin/dynamiccities', //url to call
                        'data' => 'js:"province="+jQuery(this).val()',
                        'success' => 'function(data){
                             $("#City").html(data);
                             $("<option value=' . '' . '>全部</option>").prependTo("#City");
                             $("#City option:eq(0)").attr("selected","selected");
                             if($("#City").val()!="")
                             {
                                  $("#City").change();
                             }else{
                                 $("#Area").empty();
                                 $("<option value=' . '' . '>全部</option>").prependTo("#Area");
                            }
                        }'
                        )));

                echo CHtml::dropDownList('City', '', array(), array(
                    'class' => 'width118 select',
                    'empty' => '请选择城市',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/backend.php/admin/dynamicdistrict', //url to call
                        'data' => 'js:"city="+jQuery(this).val()',
                        'success' => 'function(data){
                             $("#Area").empty();
                             $("#Area").html(data);
                             $("<option value=' . '' . '>全部</option>").prependTo("#Area");
                             $("#Area option:eq(0)").attr("selected","selected");
                         }'
                        )));

                echo CHtml::dropDownList('Area', '', array(), array(
                    'class' => 'width118 select',
                    'empty' => '请选择地区',
                        )
                );
                ?>  
                <a href="javascript:;" class="add_wz alternative" id="add">添加</a></p>
            <div class="ylr">
                <b>已录入发货地</b>
                <ul class="ylr_ul" id="addul">
                    <?php if ($datas): ?>
                        <?php foreach ($datas['area'] as $v): ?>
                            <li a="<?php echo $v['a']; ?>" c="<?php echo $v['c']; ?>" p="<?php echo $v['p']; ?>">
                                <?php echo $v['address'] ?>
                                <a class="color_blue" style="float:right" href="javascript:void(0)" name="del">删除</a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <div style="clear:both;"></div>
            </div>
            <p><span class=" m_left40" style="vertical-align:top">备注：
                    <textarea class="textarea zdytext" id="desc" maxlength="255"><?php echo!empty($datas['LogisticsDescription']) ? $datas['LogisticsDescription'] : '可对运费进行补充，如：货运方式，到达天数等'; ?>
                    </textarea></span></p>
            <p class=" m_top20" align="center">
                <input type="submit" class="submit f_weight" value="保 存" id="save">
            </p>
        </div>

    </div>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '300px', //宽度  
        'height' => 'auto', //高度  
        'buttons' => array(
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
    $(function(){
        var clear='<?php echo $clear; ?>';
        //发货地址添加事件
        $('#add').click(function(){
            var p=$('#Province').val();
            var pstr=$('#Province option:selected').text();
            var c=$('#City').val();
            var cstr=$('#City option:selected').text();
            var a=$('#Area').val();
            var astr=$('#Area option:selected').text();
            var html;
            var li;
            var rli='<a name="del" class="color_blue" href="javascript:void(0)" style="float:right">删除</a></li>';
            var repeat=0;
            $('#addul').find('li').each(function(k,v){
                if(a==$(this).attr('a')){
                    repeat=1;
                    return false;
                }
                if((a==''||$(this).attr('a')==0)&&c==$(this).attr('c')){
                    repeat=1;
                    return false;
                }
                if((c==''||$(this).attr('c')==0)&&p==$(this).attr('p')){
                    repeat=1;
                    return false;
                }
            })
            if(repeat==1){
                alert('已添加');
                return false;
            }
            if(p==''&&$('#addul').find('li').length>0){
                alert('已添加');
                return false;
            }
            if(p==''){
                html='全国';
                li='<li p="0" c="0" a="0">';
            }else{
                html=pstr+' ';
                if(c==''){
                    li='<li p="'+p+'" c="0" a="0">';
                }else{
                    html+=cstr+' ';
                    if(a==''){
                        li='<li p="'+p+'" c="'+c+'" a="0">';
                    }else{
                        html+=astr;
                        li='<li p="'+p+'" c="'+c+'" a="'+a+'">';
                    }
                }
            }
            $('#addul').append(li+html+rli);
        })
        
        //备注事件
        $('#desc').focus(function(){
            if(clear==1&&$.trim($(this).val())=='可对运费进行补充，如：货运方式，到达天数等')
                $(this).val('');
        })
        
        $('#desc').blur(function(){
            if($(this).val()==''){
                $(this).val('可对运费进行补充，如：货运方式，到达天数等');
            };
        })
        
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
        
        //保存
        $('#save').click(function(){
            var data={};
            data.name=$('#name').val();
            data.desc=$('#desc').val();
            if(data.desc=='可对运费进行补充，如：货运方式，到达天数等')
                data.desc='';
            if(data.name==''){
                alert('请输入物流公司名称');
                return false;
            }
            if($('#addul').find('li').length==0){
                alert('最少要添加一个发货地址');
                return false;
            }
            var p='';
            var c='';
            var a='';
            $('#addul').find('li').each(function(k,v){
                p+=$(this).attr('p')+',';
                c+=$(this).attr('c')+',';
                a+=$(this).attr('a')+',';
            })
            var yiicsrf="<?php echo Yii::app()->request->csrfToken; ?>";
            data.p=p.substr(0,p.length-1);
            data.c=c.substr(0,c.length-1);
            data.a=a.substr(0,a.length-1);
            data.YII_CSRF_TOKEN=yiicsrf;
            var logid=$('#logid').val();
            if(logid)
                var url=Yii_baseUrl+'/backend.php/logistics/add/logid/'+logid;
            else
                var url=Yii_baseUrl+'/backend.php/logistics/add';
            $.post(url,data,function(res){
                if(res.res==1){
                    $("#reminddg").html('<span style="color:blue">物流配送添加成功!</span>');
                    $("#reminddg").dialog("open");
                    var url=Yii_baseUrl+'/backend.php/logistics/index'; 
                    setTimeout("window.location.href='"+url+"'",1000); 
                }else if(res.res==2){
                    alert('物流配送添加失败!'+res.msg);
                }else{
                    alert('物流配送添加失败!');
                }        
            },'json')
        })
        
    })
    
    //发货地址删除事件
    $(document).on("click","#addul [name=del]",function(){
        $(this).parent('li').remove();
    })
</script>
