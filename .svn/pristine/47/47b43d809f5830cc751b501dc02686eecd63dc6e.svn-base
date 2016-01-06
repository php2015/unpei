<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/helpcategory.css">
<style>
    .hoverP:hover{text-decoration: underline}
</style>
<?php
//$resourceUrl = Yii::app()->theme->baseUrl;
//$cs->registerCssFile($resourceUrl.'/css/common.css');
?>

<div id="help_category" class="easyui-dialog" style="width:770px;height:620px;" modal="true" closed="true">  
    <div class="con" >
        <!--<div class="lm"><span class="lm_info">标准名称选择指引</span><span style="float:right; margin-top:7px; margin-right:10px"  onclick="closeDiv()"><img src="<?php echo F::themeUrl() ?>/images/guanbi.png"></span></div>-->
        <div class="con1">
            <div class="con1a">
                <span class="lm1">1、标准名称、关键字查找</span>
            </div>
            <input type="text" id="cpname_value" value="标准名称/拼音首字母"  class="text" onblur="if(this.value==''){this.value='标准名称/拼音首字母';}" onfocus="if(this.value=='标准名称/拼音首字母'){this.value='';}">
            <input type="button" value="查询" id="cpname_search" class="submit">
            <div class="cxjg" id="seach-cxjg">
                <span class="lm1a">大类》子类》标准名称</span>
<!--                    <p class="cxlb" key="前大照灯壳">车身及附件》外观件》前大照灯壳</p>
                <p class="cxjg2" key="火花塞">常用件》日常维护保养件》火花塞》</p>-->
            </div>
        </div> 
        <div class="con2">
            <div class="con1a">
                <span class="lm1">2、按汽车构造选择</span>
            </div>
            <div class="qcgz">
                <div class="qcgz1" id="qcgz">
                    <div class="select_b" id="select"><span class="select_xz" onclick="show9()" >车身及附件<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>
                    <div class="select_info" id="select_info" style="position: absolute;top: 25px;"><span><a href="javascript:void(0)">车身及连接件</a></span><span><a href="javascript:void(0)">外观件</a></span><span><a href="javascript:void(0)">车内件</a></span></div>
                </div>
                <div class="qcgz2" id="qcgz">
                    <div class="select_b" id="select2"><span class="select_xz" onclick="show2()" >冷热交换系统<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>
                    <div class="select_info" id="select_info2" style="position: absolute;top: 25px;"><span><a href="javascript:void(0)">冷却、空调及暖风系统</a></span><span><a href="javascript:void(0)">气温调节管理</a></span></div>
                </div>

                <div class="qcgz3" id="qcgz">
                    <div class="select_b" id="select3"><span class="select_xz" onclick="show3()">传动机驱动系统<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>
                    <div class="select_info" id="select_info3" style="position: absolute;top: 25px;"><span><a href="javascript:void(0)">传动系统</a></span><span><a href="javascript:void(0)">动力总成</a></span><span><a href="javascript:void(0)">车轮及附件</a></span></div>
                </div>
                <div class="qcgz4" id="qcgz">
                    <div class="select_b width150" id="select4"><span class="select_xz"  onclick="show4()" >制动、转向及悬挂系统<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>
                    <div class="select_info" id="select_info4" style="position: absolute;top: 25px;"><span><a href="javascript:void(0)">制动和牵引控制系统</a></span><span><a href="javascript:void(0)">悬挂和转向系统</a></span></div>
                </div>
                <div class="qcgz5" id="qcgz">
                    <div class="select_b width150" id="select5"><span class="select_xz  "onclick="show5()" >供油排气及排放系统<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>
                    <div class="select_info" id="select_info5" style="position: absolute;top: 25px;"><span><a href="javascript:void(0)">燃油供给系统</a></span><span><a href="javascript:void(0)">排气系统</a></span><span><a href="javascript:void(0)">排放控制</a></span></div>
                </div>


                <div class="qcgz6" id="qcgz">
                    <div class="select_info" id="select_info6"  style="position:absolute; top:-37px"><span><a href="javascript:void(0)">汽车电子电器</a></span><span><a href="javascript:void(0)">汽车照明</a></span><span><a href="javascript:void(0)">启动和充电</a></span></div>
                    <div class="select_b width150" id="select6"><span class="select_xz " onclick="show6()" >电子电器及线束<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>

                </div>
                <div class="qcgz7">
                    <div class="select_info" id="select_info7" style="position:absolute; top:-107px"><span><a href="javascript:void(0)">点火及点火调节系统</a></span><span><a href="javascript:void(0)">皮带和软管</a></span><span><a href="javascript:void(0)">发动机外置配件</a></span><span><a href="javascript:void(0)">发动机内置配件</a></span><span><a href="javascript:void(0)">发动机管理系统</a></span></div>
                    <div class="select_b width150" id="select7"><span class="select_xz " onclick="show7()">发动机及点火系统<img src="<?php echo F::themeUrl() ?>/images/tubiao.png"></span></div>

                </div>

            </div>

        </div> 
        <div class="con3">
            <div class="con1a">
                <span class="lm1">3、按配件使用频率选择</span>
            </div>
            <p id="freused"><a href="javascript:;;" class="freused">空气滤清器</a> 丨 <a href="javascript:;;" class="freused">机油滤清器</a> 丨 <a href="javascript:;;" class="freused">空调滤清器</a> 丨 <a href="javascript:;;" class="freused">燃油滤清器</a> 丨 <a href="javascript:;;" class="freused">正时皮带</a> 丨 <a href="javascript:;;" class="freused">蓄电池</a> 丨 <a href="javascript:;;" class="freused">制动片</a> 丨 <a href="javascript:;;" class="freused">雨刮片</a> 丨 <a href="javascript:;;" class="freused">火花塞</a></li></ul></p>

            <fieldset class="test"> 
                <legend>特殊子类说明</legend> 
                <ul> 
                    <li>(1) <span style="color:#40b240">车身及连接件：</span>车身及连接件：包含车身碰撞事故件、部分车身外观件及连接件。例如：保险杠、车灯总成等均在此子类中。</li> 
                    <li>(2) <span style="color:#40b240">气温调节管理：</span>主要包含了车内气温调节相关零部件。</li> 
                    <li>(3) <span style="color:#40b240">发动机管理系统：</span>主要包含了控制燃油供给量、点火提前角和怠速空气流量等在发动机运行中涉及的配件，例如：各类传感器。</li> 
                    <li>(4) <span style="color:#40b240">动力总成：</span>主要包含了车辆上产生动力，并将动力传递到路面的一系列零部件组件，一般仅指发动机，变速器，以及集成到变
                        速器上面的其余零件，例如：离合器。</li> 
                </ul> 
            </fieldset>
        </div> 
    </div>
