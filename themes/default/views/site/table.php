<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body,table{
        font-size:13px;
}
table{
        table-layout:fixed;
        empty-cells:show; 
        border-collapse: collapse;
        margin:0 auto;
  border:1px solid #cad9ea;
}
th{
        height:22px;
  font-size:13px;
  font-weight:bold;
  background-color:#CCCCCC;
  text-align:center;
}
td{
        height:20px;
}
.tableTitle{font-size:14px; font-weight:bold;}

</style>
<title>zuizen数据库结构</title>
</head>

<body>
<div style="margin:0 auto;width:880px; border:1px #006600 solid; font-size:12px; line-height:20px;">
  <div style="width:100%;height:30px; font-size:16px; font-weight:bold; text-align:center;">
  **网数据库结构<br />
  <font style="font-size:14px; font-weight:normal;"><?php echo date("Y-m-d h:i:s"); ?></font>
  </div>
 
    
  <div style="margin:0 auto; width:100%; padding-top:10px;">
    <b class="tableTitle">表名：</b> <br />
   
  </div>  
  <table width="100%" border="1">
    <thead>
      <th width="170">字段名</td>
      <th width="140">字段类型</td>
      <th width="70">默认值</td>
      <th>备注</td>
    </thead>
    <?php
    foreach($res as $key=>$row2)
    {
    ?>  
    
    <tr>
      <td><?php echo $row2["COLUMN_NAME"] ?></td>
      <td><?php echo $row2["DATA_TYPE"] ?></td>
      <td align="center"><?php echo $row2["COLUMN_DEFAULT"] ?></td>
      <td><?php echo $row2["COLUMN_COMMENT"] ?></td>
    </tr>
    <?php
    }
    ?>
  </table>
 

</div>
</body>
</html>

