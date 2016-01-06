<?php echo $this->renderPartial('tabs_active_contacts'); ?>
<div class="easyui-layout" id="jp-layout" style="height:500px;">
    <table id="dgconta"  class="easyui-datagrid" 
           data-options="rownumbers:true,
           region:'center',
           pagination:true,
           singleSelect:false,
           method:'get',
           url:'<?php echo Yii::app()->createUrl('cim/contact/sharecontact') ?>',
           toolbar:'#toolbarconta'" style="height: 500px">
        <thead>
            <tr>
                <th data-options="field:'ck',checkbox:true"></th>
                <th field="Initiator" width="120">发起方</th>
                <th field="companyname2" width="120">机构名称</th>
                <th field="customercategory" width="50">客户类别</th>
                <th field="cooperationtype" width="80">合作类型</th>                
                <!--<th field="customertype" width="60">客户类型</th>-->
                <th field="name" width="80">客户姓名</th>
                <th field="sex" width="50">性别</th>
                <th field="phone" width="100">联系电话</th>
                <th field="jiapart_ID" width="80">嘉配ID</th>
                <th field="address" width="120">地址</th>
                <th field="email" width="100">邮箱</th>
                <th field="weixin" width="80">微信号</th>
                <th field="QQ" width="80">QQ号</th>
            </tr>
        </thead>
    </table>
</div>
<div id="toolbarconta">
    <div style="padding-left:12px;">
        <p class="form-row">
            客户姓名: <input  class="width78 input " type="text" id='name'>&nbsp;
            联系电话: <input class="width78 input "  type="text" id="phone">&nbsp;
            关键词(机构名称): <input class="width78 input " type="text" id="keyword" >&nbsp;
            <a href="javascript:void(0)" class="btn-green" iconCls="icon-search" id="search-btn">查询</a>
        </p>
    </div>
</div>
<script type="text/javascript">

    $('#search-btn').click(function(){
        var url= Yii_baseUrl + "/cim/contact/sharecontact";
        var name = $('#name').val().toString();
        var phone = $('#phone').val();
        var keyword= $("#keyword").val();
        $('#dgconta').datagrid({ url:url,queryParams:{
                'name':name,
                'phone':phone,
                'keyword':keyword
               
            },method:"post"});
    });
</script>