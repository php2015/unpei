<?php
Yii::app()->clientScript->registerScript('search', '
$("#addresssearch").click(function(){
    $.fn.yiiGridView.update(
        "address",
        {
            url:window.location.href
        }
    )
});        
');
?>
<div style="display:none">
    <?php
//添加收货地址
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'myaddress',
        'options' => array(
            'title' => '添加收货地址',
            'width' => 500,
            'height' => 260,
            'autoOpen' => false,
            'resizable' => false,
            'modal' => true,
            'overlay' => array(
                'backgroundColor' => '#000',
                'opacity' => '0.5'
            ),
        ),
    ));
    echo $this->renderPartial('/inquiryorder/addressdetail', array('model' => $model));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<div id="addresssearch"></div>
<script>
    //添加收货地址
    function newaddress()
    {
        $('#adresssumit').val('创建');
        $('#JpdReceiveAddress_ContactName').val('');
        $('#JpdReceiveAddress_State').val('370000');
        $('#JpdReceiveAddress_City').empty().append('<option value="">请选择市</option>');
        $('#JpdReceiveAddress_District').empty().append('<option value="">请选择区</option>');
        $('#JpdReceiveAddress_State').change();
        $('#JpdReceiveAddress_Address').val('');
        $('#JpdReceiveAddress_ZipCode').val('');
        $('#JpdReceiveAddress_Phone').val('');
        $('#JpdReceiveAddress_State').removeAttr('city');
        $('#JpdReceiveAddress_State').removeAttr('area');
        $('#myaddress').dialog('open');
    }

    $('#adresssumit').click(function() {
        var url = Yii_baseUrl + '/pap/buyorder/addaddress';
        var key = $('#adresssumit').attr('key');
        var name = $('#JpdReceiveAddress_ContactName').val();
        var province = $('#JpdReceiveAddress_State').val();
        var city = $('#JpdReceiveAddress_City').val();
        var area = $('#JpdReceiveAddress_District').val();
        var address = $('#JpdReceiveAddress_Address').val();
        var zipcode = $('#JpdReceiveAddress_ZipCode').val();
        var phone = $('#JpdReceiveAddress_Phone').val();
        var submit = 1;
        $('#address-form').find('input[type="text"]').each(function(i, v) {
            if ($(this).val() == '') {
                $(this).focus();
                submit = 0;
            }
            if (i == 2 && $(this).val() != '') {
                //匹配手机号码格式是否正确
                var reg = /^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/;
                if (!reg.test(phone)) {
                    $(this).focus();
                    submit = 0;
                }
            }
            if (i == 3 && $(this).val() != '') {
                //匹配邮编是否正确
                var reg = /^[0-9][0-9]{5}$/;
                if (!reg.test(zipcode)) {
                    $(this).focus();
                    submit = 0;
                }
            }
        })
        $('#JpdReceiveAddress_City').focus();
        if (city == '') {
            submit = 0;
            $('#JpdReceiveAddress_City').blur();
        }
        if (submit == 0) {
            return false;
        }
        if (name != '')
        {
            $('#JpdReceiveAddress_ContactName_em_').text('');
        }
        if (province != '') {
            $('#JpdReceiveAddress_Province_em_').text('');
        }
        if (city != '') {
            $('#JpdReceiveAddress_City_em_').text('');
        }
        if (area != '') {
            $('#JpdReceiveAddress_Area_em_').text('');
        }
        if (address != '') {
            $('#JpdReceiveAddress_Address_em_').text('');
        }
        if (zipcode != '') {
            $('#JpdReceiveAddress_ZipCode_em_').text('');
        }
        if (phone != '') {
            $('#JpdReceiveAddress_Phone_em_').text('');
        }
        if ($('.errorMessage').text() != '')
        {
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    'key': key,
                    'name': name,
                    'province': province,
                    'city': city,
                    'area': area,
                    'address': address,
                    'zipcode': zipcode,
                    'phone': phone
                },
                dataType: 'json',
                //同步  
                async: false,
                success: function(data) {
                    if (data.success == 1)
                    {

                        $('#myaddress').dialog('close');
                        $('#addresssearch').trigger('click');
                        alert('保存成功')
                        //location.reload();
                    } else {
                        return false;
                    }
                }
            });
        }
    });

    $(document).on("click", "a[addressid]", function() {
        var id = $(this).attr('addressid');
        $("#myaddress").dialog("open");
        $('#adresssumit').val('保存');
        $('#adresssumit').attr('key', id);
        var url = Yii_baseUrl + '/pap/buyorder/updateaddress';
        $.getJSON(url, {id: id}, function(data) {
            $('#JpdReceiveAddress_ContactName').val(data.ContactName);
            $('#JpdReceiveAddress_State').val(data.State);
            $('#JpdReceiveAddress_State').attr('city', data.City);
            $('#JpdReceiveAddress_State').attr('area', data.District);
            $('#JpdReceiveAddress_State').change();
            $('#JpdReceiveAddress_Address').val(data.Address);
            $('#JpdReceiveAddress_ZipCode').val(data.ZipCode);
            $('#JpdReceiveAddress_Phone').val(data.Phone);
        });
    })
</script>