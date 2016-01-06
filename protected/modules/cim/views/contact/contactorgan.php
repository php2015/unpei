
<table  style="height:20%;width:400px">
    <thead >
        <tr style="padding-left:20px">
            <td>机构类型</td>
            <td>机构名称</td>
            <td>选择</td>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($organ) && !empty($organ)) { ?>
            <?php foreach ($organ as $val): ?>
                <tr>
                    <td><?php 
            
                       switch ($val['Identity'])
                       {
                           case 1:
                              echo '生产商';
                               break;
                           case 2:
                               echo '经销商';
                               break;
                           case 3:
                               echo '服务店';
                               break;
                       }
                    ?></td>
                    <td name="organname"><?php echo isset($val['OrganName'])?$val['OrganName']:'';?></td>
                    <td><input type="button" class="opt" value="选择" key="<?php echo $val['ID']?>"></td>
                </tr>
            <?php endforeach; ?>
        <?php }else { ?>
            <tr>
                <td colspan="3" align="center">无数据</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script type="text/javascript">
$('.opt').live('click',function(){
    var organname=$(this).parents('tr').find('td[name=organname]').html();
    var organID=$(this).attr('key');
    $('#oname').val(organname);
    $('#OID').val(organID);
    $('#organdialog').dialog('close');
})
 </script>