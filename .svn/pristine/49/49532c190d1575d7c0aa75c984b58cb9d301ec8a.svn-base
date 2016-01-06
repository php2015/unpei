<style>
    .cxjg2{
        width:840px; height:300px; border:1px solid #f0f0f0; margin:10px auto;overflow:auto;  padding-left: 10px;
    }
    .cxjg{
        width:840px; height:300px;  margin:10px auto;overflow:auto;  padding-left: 10px;
    }
    .cxjg2 a p:hover{
        color: #39ae39;
    }
</style>
<?php
$this->breadcrumbs = array(
    '商品管理' => Yii::app()->createUrl('common/goodslist'),
    '发布商品'
        )
?>
<div class=" bor_back m-top" style="height:600px">
    <p class="padding20"><b class="size14">为您的商品选择合适的类目</b></p>
    <!--选项卡-->
    <div id="tabbox">
        <ul class="tabs" id="tabs">
            <li><a href="javascript:;" tab="tab1">查找类目</a></li>
            <li><a href="javascript:;" tab="tab2">常使用的类目</a></li>
        </ul>

        <ul class="tab_conbox">
            <li id="tab1" class="tab_con">
                <p>
                    <input type="text"  id="cpname-search" name="cpname" class="input width250" value="请输入产品关键词">
                    <input type="submit" class="submit f_weight" id="cpnamesearch"  value="查找">
                    <a id="cpname_optional" style="cursor:pointer">自选</a>
                </p>
                <div id="seach-cxjg" class="cxjg">
                    <?php $this->renderPartial('cpname'); ?>
                </div>
                <div id="seach1-cxjg" class="cxjg">
                </div>
                <div id="cpname_div">你当前选中的类目是：<span id="bigname_span"></span><span id="subname_span"></span><span id="cpname_span"></span></div>
                <p align="center" class="m-top"><button class=" submit submit2" id="button1" style="background:gray" onclick="goesexit()"><a >下一步，填写详细信息</a></button><button class=" submit submit2" onclick="goesto()" id="button2"><a >下一步，填写详细信息</a></button><a id="button3" style="margin-left: 10px;cursor:pointer" onclick="goestoes()">跳过当前步骤</a></p>
            </li>
            <li id="tab2" class="tab_con">
            </li>
        </ul>
        <form id="fm" method="post" action="" novalidate style="">
            <input type="hidden" name="cpname" id="cpname_values"/>
            <input type="hidden" name="bigname" id="bigname_value"/>
            <input type="hidden" name="subname" id="subname_value"/>
            <input type="hidden" name="code" id="code_value"/>
            <input type="hidden" name="bignameid" id="bignameid_value"/>
            <input type="hidden" name="subnameid" id="subnameid_value"/>
        </form>
    </div>
