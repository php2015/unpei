<style>
    #vivle{
        margin-top: 10px;
        margin-left: 92px
    }
    #dealerlist{
        margin-top: 10px 
    }

    a.s,a.a{
        background: url("<?php echo F::themeUrl() . '/images/num-control.png' ?>");
        display: inline-block;
        float: left;
        height: 22px;
        margin-left: 4px;
        width: 22px;
    }
    a.a{ background-position:center right; }

    .txxx {
        border-bottom: 1px solid #c9d5e3;
        color: #0065bf;
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
    }
    .btn_addPic {
        background: url('<?php echo F::themeUrl() . '/images/sc.png' ?>') repeat scroll 0 0 rgba(0, 0, 0, 0);
        cursor: pointer;
        display: inline-block;
        height: 80px;
        overflow: hidden;
        position: relative;
        width: 80px;
    }
    .filePrew {
        cursor: pointer;
        display: block;
        height: 80px;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 80px;
    }
    a.jiahao {
        background: none repeat scroll 0 0 #0164c2;
        color: #fff;
        font-weight: bold;
        padding: 2px 5px;
    }
    a.jianhao {
        background: none repeat scroll 0 0 #ff5400;
    }
    #epc_make{background:#FFFFFF}
    #epc_series{background:#FFFFFF}
    #epc_year{background:#FFFFFF}
    #epc_model{background:#FFFFFF}
    table{ border:0px; margin:0px; border-collapse:separate; }
    .grid-view table tbody td{ padding:3px}
