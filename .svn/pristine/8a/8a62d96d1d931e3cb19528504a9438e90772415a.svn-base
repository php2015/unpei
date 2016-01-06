<table id="goods" style="height:510px"></table>
<div id="maketoolbar">
    <?php
    $organID = Commonmodel::getOrganID();
    $cate = MakeGoodsBrand::model()->findAll('OrganID=:organID and UserID=:userID', array(':organID' => $organID, 'userID' => $organID));
    $result = MakeGoodsCategory::model()->findAll('organID=:organID and userID=:userID', array(':organID' => $organID, ':userID' => $organID));
    ?>
    <!-- 搜索 -->
    <div style="padding-left:12px;" id="quo_search">
        <p class="form-row">
            &nbsp;&nbsp;商品编号: <input class="width98 input" name="goodsNO" id="goodsno">&nbsp;&nbsp;&nbsp;&nbsp;
            商品名称: <input class="width98 input" name="goodsName" id="goodsname">&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OE号:&nbsp;&nbsp;<input class="width98 input" name="OENO" id="oe">&nbsp;&nbsp;
        </p>
        <p class="form-row">
            &nbsp;&nbsp;<label>商品品牌:</label>
            <?php echo CHtml::dropDownlist('GoodsBrand', '', CHtml::listData($cate, 'BrandID', 'BrandName'), array('class' => 'width110 select', 'empty' => '请选择品牌', 'id' => 'goodsbrand'))
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<label>商品类别:</label>
            <?php echo CHtml::dropDownlist('GoodsCategory', '', CHtml::listData($result, "id", "name"), array('class' => 'width110 select', 'empty' => '请选择类别', 'id' => 'goodscategory'))
            ?>
            <!--            <label>&nbsp;&nbsp;时间段:</label>
                        <input class="easyui-datebox" type="text" style="width:88px" name="begintime" id="begintime">-<input class="easyui-datebox"  type="text" style="width:88px" name="endtime" id="endtime">&nbsp;-->
            &nbsp;&nbsp;&nbsp;&nbsp;<label>适用车型:&nbsp;&nbsp;</label><input class="width98 input" name="carmodel" id="carmodel">
        </p>
        <p class="form-row">
            <label>&nbsp;&nbsp;配件品类:</label>
            <?php
            
            $res = Commonmodel::Getcpnames();
            $params = array('class' => 'width230 select', 'id' => 'leafCategorysearch');
            if (!$res['cpnames']) {
                $params['empty'] = '请添加配件品类';
            }
            ?>
            <?php echo CHtml::dropDownlist('leafCategorysearch', $res['firstcpname'], $res['cpnames'], $params);
            ?> 
            <label style="margin-left:10px">&nbsp;&nbsp;上/下架: </label>
            <select name="IsSale" class="width100 select" id="issale">
                <option value="">全部</option>
                <option value="0">上架</option>
                <option value="1">下架</option>
            </select>
            &nbsp;&nbsp;<a id="search-btn" class="btn-green" href="javascript:void(0)">查询</a>
        </p>
        <?php echo $this->renderPartial('filter')?>
    </div>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="Add()">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="Edit()">修改</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="Delete()">删除</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="onsale()">上架</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="unsale()">下架</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="exportgoods()">导出</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="openimportgoods()">批量上传商品</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="uploadimg()">批量上传商品图片</a> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="goodsdetail()">详情</a>

 </div>
