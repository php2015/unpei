<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl() ?>/css/newhome/chat.css" />
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl() ?>/css/pap/jquery.coolautosuggest.css" />
<script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/pap/jquery.corner.js"></script>
<script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/jpd/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo F::themeUrl() ?>/js/socket.client.js"></script>
<style>
    .suggestions{
        height: 340px !important;
        width: 145px !important;
        overflow-y: scroll !important;
    }
</style>
<?php
$controller = Yii::app()->controller->id;
$chattarget = $controller == 'privatemsg' ? '' : '_blank';
?>
<div class="chaticon">
    <div class="msgs">
        <img src="<?php echo F::themeUrl() ?>/images/chat/msgs.gif">
    </div>
    <em>99</em>
    <div class="i_mian">
        <!--左侧栏-->
        <div class="contacts">
            <h2>
                <input type="text" value="" placeholder="查找联系人或群" id='searchorgan' maxlength="20"/>
            </h2>
            <ul id="chat-list">
                <?php foreach ($sessionlist as $list): ?>
                    <?php
                    $data = RemindService::getUserInfo($list["touserid"]);
                    $name = $data['IsMain'] == '1' ? $data["OrganName"] : $data["OrganName"] . '-' . $data['UserName'];
                    ?>
                    <li touserid="<?php echo $list["touserid"] ?>" id="<?php echo $list["sessionid"] ?>"
                        class="<?php //echo $data['Online']!=1?'noline':'';                                                                                                                                                                               ?>">
                        <img src="<?php echo $data["Logo"] ? (Yii::app()->params->ftpserver["visiturl"] . $data["Logo"]) : ''; ?>">
                        <a title="<?php echo $name ?>"><?php echo $name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>
                <a href="#" class="fl"><img src="<?php echo F::themeUrl() ?>/images/chat/set.png" /></a>
                <a href="<?php echo Yii::app()->createUrl('pap/privatemsg/index') ?>" class="fr" target="<?php echo $chattarget; ?>">查看历史记录</a>
            </h3>
        </div>
        <!--左侧栏结束-->
        <!--右侧栏-->
        <div class="m_m">
            <h2>
                <a></a>
                <ul>
                    <li class="add" title="添加好友"></li>
                    <li class="show" title="收起私信框"></li>
                    <li class="close" title="关闭私信"></li>
                </ul>
            </h2>
        </div>
        <!--又侧栏结束-->
    </div>
</div>
<form id="importform" method="post">
    <input id="fmpath" name="fileurl" type="hidden">
    <input id="fmname" name="filename" type="hidden">
</form>

<script id="SessionTemplate" type="text/x-jquery-tmpl">
    <div class="chatbox" id=${sessionid}_box style="display:none">
    <!--查看历史记录-->
    <div style="height:325px">
    <div class="m_h">
    <p class="fl">查看更多消息</p><i class="fr"></i>
    </div>
    <!--查看历史记录结束-->
    <!--消息-->
    <div class="message">
    <div class="msgbox">
    </div>
    </div>
    <!--消息结束-->
    </div>
    <div class="sendmsg">
    <input type="text" value="" placeholder="按回车发送私信" class="sendinput" touserid='${touserid}'sessionid='${sessionid}' userid='${userid}'/>
    <ul>
    <li class="sd sendbtn" title="点击发送">发送</li>
    <li class="see" title="选择表情"></li>    
    <form method='post' enctype="multipart/form-data">
    <li class="pho" title='发送文件'><input type="file" name='Filedata' class='sendimg' title='发送文件'>
    <input type='hidden' name='path'></li>
    </form>
    </ul>
    </div>
    </div>
</script>

<script id="chatTemplate" type="text/x-jquery-tmpl">
    {{if type=='receive'}}   
    <ul class="record${id}">
    <li class="i_two">
    <span><img src="${imgsrc}"/></span>
    <div class="bj">
    <div class="c_lt">
    <div class="c_bl">
    <div class="c_br">
    <div class="c_rt">
    <p class="msg-text">{{html msg}}</p>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div style="clear:both"></div>
    </li>
    <li style="text-align:center; color:#888;">${time}</li>
    </ul>
    {{else}}
    <ul class="mine">
    <li class="i_fiv">
    <span><img src="<?php echo $logo ?>"/></span>
    <div class="mbj">
    <div class="mc_rt">
    <div class="mc_lt">
    <div class="mc_br">
    <div class="mc_bl">
    <p class="msg-text">{{html msg}}</p>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div style="clear:both"></div>
    </li>
    <li style="text-align:center; color:#888;">${time}</li>
    </ul>
    {{/if}}
