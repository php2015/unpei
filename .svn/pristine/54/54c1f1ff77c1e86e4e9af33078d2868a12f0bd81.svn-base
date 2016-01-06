<style>
    .slide1{display:inline}
    .slide2{display:none} 
    .xjdinfo{padding-bottom:10px;clear:both}
    .desc img{max-width:700px;height:200px}
</style>
<?php
$baseinfo = $inqres['baseinfo'];
$files = $inqres['files'];
$parts = $inqres['parts'];
?>
<div class="bor_back m-top" style="height:auto;">
    <p class="txxx" id="clickp">
        询价单信息
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px" id="slide">
            <span id="up" class="slide1"><img src="<?php echo Yii::app()->baseUrl . '/themes/default/images/sanjiao2.png'; ?>"></span>
            <span id="down" class="slide2"><img src="<?php echo Yii::app()->baseUrl . '/themes/default/images/daosanjiao2.png'; ?>"></span>
        </span>
    </p>
    <div id="slidediv" <?php if ($type == 1) echo 'style="display:none"'; ?>>
        <div class="m-top">
            <div class="xjdinfo m-top">
                <p style="padding-left:50px;"><b>来源</b></p> 
                <div style="padding-top:10px;margin-left:75px;word-break:break-all;"><p><?php if($baseinfo['State']==1) echo '嘉配客服代发'; else echo $inqres['service']['OrganName'];?></p></div>
            </div>
            <p style="padding-left:25px;"><b>车型信息</b></p>
            <ul class="m-top5">                
                <li style="width:90%;padding-left:5px;margin-left:70px; float:left;line-height:30px;">适用车系：
                    <span>
                        <?php echo!empty($baseinfo['mname']) ? $baseinfo['mname'] : '全厂家'; ?>
                        <?php echo!empty($baseinfo['sname']) ? $baseinfo['sname'] : '全车型'; ?>
                        <?php echo!empty($baseinfo['yname']) ? $baseinfo['yname'] : '全年款'; ?>
                        <?php echo!empty($baseinfo['cname']) ? $baseinfo['cname'] : '全车系'; ?>
                    </span>
                </li>
                <?php if ($baseinfo['VIN'] != ''): ?>
                    <li style="margin-left:70px;padding-left:5px;">VIN码定位：
                        <span>
                            <?php echo $baseinfo['VIN']; ?>
                        </span>
                    </li>
                <?php endif; ?>
                <div style="clear:both"></div>
            </ul>
        </div>
        <div class="xjdinfo m-top">
            <p style="padding-left:25px;"><b>采购描述</b></p> 
            <div style="padding-top:10px;margin-left:75px;word-break:break-all;" class="desc"><p><?php echo!empty($baseinfo['Describe']) ? $baseinfo['Describe'] : '无'; ?></p></div>
        </div>

        <?php if (!empty($files)): ?>
            <div class="xjdinfo">
                <p style="padding-left:25px;"><b>附件</b></p>
                <?php $this->renderPartial('gellerira', array('imsgs' => $files)) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($parts)): ?>
            <div class="xjdinfo m-top">
                <p style="padding-left:25px;"><b>配件信息</b></p> 
                <div style="margin-left:75px;margin-top: 10px">
                    <?php
                    $this->widget('widgets.default.WGridView', array(
                        'id' => 'partslist',
                        'dataProvider' => $parts,
                        'columns' => array(
                            array(
                                'class' => 'CCheckBoxColumn',
                                'headerHtmlOptions' => array('width' => '33px'),
                                'checkBoxHtmlOptions' => array('name' => 'selectparts'),
                                'selectableRows' => '1',
                                'value' => '$data[ID]',
                                'visible' => $checkbox == 1
                            ),
                            array(
                                'name' => '大类',
                                'value' => '$data[MainCategory]'
                            ),
                            array(
                                'name' => '子类',
                                'value' => '$data[SubCategory]'
                            ),
                            array(
                                'name' => '标准名称',
                                'value' => '$data[LeafCategory]'
                            ),
                            array(
                                'name' => '数量',
                                'value' => '$data[Number]'
                            ),
                        )
                    ))
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>



<script>
    $(function(){        
        var content=$('.content2').height();
        var sch=$('#slidediv').height();
        var type="<?php echo $type; ?>";
        $('#partslist [class=pager]').remove();
        if(type==1)
        {
            //隐藏
            //$('#slidediv').hide();
            $('#up').addClass('slide2');
            $('#down').toggleClass('slide2');
            $('#content_left').height(content-sch);
        }else{
            //显示
            $('#content_left').height(content);
        }
        $('#slide').click(function(e){
            e.stopPropagation();
            $('#slidediv').slideToggle(500);
            $('#down').toggleClass('slide2');
            if($('#up').css("display") =="inline")
            {
                //隐藏
                $('#up').attr('class','');
                $('#up').addClass('slide2');
                $('#content_left').height(content-sch);
            }    
            else
            {
                //显示
                $('#up').attr('class','');
                $('#up').addClass('slide1');
                $('#content_left').height(content);
            }  
        })
        $('#clickp').click(function(){
            $('#slide').trigger('click');
        })
    })
</script>