<script>
    //datagrid为空时显示 '暂无数据'
    var myview = $.extend({},$.fn.datagrid.defaults.view,{
        onAfterRender:function(target){
            $.fn.datagrid.defaults.view.onAfterRender.call(this,target);
            var opts = $(target).datagrid('options');
            var vc = $(target).datagrid('getPanel').children('div.datagrid-view');
            vc.children('div.datagrid-empty').remove();
            if (!$(target).datagrid('getRows').length){
                var d = $('<div class="datagrid-empty"></div>').html(opts.emptyMsg || 'no records').appendTo(vc);
                d.css({
                    position:'absolute',
                    left:0,
                    top:50,
                    width:'100%',
                    textAlign:'center'
                });
            }
        }
    });

    //商品信息列表搜索
    var expert;
    $('#search-btn').click(function(){
        $("#zxq_box").slideUp("slow");
        $('.zxq_btn-slide').removeClass("zxq_active");
        var goodsno=$('#goodsno').val();
        var goodsname=$('#goodsname').val();
        var oe=$('#oe').val();
        var issale=$('#issale').val();
        var goodscategory=$('#goodscategory').val();
        var goodsbrand=$('#goodsbrand').val();
        var standardid=$('#leafCategorysearch').val();
        var goodsvehicle=$('#carmodel').val();
        
        var expertparams='';
        var standparams='';
        var installparams='';
        //外、内模块
        if(expert==2)
        {
            var arr=new Array();
            //高级筛选
            $('#zxq_box').find('input[key="each"]').each(function(k,v){
                if($(this).val()=='')
                    return true;  //相当于continure;false时相当于break, 
                var val=$(this).val()?$(this).val():0;
                var range=$(this).parent('span').next('span').children('input').val();
                var name=$(this).prev('span').text();
                var min=parseFloat(val)-parseFloat(range);
                var max=parseFloat(val)+parseFloat(range);
                arr.push(name+','+min+','+max);
            })
            expertparams=arr.join('/');
            
            //规格
            var paramarr=new Array();
            if($('#standard').val())
            {
                var standard=$('#standard').val();
                var standardname=$('#standard').prev('span').text();
                paramarr.push(standardname+','+standard);
            }
            
            //安装方式
            if($('#set').val())
            {
                var set=$('#set').val();
                var setname=$('#set').prev('span').text();
                paramarr.push(setname+','+set);
               
            }
            
            //加水口位置
            if($('#addwap').val())
            {
                var addwap=$('#addwap').val();
                var addwapname=$('#addwap').prev('span').text();
                paramarr.push(addwapname+','+addwap);   
            }
            
            //加水口方向
            if($('#addwad').val())
            {
                var addwad=$('#addwad').val();
                var addwadname=$('#addwad').prev('span').text();
                paramarr.push(addwadname+','+addwad);   
            }
            
            //放水阀方向
            if($('#subwater').val())
            {
                var subwater=$('#subwater').val();
                var subwatername=$('#subwater').prev('span').text();
                paramarr.push(subwatername+','+subwater);   
            }
            
           //进、出水口
            var inlet=$('#inlet').val();
            if(inlet)
            {
                var inname=$('#inlet').prev('span').text();
                var insize=$('#insize').val()?$('#insize').val():0;
                if(!$.isNumeric(insize))
                    insize='';
                paramarr.push(inname+','+inlet+insize);
            }
            
            var outlet=$('#outlet').val();
            if(outlet)
            {
                var outname=$('#outlet').prev('span').text();
                var outsize=$('#outsize').val()?$('#outsize').val():0;
                if(!$.isNumeric(outsize))
                    outsize='';
                paramarr.push(outname+','+outlet+outsize);
            }
            standparams=paramarr.join('/');
        }
        var datas=getfield();
        var columns = new Array();
        var colData = new Object();
        $.getJSON(Yii_baseUrl+'/maker/makegoods/getstand',{'standID':$('#leafCategorysearch').val()},function(data){
            //动态生成表头开始
            if(data!= null){
                $.each(data,function(){
                    colData = new Object();
                    colData.field = this.id;
                    colData.title = this.name;
                    if(this.name.length>=4)
                    {
                        colData.width = 100; 
                    }    
                    else
                    {
                        colData.width = 50;
                    }
                    datas.columns.push(colData);
                });
            };
            columns.push(datas.columns);
            $('#goods').datagrid({
                frozenColumns:datas.frozencolumns,
                columns: columns,
                onLoadSuccess:loadsuccess,
                queryParams:{
                    'params[goodsno]':goodsno,
                    'params[goodsname]':goodsname,
                    'params[oe]':oe,
                    'params[issale]':issale,
                    'params[goodsbrand]':goodsbrand,
                    'params[goodscategory]':goodscategory,
                    'params[goodsvehicle]':goodsvehicle,
                    'params[standardid]':standardid,
                    'expertparams':expertparams,
                    'standparams':standparams,
                    'installparams':installparams 
                }
            })
            expert=1;
        })
    })

    // 导出商品
    function exportgoods()
    {
        var goodsno=$('#goodsno').val();
        var goodsname=$('#goodsname').val();
        var oe=$('#oe').val();
        var issale=$('#issale').val();
        var goodscategory=$('#goodscategory').val();
        var goodsbrand=$('#goodsbrand').val();
        //var maincategory=$('#mainCategorysearch').val();
        //var subcategory=$('#subCategorysearch').val();
        var standardid=$('#leafCategorysearch').val();
        //var begintime=$('#begintime').datebox('getValue');
        //var endtime=$('#endtime').datebox('getValue');
        var url_exportgoods= Yii_baseUrl +'/maker/makegoods/isdata';
        //      //window.open(url_exportgoods,"_self");
        $.ajax({
            url:url_exportgoods,
            type:'get',
            data:{
                'params[goodsno]':goodsno,
                'params[goodsname]':goodsname,
                'params[oe]':oe,
                'params[issale]':issale,
                'params[goodsbrand]':goodsbrand,
                'params[goodscategory]':goodscategory,
                //'params[maincategory]':maincategory,
                //'params[subcategory]':subcategory,
                'params[standardid]':standardid,
                //'params[begintime]':begintime,
                //'params[endtime]':endtime    
            },
            dataType:'json',
            success:function(data)
            {
                if(data.msg)
                {
                    $.messager.alert('提示信息',data.msg,'info');
                    return false;
                }
                else
                {
                    location.href= Yii_baseUrl +'/maker/makegoods/exportgoods'+
                        '?params[goodsno]='+goodsno+'&'+
                        'params[goodsname]='+goodsname+'&'+
                        'params[oe]='+oe+'&'+
                        'params[issale]='+issale+'&'+
                        'params[goodsbrand]='+goodsbrand+'&'+
                        'params[goodscategory]='+goodscategory+'&'+
                        //'params[maincategory]='+maincategory+'&'+
                        //'params[subcategory]='+subcategory+'&'+
                        'params[standardid]='+standardid
                        //'params[begintime]='+begintime+'&'+
                        //'params[endtime]='+endtime;
				
                }
            }
        });
    }
    
    $(function() {
        var datas=getfield();
        var columns = new Array();
        var colData = new Object();
        $.getJSON(Yii_baseUrl+'/maker/makegoods/getstand',{'standID':$('#leafCategorysearch').val()},function(data){
            //动态生成表头开始
            if(data!= null){
                $.each(data,function(){
                    colData = new Object();
                    colData.field = this.id;
                    colData.title = this.name;
                    if(this.name.length>=4)
                    {
                        colData.width = 100; 
                    }    
                    else
                    {
                        colData.width = 50;
                    }
                    datas.columns.push(colData);
                });
            };
            columns.push(datas.columns);
            //动态生成表头结束	
            var gridCfg = {
                method:'get',
                rownumbers:true,
                region:'center',
                fitColumns:false,
                pagination:true,
                singleSelect:false,
                url:Yii_baseUrl+'/maker/makegoods/list',
                toolbar:'#maketoolbar',
                frozenColumns:datas.frozencolumns,
                onLoadSuccess:loadsuccess,
                columns: columns,
                view: myview,
                emptyMsg: '暂无数据'
            };
            $('#goods').datagrid(gridCfg);
        });
    });
    
    function getfield()
    {
        var frozencolumns=[[
                {field:'ck',checkbox:true},
                {field:'goodsno',width:80,title:'商品编号'},
                {field:'goodsname',width:80,title:'商品名称'},
                {field:'brandname',width:80,title:'商品品牌'},
                {field:'category',width:80,title:'商品类别'},
                {field:'cp_name',width:80,title:'标准名称'}
            ]];
        var cols = new Array();
        var columns=[
            {field:'carmodel',width:80,title:'适用车型'},
            {field:'OE',width:80,title:'OE号'},
            {field:'benchmarking_brand',width:80,title:'标杆品牌'},
            {field:'benchmarking_sn',width:80,title:'标杆商品号'},
            {field:'inventory',width:50,title:'库存',formatter:function(value,row,index)
                {
                    if(value==1)
                        return '有';
                    else
                        return '无';
                }},
            {field:'senddays',width:80,title:'发货天数(天)'},
            {field:'description',width:100,title:'备注'},
            {field:'IsSale',width:50,title:'上/下架'},
            {field:'create_time',width:130,title:'添加日期'}
        ];
        var datas=new Object();
        datas.frozencolumns=frozencolumns;
        datas.columns=columns;
        return datas;    
    }
    
    //搜索栏配件品类改变事件
    $('#leafCategorysearch').change(function(){
         $('#search-btn').trigger('click');
         var standtext=$('#leafCategorysearch').find('option:selected').text();
            if(standtext=='冷热交换系统-冷却、空调及暖风系统-散热器')
            {
                $('#screen').show();
            }
            else
            {
                $('#screen').hide();
            }
    })
     
     
    //商品图片批量上传
    function uploadimg()
    {    check();
        $('#uploadimg').dialog('open').dialog('setTitle','商品图片批量上传');
    }
    function filter()
    {
		$('#filterdialog').dialog('open').dialog('setTitle','高级筛选');
    }
