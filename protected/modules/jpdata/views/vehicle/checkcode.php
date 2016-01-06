<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'checkcode', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '验证码',
        'autoOpen' => false, //是否自动打开  
        'width' => '400px',
        'height' => '200px',
        'modal' => true,
        'resizable' => false,
        'height' => 'auto', //高度  
        'buttons' => array(
            '确认' => 'js:function(){ code();}', //关闭按钮 
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
        ),
    ),
));
?>
验证码:
<input class="width148 input" type="text" style="margin-bottom: 5px; width: 148px;" value="" name="code">  
<?php
$this->widget('CCaptcha', array('showRefreshButton' => true,
    'clickableImage' => true,
    'buttonType' => 'link',
    'buttonLabel' => '换一张',
    'imageOptions' => array('alt' => '点击换图', 'align' => 'absmiddle')));
echo '<div id="codewarning" style="color:red;padding-left:100px;display: none">验证码错误,请重新输入</div>';
echo '<input type="hidden" id="checktype">';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
    function code() {
        var code = $('#checkcode').find('[name="code"]').val();
        var type = $('#checktype').val();
        if (code == '') {
            alert('请输入验证码!');
            return;
        }
        var url = Yii_jpdata_baseUrl + "/vehicle/checkcode";
        $.getJSON(url, {'code': code}, function(res) {
            if (res.success == 1) {
                $.messager.lays(300, 150);
                $.messager.anim('fade', 1000);
                $.messager.show("操作提示", "验证成功", 3000);
                $('#checkcode').dialog('close');
                if (type == 1)
                    updateseries();
                else if (type == 2)
                    updateyear();
                else if (type == 3)
                    updatemodel();
                else if (type == 4)
                    updatemodelinfo();

            }
            else {
                $('#codewarning').show();
                $('#checkcode').find('[name="code"]').val('');
                $('#checkcode').find('a').trigger('click');  //更换验证码
            }
        })
    }

    //更新车系
    function updateseries() {
        var makeId = $("#ul-makes .selected3 a").attr('key');
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsSeries', {make: makeId}, function(result) {
            $('.car_list').show();
            if ($("#make-select").attr('key') == 'null_series' || $("#make-select-index").attr('key') == 'null_series') {
                $("#series_first").hide();
            }
            $.each(result, function(index, value) {
                $("#ul-series").append('<li class="li_list"><div  class="series_title"><a key=' + value.seriesId + ' href="javascript:void(0)" title=' + value.name + ' >' + value.name + '</a></div></li>');
            })
            if ($("#ul-series  li:first").length > 0)
                sericesarget = true;
            if (global_vehicle.series == '')
                $("#ul-series  li:eq(0)").click();
            else {
                $("#ul-series .li_list").find('a[key="' + global_vehicle.series + '"]').focus().click();
                global_vehicle.series = '';
            }
        })
    }

    //更新年款
    function updateyear() {
        var seriesId = $("#ul-series .selected3 a").attr('key');
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: seriesId}, function(result) {
            $('.model_list').show();
            $.each(result, function(index, year) {
                if (index != 0) {
                    if (year.year) {
                        var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + year.year + ' seriesId=' + result[0] + '>' + year.year + '</a></li>';
                    } else {
                        var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + 0 + ' >' + year.year + '</a></li>';
                    }
                    $("#ul-year").append(li);
                    yeartarget = true;
                }
            })
            if (global_vehicle.year == '')
                $("#ul-year .li_list:eq(0)").click();
            else {
                $("#ul-year .li_list").find('a[key="' + global_vehicle.year + '"]').focus().click();
                global_vehicle.year = '';
            }
        })
    }

    //更新车型
    function updatemodel() {
        var seriesId = $("#ul-year .selected3 a").attr('seriesid');
        var year = $("#ul-year .selected3 a").attr('key');
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: seriesId, year: year}, function(result) {
            $('.model_list').show();
            //$("#ul-model").empty();
            $.each(result, function(k, v) {
                $("#ul-model").append('<li class="li_list"><a  key=' + this.modelId + ' href="javascript:void(0)">' + this.name + '</a></li>');
            })
            if (global_vehicle.model != '') {
                $("#ul-model .li_list").find('a[key="' + global_vehicle.model + '"]').focus().click();
                global_vehicle.model = '';
            }

        })

    }

    //更新配件信息
    function updatemodelinfo() {
        var modelId = $("#ul-model .selected3 a").attr('key');
        $.ajax({
            url: Yii_jpdata_baseUrl + "/vehicle/frontModelInfo",
            type: "POST",
            data: {
                'modelId': modelId
            },
            dataType: "html",
            success: function(html) {
                $('.zoomContainer').remove();
                $(".code-content").html(html);
                $(".result-title ").show();
                get_height_align('.sidebar', '.content');
            }
        });
    }

</script>