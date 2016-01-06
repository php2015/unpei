(function($){
    //样式补全
    $('head').append('<style>.main tbody tr.tr-hover{background-color:#EFF7B5;}</style>');
    //class width 自动加载宽度
    $(function(){
        //默认调整底部条
        var jiapDoms=jiapDoms || {};
        jiapDoms.foot = $('.footer');
        if($('body').height()<$(window).height()){
            jiapDoms.foot.css({
                position:'absolute',
                bottom:'0px',
                width:'100%',
                "z-index":-1
            });
        }
        $(window).resize(function(){
            var fstat = jiapDoms.foot.css('position');
            if(fstat=='static' && $('body').height()<$(window).height()){
                jiapDoms.foot.css({
                    position:'absolute',
                    bottom:'0px',
                    width:'100%',
                    "z-index":-1
                });
            }else if(fstat=='absolute' && $('body').height()+100>$(window).height()){
                jiapDoms.foot.css({
                    position:'static'
                });
            }
        });
        var list = $("*[class^='width']");
        list.each(function(){
            var self = $(this);
            var width=self.attr('class').split(' ')[0].substr(5);
            self.css({
                width:width
            });
        });
        $('input:text[fuc="s"]').each(function(){  
            var txt = $(this).val();  
            $(this).focus(function(){  
                if(txt === $(this).val()) $(this).val("");  
            }).blur(function(){  
                if($(this).val() == "") $(this).val(txt);  
            });  
        }) 
       
        //文本域label标签顶部对齐
        $("textarea").prev('label').css({
            "vertical-align":'top'
        });
    });

    //上传文件名显示
    $("input[type='file']").on('change',function(){
        var inputfile = $(this).closest('.inputfile');
        if(inputfile.length!=0){
            var after = $(inputfile).nextAll('span');
            after.length>0 && after.remove();
            $(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
        }else{
            var inputfile_input = $(this).closest('.inputfile-input');
            if(inputfile_input.length==0){
                return;
            }
            var before = $(this).prevAll('span');
            before.length>0 && before.remove();
            $(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
        }
    });

    //输入分词标签 应用于“主营品类”等
    $(function(){
        $('.word-tag').on('focus',function(){
            var self = $(this),
            slide = $("#"+self.attr('target'));
            self.keydown(function(event){
                var val = $.trim(self.val());
                if(event.keyCode==32 && val){
                    slide.append("\n<a class='tag'>"+val+"</a>");
                    self.val('');
                    !slide.hasClass('display-ib') && slide.removeClass('display-n').addClass('display-ib');
                }
            });
        });
    });
    //删除
    $(document).delegate('.close','click',function(){
        $(this).parent().remove();
    });
    //删除
    $(document).delegate('.hide','click',function(){
        $(this).parent().hide();
    });
    //tab页切换
    $('.tabs a').click(function(){
        var pre = $(this).closest('.tabs').attr('pre'),
        index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('#'+pre+index).show().siblings().hide();
    });

    //绿色标签
    $(document).delegate('.tags','click',function(){
        $(this).addClass('bg-green').siblings().removeClass('bg-green').parent().find('.tag-close').remove();
    });
    //加入rm属性,选择器为.class或标签,从触发器同级元素中选择 格式：触发方式[click,hover,...]_jquery选择器[选择器不能带下划线]_移除的属性[class移除class,dom移除元素]_[属性值[属性值不能带下划线]]
    $(function(){
        var rm_list = $("*[rm]");
        rm_list.each(function(){
            if(!$(this).attr('rm'))return;
            var self = $(this),
            _opt = self.attr('rm').split('_')
            _act = _opt[0],
            _do = _opt[2],
            _sib = null,
            _target = null;

            switch(_do){
                case "class":
                    self.on(_act,function(){
                        _sib=(_opt[1].substr(0,1)!='#')?true:false;
                        _target = _sib?self.siblings(_opt[1]):$(_opt[1]);
                        _target && _target.removeClass(_opt[3]);
                    });
                    break;
                case "dom":
                    self.on(_act,function(){
                        _sib=(_opt[1].substr(0,1)!='#')?true:false;
                        _target = _sib?self.siblings(_opt[1]):$(_opt[1]);
                        _target && _target.remove();
                    });
                    break;
            }
        });
    });
    
    

    //photos-list
    $(function(){
        var num = $('.photos-list li').length;
        if($('.photos-list li').parents("#showdetail")){
            // 大于3张图片 显示左右按钮
            if(num>3){
                var sl = $('.jgcx.photos .arr-l'),
                sr = $('.jgcx.photos .arr-r'),
                ul = $('.photos-list ul');
                sl.show();
                sr.show();
                // ul 宽度
                var length = num*240;
                ul.css({
                    "width":length
                });
                //左右滚动
                sl.on('click',function(){
                    if(!sr.is(":visible")){
                        sr.show();
                    }
                    var left = parseInt(ul.css('left'))-240;
                    ul.animate({
                        left:left
                    });
                    if(length+left<=690){
                        ul.css({
                            left:length-240
                        });
                        sl.hide();
                    }
                });
                sr.on('click',function(){
                    if(!sl.is(":visible")){
                        sl.show();
                    }
                    var left = parseInt(ul.css('left'))+240;
                    ul.animate({
                        left:left
                    });
                    if(left >= 0){
                        ul.css({
                            left:0
                        });
                        sr.hide();
                    }
                });
            }
        }else{
            // 大于4张图片 显示左右按钮
            if(num>4){
                var sl = $('.jgcx.photos .arr-l'),
                sr = $('.jgcx.photos .arr-r'),
                ul = $('.photos-list ul');
                sl.show();
                sr.show();
                // ul 宽度
                var length = num*250;
                ul.css({
                    "width":length
                });
                //左右滚动
                sl.on('click',function(){
                    if(!sr.is(":visible")){
                        sr.show();
                    }
                    var left = parseInt(ul.css('left'))-250;
                    ul.animate({
                        left:left
                    });
                    if(length+left<=920){
                        ul.css({
                            left:length-250
                        });
                        sl.hide();
                    }
                });
                sr.on('click',function(){
                    if(!sl.is(":visible")){
                        sl.show();
                    }
                    var left = parseInt(ul.css('left'))+250;
                    ul.animate({
                        left:left
                    });
                    if(left >= 0){
                        ul.css({
                            left:0
                        });
                        sr.hide();
                    }
                });
            }
        }
    });

    //加入showin属性,
    $(function(){
        var showin_list = $("*[showin]");
        showin_list.each(function(){
            if(!$(this).attr('showin'))return;
            var self = $(this),
            _opt = self.attr('showin').split('_'),
            _act = _opt[0],
            _target = $(_opt[1]);
            self.on(_act,function(e){
                !_target.is(':visible') && _target.eleMid({
                    "mouse":e
                }).show();
            });
        });
    });

    function pos_bottom(){
        var fstat = $('.footer').css('position');
        if(fstat=='static' && $('body').height()<$(window).height()){
            $('.footer').css({
                position:'absolute',
                bottom:'0px',
                width:'100%',
                "z-index":-1
            });
        }else if(fstat=='absolute' && $('body').height()+100>$(window).height()){
            $('.footer').css({
                position:'static'
            });
        }
    }

    $(document).delegate('.sidebar-hide','click',function(){
        $('.sidebar').hide();
        $('.content').css({
            'margin-left':0
        }).width(998).find('.sidebar-show').show();
        $('#jp-layout').layout('resize',{
            width:998
        });
        $('#jp-layout').height(500);
        //        $('.easyui-layout').width(998);
        $('.easyui-datagrid').datagrid('resize',{
            width:998
        });
        $('#ttabs').tabs('resize');
        pos_bottom();
    });

    $(document).delegate('.sidebar-show','click',function(){
        $('.sidebar').show();
        $('.content').css({
            'margin-left':'10px'
        }).width(768).find('.sidebar-show').hide();
        //        $('.easyui-layout').width(768);
        $('#jp-layout').layout('resize',{
            width:768
        });
        $('#jp-layout').height(500);
        $('.easyui-datagrid').datagrid('resize',{
            width:768
        });
        $('#ttabs').tabs('resize');
        pos_bottom()
    });

    $('#major-goods').length>0 && $('#major-goods').eleMid();

    //slider
    $(document).delegate('.slider','click',function(){
        var id = '#'+$(this).attr('tag');
        var hider = $(id).not(':visible');
        if(hider.length>0){
            $(this).addClass('font-green').find('.icon-arr-b').removeClass('icon-arr-b').addClass('icon-arr-green-t');
            hider.show();
        }else{
            $(this).removeClass('font-green').find('.icon-arr-green-t').removeClass('icon-arr-green-t').addClass('icon-arr-b');
            $(id).hide();
        }
    });

    //$(document).height()>$(window).height() && fix_footer_bottom();

    //嘉配伙伴 收益账户切换
    $(function(){
        function account_sh(){
            $('#zfb-account,#yh-account').each(function(){
                var listid = '#'+$(this).attr('id')+'-list';
                if($(this).prop('checked')){
                    $(listid).show();
                }else{
                    $(listid).hide();
                }
            });
        }
        $('#zfb-account,#yh-account').on('change',function(){
            account_sh();
        });
        $('.zf-account-list li').click(function(){
            $(this).addClass('active').siblings().removeClass('active');
        });
        account_sh();
    });
})(jQuery);

//高度对齐函数
function get_height_align(ele1,ele2,$){
    var $ = $ || jQuery;
    var ele1 = $(ele1);
    if(!ele1 || ele1.length==0){
        return;
    }
    var ele2 = $(ele2);
    ele1.css({
        'height':'auto'
    }).addClass("auto_height");
    ele2.css({
        'height':'auto'
    }).addClass("auto_height");
    var e1_h = ele1.height(),
    e2_h = ele2.height();
    var lh = e1_h>e2_h?e1_h:e2_h;
    ele2.css({
        "min-height":lh
    });
    ele1.css({
        "min-height":lh
    });
    var fstat = $('.footer').css('position');
    if(fstat=='static' && $('body').height()<$(window).height()){
        $('.footer').css({
            position:'absolute',
            bottom:'0px',
            width:'100%',
            "z-index":-1
        });
    }else if(fstat=='absolute' && $('body').height()+100>$(window).height()){
        $('.footer').css({
            position:'static'
        });
    }
}

function get_height_left(ele1,ele2,$){
    //ele  s  ele2  c
    var $ = $ || jQuery;
    var ele1 = $(ele1);
    if(!ele1 || ele1.length==0){
        return;
    }
    var ele2 = $(ele2),
    e1_h = ele1.height(),
    e2_h = ele2.height();
    e1_h<e2_h && ele2.height(e1_h);
    e1_h>e2_h && ele1.height(e2_h);
}
function fix_footer_bottom(){
    $('.footer').css({
        position:"absolute",
        width:'100%',
        bottom:'0px'
    });
}
jQuery.displayMsg = function(data, obj, okCallback, errCallback) {
    var ret = true;
    var message= "";
    if(data){
        if(data.result){
            ret = true;
        }else{
            ret = false;
            message = "操作失败: " + data.errMsg;
        }
    }else{
        ret = false;
        message = "操作失败";
    }
    if($.trim(message) != ''){
        if(obj == null) {
            obj = $('.tab-content');
        }
        var msgContent = '<div class="msg-summary">'+message+'</div>';
        obj.prepend(msgContent).show();
        setTimeout(function() { 
            $('.msg-summary').fadeOut('slow',function(){
                $(this).remove();
            }); 
        }, 15000);
    }

    // 执行成功回调函数
    if(ret && okCallback){
        okCallback(); 
    }
    // 执行错误回调函数
    if(!ret && errCallback) {
        errCallback();
    }    
}


//隔行变色，放置变色
$(function(){
    //不要变色的表格
    $('.datagrid-pager.pagination table,.dialog-content table').addClass('nocss');
    $('.datagrid-header-row').closest('table').addClass('nocss');


    $("tr").removeClass("bg-green-light"); 
    if($('tr.empty').length>0){
        $("tbody tr:not(.empty)").each(function(i){
            if(i%2==0)return;
            $(this).addClass("bg-green-light"); 
        });
    }else if($('#success_assess,#fail_list').length>0){
        $('#success_assess tbody tr,#fail_list tbody tr').each(function(i){
            i%4==0 && $(this).addClass("bg-green-light"); 
        });
    }else{
        $("table:not('.nocss') tbody tr:odd").addClass("bg-green-light"); 
    }
    $("table:not('.nocss') tbody tr").live({
        mouseout: function() {
            $(this).removeClass("tr-hover");
        },
        mouseover: function() {
            $(this).addClass("tr-hover");
        }
    });
})

//根据头部菜单项的多少控制单项的右边距
$(function(){
    var alist = $('.top-menu a'),
    n = alist.length,
    totle_width = 0,
    totle_text_width=0,
    text_width={};
    alist.each(function(i){
        var self = $(this);
        text_width[i]=self.text().length*14;
        totle_text_width +=text_width[i];
        totle_width += text_width[i]+parseInt(self.css('margin-right'));
    });
    if(totle_width<720)return;
    var marg_w = 720-totle_text_width;
    alist.each(function(i){
        var self = $(this);
        self.css('margin-right',marg_w/n);
    });
});
//linkbutton方法补充
function setButtonState(domElem, disabled) {                    // 设置按钮状态
    var data = $.data(domElem, "linkbutton");                   // 获取对象的数据
    if (disabled) {                                             // 禁用按钮
        data.options.disabled = true;
        var href = $(domElem).attr("href");                     // 获取超级连接
        if (href) {
            data.href = href;                                   // 保存原来的超级链接
            $(domElem).attr("href", "javascript:void(0)");      // 重新设置
        }
        if (domElem.onclick) {                                  // 是否有点击事件处理
            data.onclick = domElem.onclick;
            domElem.onclick = null;                             // 取消掉
        }
        var eventData = $(domElem).data("events") || $._data(domElem, 'events');
        if (eventData && eventData["click"]) {
            var clickHandlerObjects = eventData["click"];
            data.savedHandlers = [];
            for (var i = 0; i < clickHandlerObjects.length; i++) {
                if (clickHandlerObjects[i].namespace != "menu") {
                    var handler = clickHandlerObjects[i]["handler"];
                    $(domElem).unbind('click', handler);
                    data.savedHandlers.push(handler);
                }
            }
        }

        $(domElem).addClass("l-btn-disabled");                  // 使用样式
    } else {
        data.options.disabled = false;                          // 启用按钮
        if (data.href) {                                        // 恢复原来的超级链接
            $(domElem).attr("href", data.href);
        }
        if (data.onclick) {                                     // 恢复原来的点击事件处理
            domElem.onclick = data.onclick;
        }
        if (data.savedHandlers) {
            for (var i = 0; i < data.savedHandlers.length; i++) {
                $(domElem).click(data.savedHandlers[i]);
            }
        }

        $(domElem).removeClass("l-btn-disabled");
    }
}
/**
* easyui linkbutton方法扩展
* @param {Object} jq
*/
$.extend($.fn.linkbutton.methods, {
    /**
    * 激活选项（覆盖重写）
    * @param {Object} jq
    */
    enable: function(jq){
        return jq.each(function(){
            setButtonState(this,false);
        });
    },
    /**
    * 禁用选项（覆盖重写）
    * @param {Object} jq
    */
    disable: function(jq){
        return jq.each(function(){
            setButtonState(this,true);
        });
    }
});
//扩展 获得tree 的实心节点    
$(function(){  
    $.extend($.fn.tree.methods,{  
        getCheckedExt: function(jq){  
            var checked = $(jq).tree("getChecked");                     //获取选中的选项 也就是打钩的   
            var checkbox2 = $(jq).find("span.tree-checkbox2").parent(); //获取实心的选项 也就是实心方块的   
            $.each(checkbox2,function(){  
                var node = $.extend({}, $.data(this, "tree-node"), {  
                    target : this 
                });  
                var parentNode=$(jq).tree('getNode',node.target);
                checked.push(parentNode);  
            });  
            return checked;  
        }  
    });  
})  
$.extend($.fn.validatebox.defaults.rules, {
    CHS: {
        validator: function (value, param) {
            return /^[\u0391-\uFFE5]{1,8}$/.test(value);
        },
        message: '请输入汉字，长度为1-8，正确格式：张三'
    },
    ZIP: {
        validator: function (value, param) {
            return /^[1-9]\d{5}$/.test(value);
        },
        message: '邮政编码不存在'
    },
    QQ: {
        validator: function (value, param) {
            return /^[1-9]\d{4,10}$/.test(value);
        },
        message: 'QQ号码不正确,正确格式为数字5-11位'
    },
    mobile: {
        validator: function (value, param) {
            return /^1[3|4|5|8][0-9]\d{4,8}$/.test(value);
        },
        message: '手机号码不正确,正确格式如：13899990000'
    },
    telephone: {
        validator: function (value, param) {
            // return /^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/.test(value);
            return /^(0[0-9]{2,3}\-{0,1})?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/.test(value);
        },
        message: '固定电话不正确,正确格式如:010-22222222 或 01022222222'
    },
    datainfoformat: {
        validator: function (value, param) {
            return /^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/.test(value);
        },
        message: '日期格式不正确,正确格式如：1999-09-09'
    },
    email: {
        validator: function (value, param) {
            return /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        },
        message: '邮箱格式不正确,正确格式如：chg@163.com'
    },
    loginName: {
        validator: function (value, param) {
            return /^[A-Za-z0-9_]{3,20}$/.test(value);
        },
        message: '用户名只允许英文字母、数字及下划线,长度须在3-20之间。'
    },
    safepass: {
        validator: function (value, param) {
            return /^[0-9a-zA-Z_]{6,15}$/.test(value)
        },
        message: '密码由字母（大小写不限）、数字、下划线组成的6-15位字符'
    },
    equalTo: {
        validator: function (value, param) {
            return value == $(param[0]).val();
        },
        message: '两次输入的字符不一致!'
    },
    equalToCode: {
        validator: function (value, param) {
            return value == $(param[0]).val();
        },
        message: '验证码不正确!'
    },
    number: {
        validator: function (value, param) {
            return /^\d+$/.test(value);
        },
        message: '请输入数字'
    },
    monthss: {
        validator: function (value, param) {
            return /^(0?[[0-9]|1[0-2])$/.test(value);
        },
        message: '请输入正确月份'
    },
    
    floatnum:{
        validator:function(value, param){
            return /^[0-9]{1,5}(.[0-9]{1,2})?$/.test(value);
        },
        message: '请输入正确的数字,可以有两位小数。正确格式 ：123.00'
    }
//    idcard: {
//        validator: function (value, param) {
//            return idCard(value);
//        },
//        message:'请输入正确的身份证号码'
//    }
});
///* 密码由字母和数字组成，至少6位 */
//var safePassword = function (value) {
//    return !(/^(([A-Z]*|[a-z]*|\d*|[-_\~!@#\$%\^&\*\.\(\)\[\]\{\}<>\?\\\/\'\"]*)|.{0,5})$|\s/.test(value));
//}
//
//var idCard = function (value) {
//    if (value.length == 18 && 18 != value.length) return false;
//    var number = value.toLowerCase();
//    var d, sum = 0, v = '10x98765432', w = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2], a = '11,12,13,14,15,21,22,23,31,32,33,34,35,36,37,41,42,43,44,45,46,50,51,52,53,54,61,62,63,64,65,71,81,82,91';
//    var re = number.match(/^(\d{2})\d{4}(((\d{2})(\d{2})(\d{2})(\d{3}))|((\d{4})(\d{2})(\d{2})(\d{3}[x\d])))$/);
//    if (re == null || a.indexOf(re[1]) < 0) return false;
//    if (re[2].length == 9) {
//        number = number.substr(0, 6) + '19' + number.substr(6);
//        d = ['19' + re[4], re[5], re[6]].join('-');
//    } else d = [re[9], re[10], re[11]].join('-');
//    if (!isDateTime.call(d, 'yyyy-MM-dd')) return false;
//    for (var i = 0; i < 17; i++) sum += number.charAt(i) * w[i];
//    return (re[2].length == 9 || number.charAt(17) == v.charAt(sum % 11));
//}
//
//var isDateTime = function (format, reObj) {
//    format = format || 'yyyy-MM-dd';
//    var input = this, o = {}, d = new Date();
//    var f1 = format.split(/[^a-z]+/gi), f2 = input.split(/\D+/g), f3 = format.split(/[a-z]+/gi), f4 = input.split(/\d+/g);
//    var len = f1.length, len1 = f3.length;
//    if (len != f2.length || len1 != f4.length) return false;
//    for (var i = 0; i < len1; i++) if (f3[i] != f4[i]) return false;
//    for (var i = 0; i < len; i++) o[f1[i]] = f2[i];
//    o.yyyy = s(o.yyyy, o.yy, d.getFullYear(), 9999, 4);
//    o.MM = s(o.MM, o.M, d.getMonth() + 1, 12);
//    o.dd = s(o.dd, o.d, d.getDate(), 31);
//    o.hh = s(o.hh, o.h, d.getHours(), 24);
//    o.mm = s(o.mm, o.m, d.getMinutes());
//    o.ss = s(o.ss, o.s, d.getSeconds());
//    o.ms = s(o.ms, o.ms, d.getMilliseconds(), 999, 3);
//    if (o.yyyy + o.MM + o.dd + o.hh + o.mm + o.ss + o.ms < 0) return false;
//    if (o.yyyy < 100) o.yyyy += (o.yyyy > 30 ? 1900 : 2000);
//    d = new Date(o.yyyy, o.MM - 1, o.dd, o.hh, o.mm, o.ss, o.ms);
//    var reVal = d.getFullYear() == o.yyyy && d.getMonth() + 1 == o.MM && d.getDate() == o.dd && d.getHours() == o.hh && d.getMinutes() == o.mm && d.getSeconds() == o.ss && d.getMilliseconds() == o.ms;
//    return reVal && reObj ? d : reVal;
//    function s(s1, s2, s3, s4, s5) {
//        s4 = s4 || 60, s5 = s5 || 2;
//        var reVal = s3;
//        if (s1 != undefined && s1 != '' || !isNaN(s1)) reVal = s1 * 1;
//        if (s2 != undefined && s2 != '' && !isNaN(s2)) reVal = s2 * 1;
//        return (reVal == s1 && s1.length != s5 || reVal > s4) ? -10000 : reVal;
//    }
//};

$(function(){
    $("input").click(function(){
        this.style.color="#000"
    })
    $("select").change(function(){
        this.style.color="#000"
    })
})