</div>
<script type="text/javascript">
    function closeDiv(){
        document.getElementById('wra').style.display='none';
    }
    function show9(){
        document.getElementById('select_info').style.display='block';
        document.getElementById('select').setAttribute("class","x1");
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select2').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");

    }
    function show2(){
        document.getElementById('select_info2').style.display='block';
        document.getElementById('select2').setAttribute("class","x1");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");
    }
    function show3(){
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select3').setAttribute("class","x1");
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='block';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select2').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");
    }
    function show4(){
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select4').setAttribute("class","x1");
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='block';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select2').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");
    }
    function show5(){
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select5').setAttribute("class","x1");
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='block';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select2').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");
    }
    function show6(){
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select6').setAttribute("class","x3");
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='block';
        document.getElementById('select_info7').style.display='none';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select2').setAttribute("class","select_b");
        document.getElementById('select7').setAttribute("class","select_b");
    }
    function show7(){
        document.getElementById('select_info2').style.display='none';
        document.getElementById('select7').setAttribute("class","x3");
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select_info').style.display='none';
        document.getElementById('select_info3').style.display='none';
        document.getElementById('select_info4').style.display='none';
        document.getElementById('select_info5').style.display='none';
        document.getElementById('select_info6').style.display='none';
        document.getElementById('select_info7').style.display='block';
        document.getElementById('select').setAttribute("class","select_b");
        document.getElementById('select3').setAttribute("class","select_b");
        document.getElementById('select4').setAttribute("class","select_b");
        document.getElementById('select5').setAttribute("class","select_b");
        document.getElementById('select6').setAttribute("class","select_b");
        document.getElementById('select2').setAttribute("class","select_b");
    }
    
  
</script>



<script>
    $(function(){
        $("#helpcate").click(function(){
            cpname_search = false;
            $("#seach-cxjg").empty();
            $("#seach-cxjg").append('<span class="lm1a">大类》子类》标准名称</span>');
            $("#cpname_value").val('标准名称/拼音首字母');
            $("#help_category").parent('div').addClass('help_category');
            $("#help_category").dialog('open').dialog('setTitle','标准名称选择指引');
        });
        
        $("#freused a").dblclick(function(){
            // alert($(this).text());
           
            $("#cpname-select").val($(this).text());
            if(cpname_search){
                $("#cpname-search").val($(this).text());
            }
            // $("#wra").fadeOut(1000);
            $("#help_category").dialog('close')
        });
        $("#seach-cxjg p").live('dblclick',function(){
            $("#cpname-select").val($(this).attr('key'));
            if(cpname_search){
                $("#cpname-search").val($(this).attr('key'));
            }
            // $("#wra").fadeOut(1000);
            $("#help_category").dialog('close')
        });
//        $("#cpname_value").click(function(){
//            $(this).select();
//        }) 
        $("#cpname_search").live('click',function(){
            var cpname_v =   $("#cpname_value").val();
            if(!cpname_v ){
                $.messager.alert('提示信息',"请输入关键字!",'waraing');
                return false;
            }
            if(cpname_v == "标准名称/拼音首字母"){
                $.messager.alert('提示信息',"请输入关键字!",'waraing');
                return false;
            }
            //alert(cpname_v);
            var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
            var url = Yii_chenhgUrl + '/common/getleafcategorysofkey';
            $.getJSON(url,{cpname:cpname_v},function(result){
                $("#seach-cxjg").empty();
                var span =   '<span class="lm1a">大类》子类》标准名称</span>';
                $("#seach-cxjg").append(span);
                $.each(result,function(index,value){
                    if(value.subname){
                        if(value.bigname){
                        
                            var  p = "<a href='javascript:;;' class='hoverP'><p class='cxlb' style='cursor:pointer;' key="+value.cpname+">"+value.bigname+"》"+value.subname+"》"+value.cpname+"</p></a>";
                            $("#seach-cxjg").append(p);
                        }
                    }
                   
                   
                   
                })
            });
        })
        
    })
</script>