</script>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/pap/jquery.coolautosuggest.js' ?>"></script>
<script type="text/javascript">
    messages = [];
    socket = io.connect('<?php echo Yii::app()->params['iosocketPath'] ?>');
    Yii_uploadUrl = '<?php echo F::uploadUrl(); ?>';

//下载附件
    $(".downfiles").live('click', function() {
        $('#fmpath').val($(this).attr('url'));
        $('#fmname').val($(this).text());
        $('#importform').form({
            url: Yii_baseUrl + '/upload/ftpdownload',
            success: function(data) {
                var result = eval('(' + data + ')');
                if (result.res == 0)
                    alert(result.msg)
            }
        });
        $('#importform').submit();
    });

//收到server的连接确认
    socket.on('open', function() {
        //改为登录样式
        $(".chaticon").addClass("chaton");
        //欢迎光临;
    });

//无连接确认
    socket.on('disconnect', function() {
        //改为离线样式
        $(".chaticon").removeClass("chaton");
        $('.i_mian').hide();
    });

//    socket.on('msgerror', function(msg) {
//        console.log('ss');
//    });

//监听system事件，判断welcome或者disconnect，打印系统消息信息
    socket.on('system', function(json) {
        var curuserid = <?php echo $userid; ?>;
        var sessionid = curuserid > json.touserid ? json.touserid + "_" + curuserid : curuserid + "_" + json.touserid;
        if (json.online == "noline") {
            $("#" + sessionid).addClass("noline");
        } else if (json.online == "online") {
            $("#" + sessionid).removeClass("noline");
        }
    });

//监听message事件，打印消息信息
    socket.on('privateMsg', function(json) {
        json.time = setDateTime(json.time * 1000);
        //判断聊天款是否存在
        if ($("#" + json.sessionid + "_box").length <= 0) {
            //提醒来电
            $(".chaton .msgs").show();
            //不存在则生成聊天框
            $("#SessionTemplate").tmpl({sessionid: json.sessionid, userid: "<?php echo $userid; ?>", touserid: json.touserid}).appendTo(".m_m");
            //判断用户是否在联系人列表中
            if ($("#" + json.sessionid).length <= 0) {
                $.getJSON(Yii_baseUrl + '/chat/getSessionid', {userid: "<?php echo $userid; ?>", touserid: json.touserid, status: 1}, function(data) {
                    var li = "<li class='active' id='" + data.sessionid + "' touserid='" + data.touserid + "'><img src='" + json.imgsrc + "'/><a title='" + json.imgsrc + "'>" + data.name + "</a></li>";
                    $('#chat-list').children('li').removeClass('active');
                    $('#chat-list').prepend(li);
                });
            }
        }
        //通知来消息了
        if ($("#" + json.sessionid + "_box").is(":hidden")) {
            //提醒来电
            $(".chaton .msgs").show();
            if ($("#" + json.sessionid).find("i").length > 0) {
                var num = parseInt($("#" + json.sessionid).find("i").text());
                num = num + 1;
                $("#" + json.sessionid).find("i").text(num);
            } else {
                $("#" + json.sessionid).append("<i>1</i>");
            }
        }
        //显示发送信息
        if (json.ftype == 0) {
            json.msg = htmlspecialchars(json.msg);
            json.msg = json.msg.replace(/\[em\/(\w+)\]/g, "<img src='" + Yii_uploadUrl + "Emoticons/$1.gif'/>");
            $("#chatTemplate").tmpl(json).appendTo("#" + json.sessionid + "_box .msgbox");
        } else {
            var filesrc = json.msg;
            json.msg = "";
            $("#chatTemplate").tmpl(json).appendTo("#" + json.sessionid + "_box .msgbox");
            if (json.ftype == 1) {
                $("<img src='" + Yii_uploadUrl + filesrc + "' title='" + json.fname + "'/>").appendTo(".record:last .msg-text");
            } else {
                $('<a url="' + filesrc + '" class="downfiles" style="text-decoration:underline" title="点击下载">' + json.fname + '</a>').appendTo(".record:last .msg-text");
            }
        }
        $('.message').scrollTop($('.message').find('div.msgbox').height() - $('.message').height());
    });

