<style>
  .smalllm:last-child{border:none}  
</style> 
<p class="dh_lm">全部配件品类</p>  
    <div class="dh_info" style="height:1253px">
        <div class="dh_xq">
            <?php if(isset($MainCategory)){?>
            <?php foreach($MainCategory as $val):?>
            <div>
                <p class="biglm"><?php echo isset($val['Name'])?$val['Name']:''?></p>
                <div class="smalllm" >
                    <?php foreach($val['children'] as $v):?>
                 
                    <ul style="padding-bottom:0px">
                        <li ><a href="<?php echo Yii::app()->createUrl('pap/mall/index',array('sub'=>$v['ID']))?>" target="_blank" class="modelrequired"><?php echo $v['Name']?></a></li>  
                    </ul>
                       <?php endforeach;?>
           
                    <div style="clear:both; height:10px"></div>
                </div>
   
            </div>
            <?php endforeach;}else{?>
             <div>
               无数据
            </div>
            <?php }?>
    </div>
    </div>

