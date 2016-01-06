/**
 * 子账户管理
 */
$(document).ready(function() {
    $("#coverageTree .bumen").live('click', function() {
        $("#coverageTree .bumen").removeClass("ren_current");
        $("#coverageTree .ren").removeClass("ren_current");
        $(this).addClass("ren_current");
        $(".bmxx_info").css("display", "block");
        $(".ygxx_info").css("display", "none");
        $(".hyzx_lm2 span").text("部门信息");

        $.post(
                Yii_baseUrl + "/member/employee/getDepart/",
                {id: $(this).parent().parent().attr('id')},
        function(result) {
            data = eval("(" + result + ")");
            if (data.ParentID == 0) {
                data.ParentName = "";
            }
            $("#DepartmentName").text(data.DepartmentName);
            $("#ParentID").text(data.ParentName);
            $("#Describe").text(data.Describe);
            //修改内容
            $("#editDepartmentName").val(data.DepartmentName);
            $("#editParentID").val(data.ParentID);
            $("#editDescribe").val(data.Describe);
            $("#departID").val(data.ID);
            $('#del').attr('href', Yii_baseUrl + "/member/employee/deldepart/id/" + data.ID);
        });
    });

    $("#coverageTree .ren").live('click', function() {
        $("#coverageTree .bumen").removeClass("ren_current");
        $("#coverageTree .ren").removeClass("ren_current");
        $(this).addClass("ren_current");
        $(".bmxx_info").css("display", "none");
        $(".ygxx_info").css("display", "block");
        $(".hyzx_lm2 span").text("员工信息");

        $.post(
                Yii_baseUrl + "/member/employee/getEmploy/",
                {id: $(this).parent().parent().attr('id')},
        function(result) {
            data = eval("(" + result + ")");
            if (!data.JobNum)
                data.JobNum = "";
            if (!data.Job)
                data.Job = "";
            if (!data.Phone)
                data.Phone = "";
            if (!data.TelPhone)
                data.TelPhone = "";
            if (!data.Email)
                data.Email = "";
            if (!data.Remark)
                data.Remark = "";
            $('#Name').text(data.Name);
            $('#Birth').text(data.Birth);
            $('#UserName').text(data.UserName);
            //$('#password').text(data.PassWord);
            $('#ExpireTime').text(data.ExpireTime);
            $('#JobNum').text(data.JobNum);
            $('#DepartmentID').text(data.Status);
            $('#Sex').text(data.Sex);
            $('#Job').text(data.Job);
            $('#Phone').text(data.Phone);
            $('#TelPhone').text(data.TelPhone);
            $('#Email').text(data.Email);
            $('#Remark').text(data.Remark);
            //修改内容
            $('#editName').val(data.Name);
            $('#editBirth').val(data.Birth);
            $('#editUserName').val(data.UserName);
            $('#editPassWord').val(data.PassWord);
            $('#editExpireTime').val(data.ExpireTime);
            $('#editJobNum').val(data.JobNum);
            $('#editDepartmentID').val(data.DepartmentID);
            $('#editSex').val(data.Sex);
            $('#editJob').val(data.Job);
            $('#editPhone').val(data.Phone);
            $('#editTelPhone').val(data.TelPhone);
            $('#editEmail').val(data.Email);
            $('#editRemark').val(data.Remark);
            $('#employID').val(data.ID);
            $('#del').attr('href', Yii_baseUrl + "/member/employee/delemploy/id/" + data.ID);
        });
    });

    //修改
    $(".revise").live('click', function() {
        $(".name").css("display", "none");
        $(".editor").css("display", "inline-block");
        $(".editor_save").css("display", "block");
        $("#edit").css("display", "none");
    })
    /*删除*/
    $("#del").live('click', function() {
        if ($(this).attr('href') == "") {
            alert("请选择要删除的部门或员工！");
            return false;
        }
        if ($(".ren_current").attr('key') == 0) {
            if (typeof ($(".ren_current").parent().parent().find('ul li:first').attr('id')) != "undefined") {
                alert("部门下还有信息，不能删除！");
                return false;
            }
        }
        if (!confirm('确定要删除吗？'))
            return false;
    });

    /*取消*/
    $(".button3").live('click', function() {
        $(".name").css("display", "inline-block");
        $(".editor").css("display", "none");
        $(".editor_save").css("display", "none");
        $("#edit").css("display", "block");
    });

    /*
     * 点击添加部门
     */
    $("#tjbm").live('click', function() {
        $(".bmxx_info").css("display", "block");
        $(".ygxx_info").css("display", "none");
        $(".hyzx_lm2 span").text("部门信息");
        $(".name").css("display", "none");
        $(".editor").css("display", "inline-block");
        $(".editor_save").css("display", "block");
        $("#edit").css("display", "none");
        $("#editDepartmentName").val("");
        $("#editParentID").val("");
        $("#editDescribe").val("");
        $("#departID").attr("value", "");
        $('#del').attr('href', "#");
    });

    /*
     * 点击添加员工
     */
    $("#tjyg").live('click', function() {
        $(".bmxx_info").css("display", "none");
        $(".ygxx_info").css("display", "block");
        $(".hyzx_lm2 span").text("员工信息");
        $(".name").css("display", "none");
        $(".editor").css("display", "inline-block");
        $(".editor_save").css("display", "block");
        $("#edit").css("display", "none");
        $('#editName').val("");
        $('#editBirth').val("");
        $('#editUserName').val("");
        $('#editPassWord').val("");
        $('#editExpireTime').val("");
        $('#editJobNum').val("");
        $("#editDepartmentID option:first").attr("selected", 'selected');
        $('#editJob').val("");
        $('#editPhone').val("");
        $('#editTelPhone').val("");
        $('#editEmail').val("");
        $('#editRemark').val("");
        $('#editSex').val("");
        $('#employID').val("");
        $('#del').attr('href', "#");
    });

    /*
     * 保存部门信息
     */
    $("#savedepart").live('click', function() {
        var ajaxCallUrl = Yii_baseUrl + "/member/employee/editdepart";
        if ($("#editDepartmentName").val() == "") {
            alert("部门名称不能为空");
            return false;
        }
        $.ajax({
            cache: true,
            type: "POST",
            url: ajaxCallUrl,
            dataType: 'json',
            data: $("#department_form").serialize(), // 你的formid
            async: false,
            error: function(request) {
                alert("系统错误：请刷新后再提交！");
            },
            success: function(data) {
                if (data.result) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    });

    /*
     * 保存员工信息
     */
    $("#saveempoly").live('click', function() {
        var ajaxCallUrl = Yii_baseUrl + "/member/employee/editemploy";
        if ($("#editDepartmentID").val() == null) {
            alert("请选择所属部门！");
            return false;
        }
        if ($("#editName").val() == "") {
            alert("姓名不能为空！");
            return false;
        }
        if ($("#editName").val().length < 2 || $("#editName").val().length > 20) {
            alert("姓名长度在2-20之间！");
            return false;
        }
        if ($("#editUserName").val() == "") {
            alert("用户名不能为空！");
            return false;
        }
        if (!/^[A-Za-z0-9_]+$/g.test($('#editUserName').val())) {
            alert("用户名必须为字母或数字！");
            return false;
        }
        if ($("#editUserName").val().length < 3 || $("#editUserName").val().length > 20) {
            alert("用户名长度在3-20之间！");
            return false;
        }
        if ($("#editPassWord").val() == "") {
            alert("密码不能为空！");
            return false;
        }
        if ($("#editPassWord").val().length < 6 || $("#editPassWord").val().length > 20) {
            if ($("#editPassWord").val().length != 32) {
                alert("密码长度在6-20之间！");
                return false;
            }
        }
        if ($("#editEmail").val() == "") {
            alert("电子邮箱不能为空！");
            return false;
        }
        if (!$("#editEmail").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
            alert("邮箱格式不正确");
            //$("#confirmMsg").html("<font color='red'>邮箱格式不正确！请重新输入！</font>");
            $("#editEmail").focus();
            return false;
        }
        $.ajax({
            cache: true,
            type: "POST",
            url: ajaxCallUrl,
            data: $("#empolyees_form").serialize(), // 你的formid
            async: false,
            dataType: 'json',
            error: function(request) {
                alert("系统错误：请刷新后再提交！");
            },
            success: function(data) {
                if (data.result) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    });

    /*
     * 输入框失去焦点事件
     */
    $("#editPhone").blur(function() {
        if ($("#editPhone").val() != "" && !$("#editPhone").val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)) {
            alert("请正确填写手机号码，例如:13415764179");
            $(this).addClass("input1");
        } else {
            $(this).removeClass("input1");
        }
    });
    $("#editTelPhone").blur(function() {
        if ($("#editTelPhone").val() != "" && !$("#editTelPhone").val().match(/^((0\d{2,3})-)?(\d{7,8})((\d{3}))?$/)) {
            alert("请正确填写办公电话，例如:027-4816048");
            $(this).addClass("input1");
        } else {
            $(this).removeClass("input1");
        }
    });
    $("#editRemark").blur(function() {
        if ($(this).val().length < 26) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editJob").blur(function() {
        if ($(this).val().length < 11) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editJobNum").blur(function() {
        if ($(this).val().length < 11) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editDepartmentName").blur(function() {
        if ($(this).val().length > 2 && $(this).val().length < 20) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editName").blur(function() {
        if ($(this).val().length > 2 && $(this).val().length < 20) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editUserName").blur(function() {
        if ($(this).val().length >= 2 && $(this).val().length < 20) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editPassWord").blur(function() {
        if ($(this).val().length > 2) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
    $("#editEmail").blur(function() {
        if ($(this).val().length > 2 && $(this).val().length < 20) {
            $(this).removeClass("input1");
        } else {
            $(this).addClass("input1");
        }
    });
})