</style>
<script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/jpd/jquery.form.js"></script>
<?php
Yii::app()->getClientScript()->registerScript('editorparam', 'window.KEDITOR_PARAM = "action=' . $action . '&id=' . $id . '"', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('search', '
$("#next").click(function(){
var tobody=$("#vivle").find("tbody tr").text();
var iframe_body=$(".ke-edit-iframe").contents().find("body").html();
if(iframe_body !="<br>"){
$("textarea[name=\'Describe\']").val(iframe_body)
}
if(!$("textarea[name=\'Describe\']").val() && !tobody){
var img =$("input[name=\'inquiryImages[]\']").val();
if(img){
}else{
alert("请添加描述或选择配件信息")
    return false;
}
}
 $("#return_index").hide()
 $("#return_next").show()
     var epc_make=$("#epc_make").find("option:selected").text()
    var epc_series=$("#epc_series").find("option:selected").text()
    var epc_year=$("#epc_year").find("option:selected").text()
    var epc_model=$("#epc_model").find("option:selected").text()
    $.fn.yiiGridView.update(
        "dealerlist",
        {
            data:{
                 epc_make:epc_make,
                 epc_series:epc_series,
                 epc_year:epc_year,
                 epc_model:epc_model
            }
        }
    )
     setTimeout("selectfirst()",500);
});   

$("#selectdealers").keyup(function(){
var kword=$("#selectdealers").val();
 $.fn.yiiGridView.update(
        "dealerlist",
        {
            data:{
                 kword:kword
            }
        }
    )
     selectfirst()
});

');
?>
<?php
$this->pageTitle = Yii::app()->name . '-' . '修改询价单';
$this->breadcrumbs = array(
    '询报价管理' => Yii::app()->createUrl('common/inquerylist'),
    '修改询价单'
);
?>
<div class="bor_back  m-top" style="border:1px solid #cccccc">

    <div class="add_xjd">
        <p class="txxx">发布询价单<span class="float_r" style="*margin-top:-35px;margin-right:20px ;">
                <a href="<?php echo Yii::app()->createUrl('/pap/inquiryorder/index'); ?>" class="color_blue" style="font-weight:400" id='return_index'>返回</a>
                <a  style='display:none;cursor:pointer'  class="color_blue" style="font-weight:400" onclick=' $("#inputform").show();
                        $("#nextcheck").hide();
                        $("#return_index").css("display", "block");
                        $("#return_next").css("display", "none");' id='return_next'>返回上一步</a>
            </span>
        <div>
            <div class="txxx_info cxdw_info" id="inputform">
                <form  id="inquiryform"  onkeypress="if (event.keyCode == 13 || event.which == 13) {
                            return false;
                        }" method="post" style="margin-left:20px">
                    <input type="hidden" name="Type">
                    <input type="hidden" name="DealerID">
                    <input type="hidden" name="inquiryID" value="<?php echo $inquiryID; ?>">
                    <div style="display:none" id="appendhtmls"></div>
                    <p id="VINmdw_info" style="margin-top:10px"> <span class="" style="margin-left: 18px">VIN码：</span>
                        <input type="text" name="VIN" class=" input input3 width263  " value="请输入VIN码" onfocus="if (value == '请输入VIN码') {
                                    value = ''
                                }" onblur="if (value == '') {
                                            value = '请输入VIN码'
                                        }"> </p>
                    <p id="cxdw_info" style="margin-top:10px"> <span>选择车型：</span>
                        <?php
                        $this->widget('widgets.default.WGoodsModel', array(
                            'scope' => 'epc',
                            'notlink' => 'N',
                            'link' => 'Y',
                            'make' => $inquiryinfo[0]['Make'],
                            'series' => $inquiryinfo[0]['Car'],
                            'year' => $inquiryinfo[0]['Year'],
                            'model' => $inquiryinfo[0]['Model']));
                        ?>
                        <span style="color:red;display: none" id="changjia_notice">*</span>
                    </p>
                    <div class="txxx_info2 m-top">
                        <span class="float_l ">采购描述：</span>
                        <div class="float_l  m_left12 " style="width:700px; height:300px; border:1px solid #f0f0f0;margin-left: 10px" >  
                            <textarea id="CmsArticle_Content" name="Describe" style="width:700px; height:300px;"></textarea>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="m-top">
                        <span style="vertical-align:top;">　　附件：</span>
                        <a href="javascript:void(0);" class="btn_addPic" style="margin-left:5px;*margin-top:-5px*margin-top:5px"><span id="img_id_one"></span><input type="file" name="upload_file[]" class="filePrew" id="upload_file_one"></a>
                        <a href="javascript:void(0);" class="btn_addPic" style="*margin-top:-5px"><span id="img_id_two"></span><input type="file" name="upload_file[]" class="filePrew" id="upload_file_two"></a>
                        <a href="javascript:void(0);" class="btn_addPic" style="*margin-top:-5px"><span id="img_id_three"></span><input type="file" name="upload_file[]" class="filePrew" id="upload_file_three"></a>
                        <a href="javascript:void(0);" class="btn_addPic" style="*margin-top:-5px"><span id="img_id_four"></span><input type="file" name="upload_file[]" class="filePrew" id="upload_file_four"></a>
                        <a href="javascript:void(0);" class="btn_addPic" style="*margin-top:-5px"><span id="img_id_five"></span><input type="file" name="upload_file[]" class="filePrew" id="upload_file_five"></a><span style="color:#fb540e">(提示：删除图片双击即可)</span>
                    </div>
                </form>
                <p style="margin-top: 10px;margin-left: 20px" > 
                    <span style="vertical-align:top;">配件品类：</span>
                    <span>
                        <input id="cpname-select" name="cpname" class=" input width260" type="text" value="<?php echo $search['cpname'] ?>" style="width:260px;">
                        <input type="hidden" value="<?php echo $jpmall_maincate ?>" name="jpmall_maincate"  id="jpmall_maincate"/>
                        <input type="hidden" value="<?php echo $jpmall_subcate ?>" name="jpmall_subcate" id="jpmall_subcate"/>
                        <input type="hidden" value="<?php echo $jpmall_cpname ?>" name="jpmall_cpname" id="jpmall_cpname"/>
                        <input type="hidden" value="<?php echo $jpmall_code ?>" name="jpmall_code" id="jpmall_code"/>
                        <input id="mainCategory" name="maincategory" type="hidden" value="<?php echo $search['maincategory']; ?>">
                        <input id="subCategory" name="subcategory" type="hidden" value="<?php echo $search['subcategory']; ?>">
                        <input id="leafCategory" name="cpnamecategory" type="hidden" value="<?php echo $search['category']; ?>">
                    </span>
                    <span class="add m_left"><a class="jiahao">+</a></span>&nbsp;<a href="javascript:;" class="add_wz" onclick="addCategory()" style="color:#0164c2">添加</a>
                    <span class="del m_left"><a class=" jiahao jianhao">-</a></span>&nbsp;<a href="javascript:;" class="del_wz" id="removelist" style="color:#ff5400">移除</a></p>
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $lists,
                    'id' => 'vivle',
                    'columns' => array(
                        array(
                            'name' => ''
                        ),
                        array(
                            'name' => '大类'
                        ),
                        array(
                            'name' => '子类'
                        ),
                        array(
                            'name' => '标准名称'
                        ),
                        array(
                            'name' => '数量(最多100件)',
                            'headerHtmlOptions' => array('width' => '170px')
                        ),
                    )
                ))
                ?>
                <p class=" m_top20 m_left65" style="margin-left: 30%;margin-bottom:30px"><input type="button" class="submit f_weight" value="下一步"  id="next"></p>

            </div>

            <div class="txxx_info cxdw_info"  id="nextcheck" style="margin-top: 20px;display: none">
                <p style="margin: 10px 0 0 20px"> <span>经销商：</span>
                    <input type="text"  class=" input input3 width263"   id="selectdealers" value="请输入经销商名称"  onfocus="if (value == '请输入经销商名称') {
                                value = ''
                            }" onblur="if (value == '') {
                                        value = '请输入经销商名称'
                                    }" > </p>
                    <?php
                    $this->widget('widgets.default.WGridView', array(
                        'id' => 'dealerlist',
                        'dataProvider' => $data,
                        'ajaxUpdate' => true,
                        'columns' => array(
                            array(
                                'class' => 'CCheckBoxColumn',
                                'headerHtmlOptions' => array('width' => '33px'),
                                'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
                                'selectableRows' => '1',
                                value => '$data[ID]'
                            ),
                            array(
                                'name' => 'OrganName',
                                'header' => '经销商名称',
                                value => '$data[OrganName]'
                            ),
                            array(
                                'name' => '主营车系',
                                'type' => 'raw',
                                value => 'RPCClient::call("InquiryorderService_getdealermainchexi", $data[ID])'
                            ),
                            array(
                                'name' => 'Phone',
                                'header' => '联系方式',
                                'headerHtmlOptions' => array('width' => '150px'),
                                value => '$data[Phone]'
                            ),
                            array(
                                'name' => 'Address',
                                'header' => '地址',
                                'headerHtmlOptions' => array('width' => '200px'),
                                value => 'InquiryorderService::showaddress(array("State"=>"$data[Province]","City"=>"$data[City]","District"=>"$data[Area]"))'
                            ),
                        )
                    ));
                    ?>
                <p class=" m_top20 m_left65" style="margin-left: 30%;margin-bottom:30px"><input type="button" class="submit f_weight" value="确认发送" onclick="sendinquiry()" id="sendinquiry"><button class=" button4 button3" onclick="window.location.href = ''">取消</button></p>


            </div>

        </div>
    </div>