//监听离线消息时间
    socket.on("oldmessage", function(obj) {
        obj = eval("(" + obj + ")");
        if (obj.length > 0) {
            $(".chaton .msgs").show();
        }
        $(obj).each(function(index, msg) {
            //讲消息保存到本地记录
            messages.push(msg);
            //修改用户列表提醒
            $('#chat-list li').each(function(i, o) {
                if ($(o).attr("id") == msg.sessionid) {
                    if ($(o).find("i").length > 0) {
                        var num = parseInt($(o).find("i").text());
                        num = num + 1;
                        $(o).find("i").text(num);
                    } else {
                        $(o).append("<i>1</i>");
                    }
                }
            });
        });
    });
//        var count = parseInt($("#" + msg.sessionid + "_msg").text());
//        count = count + 1;
//        var message = {
//            sid: msg.sessionid,
//            name: msg.name,
//            time: msg.time,
//            msg: msg.msg
//        };
//        $("#" + msg.sessionid + "_msg").text(count);
//        messages.push(message);
//        hasmsg(msg.sessionid);
    $(function() {
        $('.chaticon>em').click(function() {
            $(this).next().toggle();
        });
        $('.i_mian li span').corner('30px');
        $('#chat-list li').live('click', function() {
            listclick(this);
        });
        $('.close').click(function() {
            $('.i_mian').hide();
        });
        $('.m_h').find('i').click(function() {
            $('.m_h').hide();
        });

        //机构搜索
        $("#searchorgan").coolautosuggest({
            url: Yii_baseUrl + '/chat/chatorgan?chars=',
            onSelected: function(res) {
                chooseChat(res);
            },
            onUpDown: function() {
            }
        });

        //回车发送消息
        $('.sendinput').live('keyup', function(e) {
            if (e.keyCode == 13) {
                sendMsg(this);
            }
        });

        //发送信息按钮
        $(".sendbtn").live('click', function(e) {
            sendMsg($(this).parents(".sendmsg").find("input"));
        });

        //发送文件按钮
        $(".pho").live('click', function() {
            $(this).find("input").click();
        });

        //文件上传
        $(".pho input").live('change', function() {
            $(this).next('input[name=path]').val("<?php echo 'privatechat' . '/' . Yii::app()->user->getOrganID() . '/' ?>");
            var form = $(this).parents('li.pho').parents('form');
            $(form).form('submit', {
                url: Yii_baseUrl + "/chat/uploadfile",
                onSubmit: function() {
                },
                success: function(data) {
                    data = eval('(' + data + ')');
                    //console.log(data);
                    if (data.code != 200) {
                        alert(data.msg);
                    } else {
                        var msg = {};
                        msg.fileurl = data.fileurl;
                        msg.ftype = data.ftype;
                        msg.filename = data.filename;
                        sendMsg($(form).parents(".sendmsg").find(".sendinput"), msg);
                    }
                }
            })
        });
    });

    function getSID(userid, touserid) {
        if (userid < touserid) {
            return userid + "_" + touserid;
        } else if (userid > touserid) {
            return touserid + "_" + userid;
        }
    }

//发送信息函数
    function sendMsg(input, file) {
        var touserid = $(input).attr("touserid");
        var sessionid = $(input).attr("sessionid");
        var userid = <?php echo $userid; ?>;
        var type = "";
        var msg = '';
        var fname = '';
        if (!file) {
            msg = $(input).val();
            type = 0;
        } else {
            msg = file.fileurl;
            type = file.ftype;
            fname = file.filename;
        }
        var time = Math.round(new Date().getTime() / 1000);
        var obj = {userid: userid, sessionid: sessionid, touserid: touserid, msg: msg, type: type, fname: fname, time: time, imgsrc: "<?php echo $logo; ?>"};
        socket.emit("message", obj);
        obj.time = setDateTime(obj.time * 1000);
        if (file) {
            obj.msg = "";
            $("#chatTemplate").tmpl(obj).appendTo("#" + sessionid + "_box .msgbox");
            if (type == 1) {
                $("<img src='" + Yii_uploadUrl + msg + "' title='" + fname + "'/>").appendTo(".mine:last .msg-text");
            } else {
                $('<a url="' + msg + '" class="downfiles" style="text-decoration:underline" title="点击下载">' + fname + '</a>').appendTo(".mine:last .msg-text");
            }
        } else {
            obj.msg = htmlspecialchars(obj.msg);
            obj.msg = obj.msg.replace(/\[em\/(\w+)\]/g, "<img src='" + Yii_uploadUrl + "Emoticons/$1.gif'/>");
            $("#chatTemplate").tmpl(obj).appendTo("#" + sessionid + "_box .msgbox");
        }
        $(input).val("");
        $('.message').scrollTop($('.message').find('div.msgbox').height() - $('.message').height());
    }

