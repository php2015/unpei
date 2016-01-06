<div id="autosave" style="display:none;height:30px;line-height:30px;color:#764928;background:#fff;border:2px solid #feca9a;width:200px;text-align:center;position:fixed;z-index:10;top:167px;left:44%">
    编辑已自动保存
</div>

<script>
<?php $prices = DealergoodsService::getmaxprice(); ?>
    var maxprice =<?php echo $prices['maxprice']; ?>;
    var maxnum =<?php echo $prices['maxnum']; ?>;
    window.setInterval("savegoods()", 300000);   //隔一段时间将数据保存到数据库
    var saves = {};
<?php if ($info): ?>
        saves.goodsinfo = '<?php echo $info['goodsinfo']; ?>';
        saves.totalprices = '<?php echo $info['GoodFee']; ?>';
        saves.quoname = '<?php echo $info['Title']; ?>';
        saves.quosn = '<?php echo $info['QuoSn']; ?>';
<?php endif; ?>

    function closedg() {
        $("#autosave").fadeOut("slow", 0);
        //$("#autosave").hide("slow", 0);
    }

    //判断对象是否为空
    function isemptyobject(obj) {
        for (var name in obj) {
            return false;
        }
        return true;
    }

    function savegoods() {
        var send = 0;
        var data = {};
        var buyobj = $('#buylist tbody').find('tr');
        var length = buyobj.length;
        var isnull = isemptyobject(saves);
        var compare = 0;
        if (length == 0 && isnull) {
            return false;
        }
        else if (length > 0 && isnull) {
            compare = 0;
        } else {
            compare = 1;
        }
        var goodsid = '';
        var goodsprice = '';
        var goodsnum = '';
        var goodsinfo = [];
        buyobj.each(function(k, v) {
            goodsid += $(this).attr('goodsid') + ',';
            goodsprice += $(this).find('[name=price]').val() + ',';
            goodsnum += $(this).find('[name=num]').val() + ',';
            goodsinfo[k] = $(this).attr('goodsid') + ',' + $(this).find('[name=price]').val() + ',' + $(this).find('[name=num]').val() + ','
        })
        data.totalprices = $('#totalprices').val();
        data.quoname = $('input[name=quoname]').val();
        data.quosn = $('input[name=quosn]').val();
        if (compare == 1) {
            $.each(saves, function(k, v) {
                if (k == 'goodsinfo') {
                    $.each(goodsinfo, function(kk, vv) {
                        if (v.indexOf(vv) == -1) {
                            send = 1;
                            return false;
                        } else {
                            send = 0;
                        }
                    })
                } else {
                    if (saves[k] != data[k]) {
                        send = 1;
                        return false;
                    }
                }
                if (send == 1) {
                    return false;
                }
                else {
                    send = 0;
                }
            })
        } else {
            send = 1;
        }
        if (send == 0) {
            return false;
        }
        saves.goodsinfo = '';
        $.each(goodsinfo, function(kk, vv) {
            saves.goodsinfo += vv + ',';
        })
        data.quoids = goodsid.substr(0, goodsid.length - 1);
        data.quoprice = goodsprice.substr(0, goodsprice.length - 1);
        data.quonum = goodsnum.substr(0, goodsnum.length - 1);
        saves.totalprices = data.totalprices;
        saves.quoname = data.quoname;
        saves.quosn = data.quosn;
        data.type = '<?php echo Yii::app()->controller->id == 'quotation' ? 1 : 2; ?>';
        if (length == 0) {
            return;
        }
        if (data.type == 1) {
            data.sid = '<?php echo $_GET['sid'] ?>';
            data.quoid = $('#quoid').val();
            data.schid = $('#schid').val();
        } else {
            data.inqid = '<?php echo $_GET['inqid'] ?>';
            data.schid = $('#schid').val();
        }
        var url = Yii_baseUrl + '/pap/quotation/saveedit';
        $.post(url, data, function(res) {
            if (res.success) {
                if (data.type == 1) {
                    $('#quoid').val(res.quoid);
                    $('#schid').val(res.schid);
                } else {
                    $('#schid').val(res.schid);
                }
                $("#autosave").fadeIn();
                //$("#autosave").show();
                window.setTimeout("closedg()", 2000);
            }
        }, 'json')
    }
    //循环读取商品订购清单获取商品已订购商品id
    function setbuyids()
    {
        var ids = '';
        $("#buylist tbody").find('tr').each(function(k, v) {
            ids = ids + $(this).attr('goodsid') + ',';
        })
        $('#buyids').val(ids.substr(0, ids.length - 1));
    }

    //商品清单全选事件
    $(document).on("click", "#goodslist thead th:eq(0)", function() {
        if ($(this).find(':checkbox').attr("checked")) {
            $('#goodslist tbody tr').addClass('tr_click');
        } else
            $('#goodslist tbody tr').removeClass('tr_click');
    })

    //商品清单单击行事件
    $(document).on("click", "#goodslist tbody tr", function() {
        if ($(this).find('input[type="checkbox"]').attr("checked")) {
            return false;
        } else {
            var trcount = $('#goodslist tbody').find('tr').length;
            $(this).find('input[type="checkbox"]').attr('checked', true);
            $(this).addClass('tr_click');
            var checkcount = $('#goodslist tbody').find('input[type="checkbox"]:checked').length;
            if (trcount == checkcount)
                $('#goodslist thead :checkbox').attr('checked', true);
        }
    })

    $(document).on("click", "#goodslist tbody tr td", function() {
        if ($(this).index() == 2 || $(this).index() == 3) {
            window.open($(this).children('a').attr('href'));
            return false;
        }
    })

    //商品清单checkbox单击事件
    $(document).on("click", "#goodslist tbody :checkbox", function(e) {
        e.stopPropagation();
        if ($(this).attr('checked') == 'checked') {
            var trcount = $('#goodslist tbody').find('tr').length;
            $(this).parents('tr').addClass('tr_click');
            var checkcount = $('#goodslist tbody').find('input[type="checkbox"]:checked').length;
            if (trcount == checkcount)
                $('#goodslist thead :checkbox').attr('checked', true);
        } else {
            $(this).parents('tr').removeClass('tr_click');
            $('#goodslist thead :checkbox').removeAttr('checked');
        }
    })

    //商品清单双击事件
    $(document).on("dblclick", "#goodslist tbody tr", function() {
        var idsarr = $('#buyids').val().split(",");
        var goodsid = $(this).find(':checkbox').val();
        if ($.inArray(goodsid, idsarr) > -1) {
            if (confirm('商品已存在,是否增加商品数量')) {
                addagain(goodsid);
                counttotal();
                return;
            }
        }
        addgoods($(this).find(':checkbox'));
        formatrowno();
        counttotal();
    })

    //商品订购清单删除商品事件
    $(document).on("click", "#buylist tr .delgoods", function() {
        $(this).parents('tr').remove();
        setbuyids();
        formatrowno();
        counttotal();
    })

    //格式化商品订购清单行号和class
    function formatrowno()
    {
        againadd = 0;
        var row;
        $("#buylist tbody tr").find('td:eq(0)').each(function(k, v) {
            row = k + 1;
            if (row % 2 == 0)
            {
                $(this).parent('tr').addClass('even');
                $(this).parent('tr').removeClass('odd');
            }
            else
            {
                $(this).parent('tr').addClass('odd');
                $(this).parent('tr').removeClass('even');
            }
            $(this).html(row);
        })
    }

    //数量减一
    function numsub(id, obj)
    {
        var num = $(obj).next('input').val();
        if (num > 1)
        {
            num = parseInt(num) - 1;
        }
        else
            return;
        $(obj).next('input').val(num);
        counttotal(id);
    }

    //数量加一
    function numadd(id, obj)
    {
        var num = $(obj).prev('input').val();
        num = parseInt(num) + 1;
        if (num > 100) {
            num = 100;
        }
        $(obj).prev('input').val(num);
        counttotal(id);
    }

    //输入商品数量
    function numkeyup(id, obj) {
        var val = obj.value;
        if (val <= 1) {
            obj.value = 1;
        }
        if (isNaN(val))
        {
            obj.value = 1;
        }
        if (val > 100) {
            obj.value = 100;
        }
        obj.value = obj.value.replace(/\D/g, '');
        counttotal(id);
    }

    //鼠标移出商品数量
    function numblur(id, obj) {
        var val = obj.value;
        if (isNaN(val))
        {
            obj.value = 1;
        }
        if (!isNaN(val)) {
            //如果数量超过100
            if (parseInt(val) > 100) {
                obj.value = 100
            }
        }
        counttotal(id);
    }

    //输入商品单价
    function pricekeyup(price, obj) {
        var val = obj.value;
        if (!$.isNumeric(val)) {
            if (val != '')
                obj.value = price;
        } else {
            return;
            var reg = new RegExp("^\\d{1," + maxnum + "}(\\.\\d{1,2})?$");
            if (!reg.test(val)) {
                obj.value = price;
                alert('请输入不大于' + maxprice + '的数,且最多两位小数。正确格式 ：123.00，123');
            }
        }
    }

    //鼠标移出商品单价
    function priceblur(id, obj) {
        if (obj.value == '')
            obj.value = '0';
        else if (obj.value.indexOf(".") == -1 && obj.value > 0)
        {
            if (obj.value.substr(0, 1) == '0')
                obj.value = obj.value.substr(1);
        }
        var val = parseFloat(obj.value);
        var reg = new RegExp("^[0-9]+(.[0-9]{1,2})?$", "g");
        if (!reg.test(val)) {
            obj.value = val.toFixed(2);
        }
        var reg = new RegExp("^\\d{1," + maxnum + "}(\\.\\d{1,2})?$");
        if (!reg.test(obj.value)) {
            obj.value = maxprice;
            alert('请输入不大于' + maxprice + '的数,且最多两位小数。正确格式 ：123.00，123');
        }
        counttotal(id);
    }

    //计算单个商品总价
    function countgoods(id) {
        var objtr = $('#buylist tr[goodsid=' + id + ']');
        var price = parseFloat(objtr.find('[name=price]').val());
        var num = parseInt(objtr.find('[name=num]').val());
        var prices = price * num;
        objtr.find('[name=prices]').text(prices.toFixed(2));
    }
    //计算报价
    function counttotal(id) {
        //计算单个商品总价
        if (id != undefined) {
            countgoods(id);
        }
        //计算报价单物流费与总价
        //商品总价
        var totalprices = 0;
        //物流费用
        var shipprices = parseFloat($('#shipprices').val());
        if ($('#shipprices').val() == '')
            shipprices = 0;
        $('#buylist tbody').find('td[name=prices]').each(function(k, v) {
            totalprices += parseFloat($(this).text());
        })
        shipprices = shipprices.toFixed(2);
        totalprices = totalprices.toFixed(2);
        var quoprices = parseFloat(totalprices) + parseFloat(shipprices);
        $('#totalprices').val(totalprices);
        $('#shipprices').val(shipprices);
        $('#quoprices').val(quoprices.toFixed(2));
    }

    //物流价改变事件
    $('#shipprices').change(function() {
        if (!$.isNumeric($('#shipprices').val()) || $('#shipprices').val() < 0)
            $('#shipprices').val(0);
        var totalprices = $('#totalprices').val() == '' ? 0 : parseFloat($('#totalprices').val());
        var shipprices = $('#shipprices').val() == '' ? 0 : parseFloat($('#shipprices').val());
        var quoprices = parseFloat(totalprices) + parseFloat(shipprices);
        $('#quoprices').val(quoprices.toFixed(2));
    })

    $("input[type='file']").live('change', function() {
        var inputfile = $(this).closest('.inputfile');
        if (inputfile.length != 0) {
            var after = $(inputfile).nextAll('span');
            after.length > 0 && after.remove();
            $(inputfile).after('<span style="margin-left:5px;">' + $(this).val() + '</span>')
        } else {
            var inputfile_input = $(this).closest('.inputfile-input');
            if (inputfile_input.length == 0) {
                return;
            }
            var before = $(this).prevAll('span');
            before.length > 0 && before.remove();
            $(this).before('<span style="margin-left:5px;">' + $(this).val() + '</span>')
        }
    });
    $("input[name=removeupload]").click(function() {
        $(this).parent('p').find(".input").find("span").remove();
        var afile = $(this).parent('p').find("input[type=file]");
        afile.after(afile.clone().val(""));
        afile.remove();
    });
    //添加重复商品事件
    function addagain(goodsid) {
        var domtr = $('#buylist tbody').find('tr[goodsid="' + goodsid + '"]');
        //数量加一
        if (parseInt(domtr.find('td:eq(7) input').val()) < 100) {
            domtr.find('td:eq(7) input').val(parseInt(domtr.find('td:eq(7) input').val()) + 1);
            countgoods(goodsid);
        }
    }