</div>
<?php include_once 'goodsMainCategoryModel.php'; ?>

<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?ver=<?php echo rand(0, 9999); ?>'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.css">
<?php include_once 'uploadimagejs.php'; ?>
<?php
$this->widget('ext.kindeditor.KindEditorWidget', array(
    'id' => 'CmsArticle_Content' //Textarea id
));
?>
<script type="text/javascript">
                    var editor;
                    KindEditor.ready(function(K) {
                        editor = K.create('#CmsArticle_Content', {
                            resizeType: 2,
                            allowPreviewEmoticons: false,
                            allowImageUpload: false,
                            items: [
                                'fontname', 'fontsize', '|', 'bold', 'italic', 'underline',
                                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                                'insertunorderedlist']
                        });
                        var desc = '<?php echo $inquiryinfo[0]['Describe'] ?>';
                        editor.html(desc);
                    });
                    $(document).ready(function() {
                        $(".ke-edit-iframe").css('background', '#FFFFFF');
                        if (!$(".ke-edit-iframe").contents().find("body").html()) {
                            $(".ke-edit-iframe").contents().find("body").html('<?php echo $inquiryinfo[0]['Describe'] ?>');
                        }
                        $("#nextcheck").hide();
                        $("#vivle").find('tbody tr').remove();
                        $('input[name=Type]').val(1);
                        var vin = '<?php echo $inquiryinfo[0]['VIN'] ?>';
                        $("input[name=VIN]").val(vin);
                        //追加大类子类
                        var cates = '<?php echo $category ?>';
                        if (cates) {
                            cates = eval('(' + cates + ')');
                            $.each(cates, function(key, val) {
                                var MainCategory = val.MainCategory;
                                var SubCategory = val.SubCategory;
                                var LeafCategory = val.LeafCategory;
                                var jpmall_cpname = val.cpid;
                                var number = val.Number;
                                var jpmall_code = val.StandCode;
                                var html = appendhtml(MainCategory, SubCategory, LeafCategory, jpmall_cpname, jpmall_code, number);
                                if (!$("#" + jpmall_cpname).val()) {
                                    $("#vivle").find('tbody').append(html);
                                }
                            });
                        }
                        //追加图片
                        var imges = '<?php echo $imges ?>';
                        if (imges) {
                            imges = eval('(' + imges + ')');
                            $.each(imges, function(key, val) {
                                var uplodurl = '<?php echo Yii::app()->params['ftpserver']['visiturl'] ?>';
                                var filefacturl = uplodurl + val.PicPath;
                                var lms_fact;
                                if (key == 0) {
                                    lms_fact = 'one';
                                }
                                if (key == 1) {
                                    lms_fact = 'two';
                                }
                                if (key == 2) {
                                    lms_fact = 'three';
                                }
                                if (key == 3) {
                                    lms_fact = 'four';
                                }
                                if (key == 4) {
                                    lms_fact = 'five';
                                }
                                var span = "<img style='width:80px;height:80px;border:none' src=" + filefacturl + " key=" + val.PicPath + " app=" + lms_fact + " ondblclick='deleteimg(this)'>" +
                                        "<input type='hidden' name='inquiryImages[]' value=" + val.PicPath + ">" +
                                        "<input type='hidden' name='inquiryImagesname[]' value=" + val.PicName + ">";
                                $("#img_id_" + lms_fact).html(span);
                            });
                        }

                    });
                    function optionchexi() {
                        $("#VINmdw_info").hide();
                        $("#cxdw_info").show();
                        $('input[name=Type]').val(1);
                    }
                    function optionvin() {
                        $("#cxdw_info").hide();
                        $("#VINmdw_info").show();
                        $('input[name=Type]').val(3);
                        if ($("#epc_make").val()) {
                            $("#epc_make").val('').change();
                        }
                    }
                    //确认发送，提交数据
                    var _submit = false;
                    function sendinquiry() {
                        if (_submit) {
                            return false;
                        }
                        $("#appendhtmls").empty();
                        var parts;
                        $("#vivle").find('tbody tr ').each(function(row, val) {
                            var mainCategory;
                            var subCategory;
                            var jpmall_cpname;
                            var number;
                            var code;
                            $(this).find('td').each(function(row) {
                                if (row == 0) {
                                    code = $(this).find('input').attr('code')
                                }
                                if (row == 1) {
                                    mainCategory = $(this).text()
                                }
                                if (row == 2) {
                                    subCategory = $(this).text()
                                }
                                if (row == 3) {
                                    jpmall_cpname = $(this).text()
                                }
                                if (row == 4) {
                                    number = $(this).find('input[name="abc"]').val();
                                }

                            });
                            var value = mainCategory + ',' + subCategory + ',' + jpmall_cpname + ',' + number + ',' + code;
                            var html = '<input type="hidden" name="parts[]" value="' + value + '">';
                            $("#appendhtmls").append(html);
                        });
                        var DealerID = '';
                        var dealersnum = 0;
                        $("#dealerlist").find('input[name="selectdel[]"]:checked').each(function(val, row) {
                            if (!DealerID) {
                                DealerID += ',' + $(this).val() + ',';
                            } else {
                                DealerID += $(this).val() + ',';

                            }
                            dealersnum += 1;
                        });
                        if (dealersnum > 1) {
                            alert('只能发送一个经销商')
                            return false;
                        }
                        if (!DealerID) {
                            alert('请选择发送对象')
                            return false;
                        } else {
                            $('input[name=DealerID]').val(DealerID);
                        }
                        _submit = true;
                        $("#inquiryform").form({
                            url: '<?php echo Yii::app()->createUrl('pap/inquiryorder/updateinquiry') ?>',
                            success: function(lms) {
                                _submit = false;
                                var message = eval('(' + lms + ')');
                                alert(message.message);
                                if (message.success > 0) {
                                    window.location.href = '<?php echo Yii::app()->createUrl('pap/inquiryorder/index') ?>';
                                } else {
                                    window.location.href = '';
                                }
                            }
                        });
                        $("#inquiryform").submit();
                    }
                    function addCategory() {
                        var ifexit = $("#jpmall_cpname").val();
                        ;
                        var MainCategory = $("#mainCategory").val();
                        var SubCategory = $("#subCategory").val();
                        var LeafCategory = $("#leafCategory").val();
                        var jpmall_cpname = $("#jpmall_cpname").val();
                        var jpmall_code = $("#jpmall_code").val();
                        if (!LeafCategory) {
                            alert('请选择配件品类');
                            return false;
                        }
                        if ($("#" + jpmall_cpname).val()) {
                            alert('该配件品类已添加');
                            return false;
                        }
                        var html;
                        html = appendhtml(MainCategory, SubCategory, LeafCategory, jpmall_cpname, jpmall_code, 1);
                        if (!$("#" + jpmall_cpname).val()) {
                            $("#vivle").find('tbody').append(html);
                        }

                    }
                    function appendhtml(MainCategory, SubCategory, LeafCategory, jpmall_cpname, jpmall_code, number) {
                        var index = 0;
                        $("#vivle").find('tbody tr').each(function() {
                            if ($(this).text()) {
                                if (index == 0) {
                                    index = 1;
                                } else {
                                    index = 0;
                                }
                            }
                        });
                        var rownum = index == 0 ? 'odd' : 'even';
                        var tmpl = '';
                        searchID = "search" + jpmall_cpname;
                        tmpl += '<tr class="' + rownum + '" id="deltr' + jpmall_cpname + '"><td><input type="checkbox" name="checkbox[]" checkboxid="' + jpmall_cpname + '" code="' + jpmall_code + '"></td>';
                        tmpl += '<td>' + MainCategory + '</td>';
                        tmpl += '<td>' + SubCategory + '</td>';
                        tmpl += '<td>' + LeafCategory + '</td>';
                        tmpl += '<td ><center><div style ="width:150px"><a href="javascript:void(0);" onclick="numdel(' + jpmall_cpname + ')" class="s"></a><input type="text" id="' + jpmall_cpname + '" class="input input5 float_l" style ="width:40px;height:20px;text-align:center" value=' + number + ' onblur="checknum($(this).val(),' + jpmall_cpname + ')" name="abc"><a href="javascript:void(0);" class="a" onclick="numadd(' + jpmall_cpname + ')"></a></div></center></td></tr>';
                        return tmpl;
                    }
                    //点击减一
                    function numdel(ID) {
                        var num = $("#" + ID).val();
                        num = parseInt(num) - 1;
                        if (num > 0) {
                            $("#" + ID).val(num);
                        } else {
                            $("#" + ID).val(1);
                        }
                    }
                    //点击加一
                    function numadd(ID) {
                        var num = $("#" + ID).val();
                        num = parseInt(num) + 1;
                        if (num > 100) {
                            $("#" + ID).val(100);
                        } else {
                            $("#" + ID).val(num);
                        }
                    }
                    function checknum(val, ID) {
                        var mkk = isNaN(val);
                        if (mkk == true) {
                            $("#" + ID).val(1);
                            return false;
                        }
                        if (val < 1) {
                            $("#" + ID).val(1);
                        }
                        if (val > 100) {
                            $("#" + ID).val(100);
                        }
                    }
                    $("#removelist").click(function() {
                        var delnum = 0;
                        $("#vivle").find('input[name="checkbox[]"]:checked').each(function() {
                            var checkboxid = $(this).attr("checkboxid");
                            delnum += 1;
                            $("#deltr" + checkboxid).remove();
                        });
                        if (delnum == 0) {
                            alert('请选择要移除的配件');
                        }
                    });
                    //删除图片
                    function deleteimg(obj) {
                        var path = $(obj).attr('key');
                        var url = Yii_baseUrl + '/upload/ftpdelfile';
                        $.post(url, {'path': path}, function(res) {
                            if (res.res == 1) {
                                var apps = $(obj).attr('app');
                                var inputid = 'upload_file_' + apps;
                                var imgid = 'img_id_' + apps;
                                $("#" + inputid).show();
                                $("#" + imgid).html('');
                            } else {
                                alert('删除失败');
                            }
                        }, 'json');
                    }

                    //默认选中第一个
                    function selectfirst() {
                        setTimeout('selectone()', 1000);
                    }
                    function selectone() {
                        $("#inputform").hide();
                        $("#nextcheck").show();
                        $("#dealerlist_c0_0").attr("checked", true);
                    }

</script>