</script>

<script type="text/javascript">
$(document).ready(function(){

	$(".zxq_btn-slide").click(function(){
		$("#zxq_box").slideToggle("slow");
		$(this).toggleClass("zxq_active"); return false;
	});
	
	 
});
</script>
<script type="text/javascript">
$(function () {
            $("input[type=text]").click(function () {
                $(this).val('');
            })
        });

$.fn.iVaryVal=function(iSet,CallBack){
	/*
	 * Minus:点击元素--减小
	 * Add:点击元素--增加
	 * Input:表单元素
	 * Min:表单的最小值，非负整数
	 * Max:表单的最大值，正整数
	 */
	iSet=$.extend({Minus:$('.J_minus'),Add:$('.J_add'),Input:$('.J_input'),Min:-5,Max:5},iSet);
	var C=null,O=null;
	//插件返回值
	var $CB={};
	//增加
	iSet.Add.each(function(i){
		$(this).click(function(){
			O=parseInt(iSet.Input.eq(i).val());
			(O+1<=iSet.Max) || (iSet.Max==null) ? iSet.Input.eq(i).val(O+1) : iSet.Input.eq(i).val(iSet.Max);
			//输出当前改变后的值
			$CB.val=iSet.Input.eq(i).val();
			$CB.index=i;
			//回调函数
			if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
		});
	});
	//减少
	iSet.Minus.each(function(i){
		$(this).click(function(){
			O=parseInt(iSet.Input.eq(i).val());
			O-1<iSet.Min ? iSet.Input.eq(i).val(iSet.Min) : iSet.Input.eq(i).val(O-1);
			$CB.val=iSet.Input.eq(i).val();
			$CB.index=i;
			//回调函数
			if (typeof CallBack == 'function') {
				CallBack($CB.val,$CB.index);
		  	}
		});
	});
	//手动
	iSet.Input.bind({
		'click':function(){
			O=parseInt($(this).val());
			$(this).select();
		},
		'keyup':function(e){
			if($(this).val()!=''){
				C=parseInt($(this).val());
				//非负整数判断
				if(/^[1-9]\d*|0$/.test(C)){
					$(this).val(C);
					O=C;
				}else{
					$(this).val(0);
				}
			}
			//键盘控制：上右--加，下左--减
			if(e.keyCode==38 || e.keyCode==39){
				iSet.Add.eq(iSet.Input.index(this)).click();
			}
			if(e.keyCode==37 || e.keyCode==40){
				iSet.Minus.eq(iSet.Input.index(this)).click();
			}
			//输出当前改变后的值
			$CB.val=$(this).val();
			$CB.index=iSet.Input.index(this);
			//回调函数
			if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
		},
		'blur':function(){
			$(this).trigger('keyup');
			if($(this).val()==''){
				$(this).val(0);
			}
			//判断输入值是否超出最大最小值
			if(iSet.Max){
				if(O>iSet.Max){
					$(this).val(iSet.Max);
				}
			}
			if(O<iSet.Min){
				$(this).val(iSet.Min);
			}
			//输出当前改变后的值
			$CB.val=$(this).val();
			$CB.index=iSet.Input.index(this);
			//回调函数
			if (typeof CallBack == 'function') {
                CallBack($CB.val,$CB.index);
            }
		}
	});
}
//调用
$( function() {
	$('.i_box').iVaryVal({},function(value,index){
		/*$('.i_tips').html('你点击的表单索引是：'+index+'；改变后的表单值是：'+value);*/
	});
        var standtext=$('#leafCategorysearch').find('option:selected').text();
        if(standtext=='冷热交换系统-冷却、空调及暖风系统-散热器')
        {
            $('#screen').show();
        }
        else
        {
            $('#screen').hide();
        }
               
	
});

$('#filterbutton').click(function()
{
    expert=2;
    $('#search-btn').trigger('click');
})

$('#inlet').change(function(){
    var inval=$('#inlet').val();
    if(inval=='')
        $('#insize').val('输入数值');
})

$('#outlet').change(function(){
    var outval=$('#outlet').val();
    if(outval=='')
        $('#outsize').val('输入数值');
})

function loadsuccess()
{
    $('.pagination-page-list').change(function(){
            $('#goods').datagrid('unselectAll');
        })
}
</script>