</script>

<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?<?php echo time(); ?>'></script>
<script>
    $(function() {
        //文件上传
<?php $path = 'dealer/' . Yii::app()->user->getOrganID() . '/'; ?>
        var path = "<?php echo $path; ?>";
        setTimeout(function() {
            $("#file_upload").uploadify({
                'auto': true,
                'queueId': 'some_file+queue',
                'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
                'uploader': Yii_baseUrl + '/upload/FtpUpload',
                'buttonText': '上传附件',
                //  'width'     : 82,//flash宽 由于设置的背景图片的宽是60 高是22 所以这里和下面设置60 22
                'height': 25, //flash高
                'method': 'post',
                'formData': {'path': path},
                'fileDesc': 'word/excel',
                'fileTypeExts': '*.doc;*.docx;*.xls;*.xlsx;*.wps;*.ppt',
                'queueSizeLimit': 1, //上传数量  
                'fileSizeLimit': '2MB', //上传文件的大小限制
                'onFallback': function() {
                    uploadify = 0;
                    $('#file_upload').hide();
                    $('.loadflash').show();
                },
                'onUploadStart': function(file) {
                    $("#file_upload").uploadify('settings', 'buttonText', '正在上传');
                    $("#file_upload").uploadify('disable', true);
                },
                'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                    var res = eval("(" + data + ")");
                    var errorinfo = '';
                    if (res && res.code == 200) {
                        $('#delfile').attr('path', res.fileurl);
                        $('#delfile').show();
                        $('#fileurl').val(res.fileurl);
                        $('#filename').val(res.filename);
                        $("#file_upload").uploadify('settings', 'buttonText', '附件已上传');
                    } else {
                        $("#file_upload").uploadify('disable', false);
                        $("#file_upload").uploadify('settings', 'buttonText', '上传附件');
                        errorinfo += '文件上传失败！错误原因：' + res.msg + '<br />';
                        alert(errorinfo);
                    }
                }
            });
        }, 10);
    })

    //删除附件
    $('#delfile').click(function() {
        var path = $(this).attr('path');
        var url = Yii_baseUrl + '/upload/ftpdelfile';
        $.post(url, {'path': path}, function(res) {
            if (res.res == 1) {
                $('#delfile').hide();
                $('#fileurl').val('');
                $('#filename').val('');
                $("#file_upload").uploadify('disable', false);
                $("#file_upload").uploadify('settings', 'buttonText', '上传附件');
            } else {
                alert('删除失败');
            }
        }, 'json');
        return false;
    })
</script>