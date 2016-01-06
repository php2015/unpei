<style>
     .key-active{ width:920px;margin:0 auto; border:1px solid #ebebeb; background: #fff; padding: 20px;min-height:450px }
</style>
<div class='width998 content-row home-row auto_height bd1 key-active'>
    <?php $this->renderPartial('activehead');?>
    <div>
        <p style="text-align: center;margin-top: 100px;line-height:24px;font-size: 12px">您是否现在想要继续完善员工账号及权限设置,点击<a href="<?php echo Yii::app()->createUrl('/member/employee/index');?>">员工账号管理</a>或<a href="<?php echo Yii::app()->createUrl('/member/permission/index');?>">权限设置</a>将为您跳转;</p>
        <p style="text-align: center;line-height:24px;font-size: 12px"> 否则&nbsp;<span id='num'style="color:#FB7722;font-weight: bold">5</span>&nbsp;秒之后将直接为您跳转至由你配平台首页;</p>
    </div>
</div>
<?php
if(Yii::app()->user->isServicer()){
    $url=Yii::app()->createUrl('/pap/home/index');
}elseif(Yii::app()->user->isDealer()){
    $url=Yii::app()->createUrl('/pap/sellerorder/index');
}
?>
<script>
    var url='<?php echo $url;?>'
     function jump(count) {
            window.setTimeout(function(){
                count--;
                if(count > 0) {
                    $('#num').text(count);
                    jump(count);
                } else {
                    location.href=url;
                }
            }, 1000);
        }
        jump(5);
</script>
