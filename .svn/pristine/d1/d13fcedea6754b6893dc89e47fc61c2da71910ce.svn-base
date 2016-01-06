/**
 * 
 */

 function empower(val){
 	var param=new Array();
 	var data=new Object;
	data.id=val.id;
	data.text=val.text;
	data.nickname=val.nickname;
	data.sex=val.sex;
	data.iconCls='icon-employee';
	var parent=$('#userrolerel').tree('getRoot');
	param['parent']=parent.target;
	param['data']=data;
    $('#userrolerel').tree('append',param);
 }
 $(document).ready(function(){
 	$("#manegelist").tree({
 		url:Yii_baseUrl + "/member/jurisdiction/getroles",
 		onClick:function(node){
 			$("#rolename").val(node.text);
                        $("#rolename").validatebox('validate');
			$("#describe").val(node.Describe);
			$("#jurisdiction").val(node.Jurisdiction);
			$("#roleid").val(node.id);
			var roots=$('#menutree').tree('getRoots');
			if($('#menutree').tree('isLeaf',roots.target)){
				var nodes=$('#menutree').tree('getChildren');
				//判断选中的角色是否有权限
				if(node.Jurisdiction!=null&&node.Jurisdiction.length>0){
					var jurisdiction=node.Jurisdiction.substring(0,node.Jurisdiction.length-1)
					var array = jurisdiction.split(",");
					$.each(nodes,function(key,val){
						if($.inArray(val.id,array)>=0){
							$("#menutree").tree("check",val.target);
						}else{
							$("#menutree").tree("uncheck",val.target);
						}
					});
				}else{
					var checked=$("#menutree").tree("getChecked");
					$.each(checked,function(key,val){
						$("#menutree").tree("uncheck",val.target);
					});
				}
			}else{
				if(node.Jurisdiction!=null&&node.Jurisdiction.length>0){
					var jurisdiction=node.Jurisdiction.substring(0,node.Jurisdiction.length-1)
					var array = jurisdiction.split(",");
					if($.inArray(roots.id,array)>=0){
						$("#menutree").tree("check",roots.target);
					}else{
						$("#menutree").tree("uncheck",roots.target);
					}
				}else{
					$("#menutree").tree("uncheck",roots.target);
				}
			}
 		}
 	});
	$("#menutree").tree({
		url:Yii_baseUrl + "/member/jurisdiction/getmenu", 
		checkbox:true
	});
	$("#addroles").click(function(){
		var root=$('#manegelist').tree('getRoot');
		$('#manegelist').tree('select',root.target);
		$("#rolename").val("");
                $("#rolename").validatebox('validate');
		$("#describe").val("");
		$("#jurisdiction").val("");
		$("#roleid").val("");
		var checked=$("#menutree").tree("getChecked");
		$.each(checked,function(key,val){
			$("#menutree").tree("uncheck",val.target);
		});
	});
	$(".icon-save").click(function(){
		if($("#roleform").is(":visible")){
                        $("#saves").linkbutton("disable");
			var checked=$("#menutree").tree("getCheckedExt");
			if(checked.length>0){
				var menuids='';
				$.each(checked,function(key,val){
					menuids=menuids+val.id+',';
				});
				$("#jurisdiction").val(menuids);
			}else{
				$("#jurisdiction").val("");
			}
                        var roleID= $("#roleid").val();
                        var rolename= $("#rolename").val();
                        $.getJSON(Yii_baseUrl+'/member/jurisdiction/checkrole',{
                            rolename:rolename,
                            roleID:roleID
                        },function(result){
                            if(result.result){
                                $('#roleform').submit();
                            }else{
                                $.messager.alert('提示', result.message, 'info');
                                $("#saves").linkbutton("enable");
                            }
                        });
		}else if($("#allocform").is(":visible")){
                        $("#saves").linkbutton("disable");
			var userids='';
			var userroot=$("#userrolerel").tree('getRoot');
			if(!$('#userrolerel').tree('isLeaf',userroot.target)){
				var userchildrens=$("#userrolerel").tree('getChildren',userroot.target);
				$.each(userchildrens,function(key,val){
					userids=userids+val.id+',';
				});
			}
			$("#allocuserid").val(userids);
			$('#allocform').submit();
		}else if($("#userroleform").is(":visible")){
                        $("#saves").linkbutton("disable");
			var roleids='';
			var roleroot=$("#userrolelist").tree('getRoot');
			if(!$('#userrolelist').tree('isLeaf',roleroot.target)){
				var rolechildrens=$("#userrolelist").tree('getChildren',roleroot.target);
				$.each(rolechildrens,function(key,val){
					if(val.checked){
						roleids=roleids+val.id+',';
					}
				});
			}
			$("#roleids").val(roleids);
			$('#userroleform').submit();
		}
	});
	$('#roleform').form({
            onSubmit:function(){
                if($('#roleform').form('validate')){
                    return true;
                }else{
                    $("#saves").linkbutton("enable");
                    return false;
                }
            },
	    success:function(data){   
                $("#saves").linkbutton("enable");
		data=eval('('+data+')'); 
	        $.messager.alert('提示', data.message, 'info'); 
	        if($("#roleid").val()==""||$("#roleid").val()==0||!$("#roleid").val()){ 
                        $("#manegelist").tree("reload");
                        $("#alloclist").tree("reload");
                        $("#userrolelist").tree("reload");
	        }else{
                        $('#manegelist').tree({
                            url:Yii_baseUrl + "/member/jurisdiction/getroles",
                            onLoadSuccess:function(){
                                 var depart=$('#manegelist').tree('find',$("#roleid").val());
                                  $('#manegelist').tree('select',depart.target);
                            }
                        });
                        $("#alloclist").tree("reload");
                        $("#userrolelist").tree("reload");
		    }
	    }    
	}); 
	$("#removeroles").click(function(){
                $("#removeroles").linkbutton("disable");
		var select=$("#manegelist").tree("getSelected");
		if(select){
			if(select.id==0){
				$.messager.alert('提示', '根节点不可删除！', 'info'); 
                                $("#removeroles").linkbutton("enable");
			}else{
				$.messager.confirm('提示框', '您确定要删除吗?',function(result){
                                    if(result){
					$.getJSON(Yii_baseUrl+'/member/jurisdiction/delrole',{roleid:select.id},function(result){
						$("#removeroles").linkbutton("enable");
                                                if(result>0){
                                                    $.messager.alert('提示', "删除成功！", 'info'); 
                                                    $("#manegelist").tree("remove",select.target);
                                                    var allocres=$("#alloclist").tree("find",select.id);
                                                    $("#alloclist").tree("remove",allocres.target);
                                                    var userres=$("#userrolelist").tree("find",select.id);
                                                    $("#userrolelist").tree("remove",userres.target);
                                                    $("#rolename").val("");
                                                    $("#describe").val("");
                                                    $("#jurisdiction").val("");
                                                    $("#roleid").val("");
                                                    var checked=$("#menutree").tree("getChecked");
                                                    $.each(checked,function(key,val){
                                                            $("#menutree").tree("uncheck",val.target);
                                                    });
						}else{
                                                    $.messager.alert('提示', "删除失败！", 'info');
						}
					});
                                    }
				})
			}
		}else{
			$.messager.alert('提示', '请选择需要删除的角色！', 'info'); 
                        $("#removeroles").linkbutton("enable");
		}
	});
	$("#departID").tree({
		url:Yii_baseUrl + '/member/employee/getmenu'
	});
	$("#userrolerel").tree({
		url:Yii_baseUrl + '/member/jurisdiction/userrolerel'
	});
	$("#alloclist").tree({
		url:Yii_baseUrl + "/member/jurisdiction/getroles",
		onClick:function(node){
			$("#allocroleid").val(node.id);
			$("#userrolerel").tree({
				url:Yii_baseUrl + '/member/jurisdiction/userrolerel/roleid/'+node.id
			});
		}
	});
	$("#empow").click(function(){
		var roleselect=$("#alloclist").tree("getSelected");
		if(roleselect){
			var select=$("#departID").tree("getSelected");
			if(select){
				var array=new Array();
				var userroot=$("#userrolerel").tree('getRoot');
				if(!$('#userrolerel').tree('isLeaf',userroot.target)){
					var userchildrens=$("#userrolerel").tree('getChildren',userroot.target);
					$.each(userchildrens,function(key,val){
						array.push(val.id);
					});
				}
				if(!$('#departID').tree('isLeaf',select.target)){
					var childrens=$("#departID").tree('getChildren',select.target);
					$.each(childrens,function(key,val){
						if(val.type==1){
							if(array.length==0){
								empower(val);
							}else{
								if($.inArray(val.id,array)<0){
									empower(val);
								}
							}
						}
					});
				}else{
					if(select.type==1){
						if(array.length==0){
							empower(select);
						}else{
							if($.inArray(select.id,array)<0){
								empower(select);
							}
						}
					}
				}
			}else{
				$.messager.alert('提示','请选择需要关联的员工！','info');
			}
		}else{
			$.messager.alert('提示','请选择关联的角色！','info');
		}
	});
	$("#allempow").click(function(){
		var roleselect=$("#alloclist").tree("getSelected");
		if(roleselect){
			var array=new Array();
			var userroot=$("#userrolerel").tree('getRoot');
			if(!$('#userrolerel').tree('isLeaf',userroot.target)){
				var userchildrens=$("#userrolerel").tree('getChildren',userroot.target);
				$.each(userchildrens,function(key,val){
					array.push(val.id);
				});
			}
			var root=$("#departID").tree('getRoot');
			if(!$('#departID').tree('isLeaf',root.target)){
				var childrens=$("#departID").tree('getChildren',root.target);
				$.each(childrens,function(key,val){
					if(val.type==1){
						if(array.length==0){
							empower(val);
						}else{
							if($.inArray(val.id,array)<0){
								empower(val);
							}
						}
					}
				});
			}
		}else{
			$.messager.alert('提示','请选择关联的角色！','info');
		}
	});
	$("#return").click(function(){
		var roleselect=$("#alloclist").tree("getSelected");
		if(roleselect){
			var select=$("#userrolerel").tree("getSelected");
			if(select){
				if(!$('#userrolerel').tree('isLeaf',select.target)){
					var userchildrens=$("#userrolerel").tree('getChildren',select.target);
					$.each(userchildrens,function(key,val){
						$('#userrolerel').tree('remove',val.target);
					});
				}else{
					if(select.id!=0){
						$('#userrolerel').tree('remove',select.target);
					}
				}
			}else{
				$.messager.alert('提示','请选择需要取消的员工！','info');
			}
		}else{
			$.messager.alert('提示','请选择关联的角色！','info');
		}
	});
	$("#allreturn").click(function(){
		var roleselect=$("#alloclist").tree("getSelected");
		if(roleselect){
			var userroot=$("#userrolerel").tree('getRoot');
			if(!$('#userrolerel').tree('isLeaf',userroot.target)){
				var userchildrens=$("#userrolerel").tree('getChildren',userroot.target);
				$.each(userchildrens,function(key,val){
					$('#userrolerel').tree('remove',val.target);
				});
			}
		}else{
			$.messager.alert('提示','请选择关联的角色！','info');
		}
	});
	$('#allocform').form({
            onSubmit:function(){
                if($('#allocform').form('validate')){
                    return true;
                }else{
                    $("#saves").linkbutton("enable");
                    return false;
                }
            },
	    success:function(data){   
                $("#saves").linkbutton("enable");
	        $.messager.alert('提示', eval('('+data+')'), 'info'); 
	    }    
	}); 
	$('#urdepartID').tree({
		url:Yii_baseUrl + '/member/employee/getmenu',
		onClick:function(node){
			if(node.type==1){
				$.getJSON(Yii_baseUrl + '/member/jurisdiction/getuserroles',{userid:node.id},function(result){
					var roleids='';
					if(result.length>0){
//						result=eval('('+result+')');
						var root=$("#userrolelist").tree('getRoot');
						if(!$('#userrolerel').tree('isLeaf',root.target)){
							var checked=$("#userrolelist").tree("getChildren");
							var array=new Array();
							$.each(result,function(key,val){
								array.push(val.RoleID);
							});
							$.each(checked,function(key,val){
								if($.inArray(val.id,array)>=0){
									$("#userrolelist").tree("check",val.target);
									roleids=roleids+val.id+',';
								}else{
									$("#userrolelist").tree("uncheck",val.target);
								}
							});
						}
					}else{
						var checked=$("#userrolelist").tree("getChecked");
						$.each(checked,function(key,val){
							$("#userrolelist").tree("uncheck",val.target);
						});
					}
					$("#roleids").val(roleids);
				});
				$("#username").html(node.username);
				$("#userid").val(node.id);
			}else{
				$("#username").html("");
				var checked=$("#userrolelist").tree("getChecked");
				$.each(checked,function(key,val){
					$("#userrolelist").tree("uncheck",val.target);
				});
				$("#roleids").val("");
				$("#userid").val("");
			}
		}
	});
	$('#userrolelist').tree({
		url:Yii_baseUrl + "/member/jurisdiction/getroles",
		checkbox:true,
		onClick:function(node){
			if(node.Jurisdiction){
				$('#authtree').tree({
					url:Yii_baseUrl + "/member/jurisdiction/getmenu/roleid/"+node.id
				});
			}else{
				var root=$('#authtree').tree('getRoot');
				$('#authtree').tree('remove',root.target);
			}
		}
	});
	$('#userroleform').form({
            onSubmit:function(){
                if($('#userroleform').form('validate')){
                    return true;
                }else{
                    $("#saves").linkbutton("enable");
                    return false;
                }
            },
	    success:function(data){   
                $("#saves").linkbutton("enable");
	        $.messager.alert('提示', eval('('+data+')'), 'info'); 
	    }    
	});
        $("#ttabs").tabs({
            onSelect:function(title){
                if(title!="角色管理"){
                    $("#addroles").linkbutton("disable");
                    $("#removeroles").linkbutton("disable");
                }else{
                    $("#addroles").linkbutton("enable");
                    $("#removeroles").linkbutton("enable");
                }
            }
        });
})