</div>
<?php // $this->widget('widgets.default.WGoodsCategoryModel'); ?>
<!--content2结束-->
<!--商品管理页选项卡-->
<script type="text/javascript">
    $("#cpname-search").live('click', function() {
        if ($(this).val() == '请输入产品关键词') {
            $(this).val('');
        }
    })
    $("#cpname-search").blur(function() {
        if ($(this).val() == '') {
            $(this).val('请输入产品关键词')
        }
    })
    $("#p-leafcate .li_list").live('click', function() {

        var bigname = $("#ul-bigcate .selected2 a").html();
        $('#bigname_value').val(bigname);
        $('#bigname_span').html(bigname + '>>');
        var maketxt = $("#ul-subcate .selected2 a").html();
        $('#subname_value').val(maketxt);
        $('#subname_span').html(maketxt + '>>');
        var cpname = $(this).text();
        $('#cpname_values').val(cpname)
        $('#cpname_span').html(cpname);
        var bignameid = $("#ul-bigcate .selected2 a").attr('key');
        $('#bignameid_value').val(bignameid);
        var subnameid = $("#ul-subcate .selected2 a").attr('key');
        $('#subnameid_value').val(subnameid);
        var code = $(this).attr('code');
        $('#code_value').val(code);
        //        $('#cpname-search').val(cpname); 

        $("#cpname_div").show();
        $("#button1").hide();
        $("#button2").show();
        $("#button3").hide();
    });
    $("#ul-bigcate .li_list").live('click', function() {

        var bigname = $("#ul-bigcate .selected2 a").html();
        $('#bigname_value').val(bigname);
        $('#bigname_span').html(bigname + '>>');
        $('#subname_value').val('');
        $('#subname_span').html('');
        $('#cpname_values').val('');
        $('#cpname_span').html('');
        $("#cpname_div").show();
        $("#button1").show();
        $("#button2").hide();
        $("#button3").show();
    });
    $("#ul-subcate .li_list").live('click', function() {
        $("#select_Somname").show();
        $("#select_BiaoName").show();
        setTimeout(function() {
            var bigname = $("#ul-bigcate .selected2 a").html();
            $('#bigname_value').val(bigname);
            $('#bigname_span').html(bigname + '>>');
            var maketxt = $("#ul-subcate .selected2 a").html();
            $('#subname_value').val(maketxt);
            $('#subname_span').html(maketxt + '>>');
            $('#cpname_values').val('');
            $('#cpname_span').html('');
            $("#cpname_div").show();
            $("#button1").show();
            $("#button2").hide();
            $("#button3").show();
        }, 200);



    });


    function goesexit() {
        alert('请选择完整的标准名称');
    }
    $(document).ready(function() {
        //        $(document).click(function(e){
        //            //    alert(2)
        //            e.stopPropagation();
        //            //            $("#selectBig").hide();
        //        })
        $("#seach-cxjg").show();
        $("#seach1-cxjg").hide();
        $("#button1").show();
        $("#button2").hide();
        $("#button3").show();
        $("#selectBig").show();
        jQuery.jqtab = function(tabtit, tabcon) {
            $(tabcon).hide();
            $(tabtit + " li:first").addClass("thistab").show();
            $(tabcon + ":first").show();

            $(tabtit + " li").click(function() {
                $(tabtit + " li").removeClass("thistab");
                $(this).addClass("thistab");
                $(tabcon).hide();
                var activeTab = $(this).find("a").attr("tab");
                $("#" + activeTab).fadeIn();
                return false;
            });

        };
        /*调用方法如下：*/
        $.jqtab("#tabs", ".tab_con");


        //查询
        $("#cpnamesearch").live('click', function() {

            var cpname_v = $("#cpname-search").val();
            if (!cpname_v) {
                alert("请输入关键字!");
                return false;
            }
            var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
            var url = Yii_chenhgUrl + '/common/getleafcategorysofkey';
            $.getJSON(url, {cpname: cpname_v}, function(result) {
                $("#seach1-cxjg").show();
                $("#seach-cxjg").hide();
                $(".cxjg").removeClass('cxjg').addClass('cxjg2');
                $("#seach1-cxjg").empty();
                var span = '<span class="lm1a">大类》子类》标准名称</span>';
                $("#seach1-cxjg").append(span);
                $.each(result, function(index, value) {
                    if (value.subname) {
                        if (value.bigname) {
                            var p = "<a href='javascript:;;' class='hoverP'><p class='cxlb' style='cursor:pointer;' bignameid=" + value.bignameid + " subnameid=" + value.subnameid + " key1=" + value.bigname + " key2=" + value.subname + " code=" + value.code + " key3=" + value.cpname + ">" + value.bigname + "》" + value.subname + "》" + value.cpname + "</p></a>";
                            $("#seach1-cxjg").append(p);
                        }
                    }



                })
            });
        })
        //点击
        $("#seach1-cxjg .hoverP p").live('click', function() {
            //            $("#cpname-search").val($(this).attr('key3'));
            $("#bignameid_value").val($(this).attr('bignameid'));
            $("#subnameid_value").val($(this).attr('subnameid'));
            $("#code_value").val($(this).attr('code'));
            $("#cpname_values").val($(this).attr('key3'));
            $("#bigname_value").val($(this).attr('key1'));
            $("#subname_value").val($(this).attr('key2'));
            $("#cpname_span").html($(this).attr('key3'));
            $("#bigname_span").html($(this).attr('key1') + '>>');
            $("#subname_span").html($(this).attr('key2') + '>>');
            $("#cpname_div").show();
            $("#button1").hide();
            $("#button2").show();
            $("#button3").hide();
        });


    });


    // 点击输入框弹出div层
    $("#cpname_optional").click(function(e) {
        $("#seach-cxjg").show();
        $("#seach1-cxjg").hide();
        $(".cxjg2").removeClass('cxjg2').addClass('cxjg');
        cpname_search = true;
        e.stopPropagation();
        //alert(1234);
        cpnametxt = '';
        //        $("#cpname-search").val(cpnametxt);
        $("#selectBig").show();
        $("#make-car-m").hide();
    });

    //提交
    function goesto() {
        var make = <?php
if ($make[0]['MakeID'])
    echo 1;
else
    echo 0;
?>;
        if (make == 0) {
            alert('您还没有添加主营车系或数据存在问题，请联系客服');
            return false;
        }
        $("#fm").attr("action", Yii_baseUrl + "/pap/dealergoods/addinfo2");
        $("#fm").submit();
    }
    //跳过当前步骤
    function goestoes() {
        var make = <?php
if ($make[0]['MakeID'])
    echo 1;
else
    echo 0;
?>;
        if (make == 0) {
            alert('您还没有添加主营车系或数据存在问题，请联系客服');
            return false;
        }
        $("#cpname_values").val('');
        $("#bigname_value").val('');
        $("#subname_value").val('');
        $("#fm").attr("action", Yii_baseUrl + "/pap/dealergoods/addinfo2");
        $("#fm").submit();
    }
</script>