//选中聊天成员函数
    function chooseChat(obj) {
        var id = obj.id;
        var img = obj.img;
        var name = obj.name;
        var curuserid = <?php echo $userid; ?>;
        var sessionid = curuserid > id ? id + "_" + curuserid : curuserid + "_" + id;
        if ($('#' + sessionid).length <= 0) {
            var li = "<li class='active' id='" + sessionid + "' touserid='" + id + "'><img src='" + img + "'/><a title='" + name + "'>" + name + "</a></li>";
            $('#chat-list').children('li').removeClass('active');
            $('#chat-list').prepend(li);
            listclick(li);
        } else {
            listclick($('#' + sessionid));
        }
    }

//点击聊天列表函数
    function listclick(obj) {
        //关闭总提醒
        $(".chaton .msgs").hide();
        $(obj).addClass('active').siblings().removeClass('active');
        var name = $(obj).find('a').html();
        $('.m_m>h2').find('a').html(name);
        //移到顶部
        $(obj).siblings().appendTo(".contacts ul");
        //添加会话ID
        var sessionid = $(obj).attr("id");
        if ($("#" + sessionid + "_box").length > 0) {
            $(".m_m .chatbox").hide();
            $("#" + sessionid + "_box").show();
        } else {
            var touserid = $(obj).attr("touserid");
            $.getJSON(Yii_baseUrl + '/chat/getSessionid', {userid: "<?php echo $userid; ?>", touserid: touserid}, function(data) {
                $(".m_m .chatbox").hide();
                $("#SessionTemplate").tmpl(data).appendTo(".m_m");
                $("#" + sessionid + "_box").show();
                showOldMessage(data);
                //修改离线消息状态
                $.getJSON(Yii_baseUrl + '/chat/changeoldmessage?userid=' + <?php echo $userid; ?>, function(err, res, body) {
                });
            });
        }
        $(obj).find("i").remove();
    }

    //显示离线消息
    function showOldMessage(obj) {
        $(messages).each(function(index, message) {
            if (message.sessionid == obj.sessionid) {
                message.type = "receive";
                message.time = setDateTime(message.time * 1000);
                if (message.ftype == 0) {
                    message.msg = htmlspecialchars(message.msg);
                    message.msg = message.msg.replace(/\[em\/(\w+)\]/g, "<img src='" + Yii_uploadUrl + "Emoticons/$1.gif'/>");
                    $("#chatTemplate").tmpl(message).appendTo("#" + message.sessionid + "_box .msgbox");
                } else {
                    var filesrc = message.msg;
                    message.msg = "";
                    $("#chatTemplate").tmpl(message).appendTo("#" + message.sessionid + "_box .msgbox");
                    if (message.ftype == 1) {
                        $("<img src='" + Yii_uploadUrl + filesrc + "' title='" + message.fname + "'/>").appendTo(".record:last .msg-text");
                    } else {
                        $('<a url="' + filesrc + '" class="downfiles" style="text-decoration:underline" title="点击下载">' + message.fname + '</a>').appendTo(".record:last .msg-text");
                    }
                }
                $('.message').scrollTop($('.message').find('div.msgbox').height() - $('.message').height());
                messages = remove(messages, "sessionid", message.sessionid);
            }
        });
    }

    function remove(target, key, value) {
        return $.grep(target, function(cur, i) {
            return cur[key] != value;
        });
    }

//设置时间格式
    function setDateTime(obj) {
        var d;
        var t = '';
        if (obj != '' && obj != undefined) {
            d = new Date(obj);
        } else {
            d = new Date();
        }
        t += d.getFullYear() + '-';
        t += d.getMonth() < 9 ? '0' + (d.getMonth() + 1) + '-' : (d.getMonth() + 1) + '-';
        t += d.getDate() < 9 ? '0' + d.getDate() + ' ' : d.getDate() + ' ';
        t += d.getHours() < 9 ? '0' + d.getHours() + ':' : d.getHours() + ':';
        t += d.getMinutes() < 9 ? '0' + d.getMinutes() + ':' : d.getMinutes() + ':';
        t += d.getSeconds() < 9 ? '0' + d.getSeconds() : d.getSeconds();
        return t;
    }

//html标签转义
    function htmlspecialchars(str) {
        str = str.toString();
        str = str.replace(/&/g, '&amp;');
        str = str.replace(/"/g, '&quot;');
        str = str.replace(/'/g, "'");
        str = str.replace(/</g, '&lt;');
        str = str.replace(/>/g, '&gt;');
        return str;
    }
</script>