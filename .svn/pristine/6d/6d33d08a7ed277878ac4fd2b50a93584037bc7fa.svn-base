<style>
    #makesearch_div tr:hover {
        background-color: white;
    }
    #makesearch_div .th_organ img {
        display: inline-block;
        float: none;
        height: 50px;
        padding-left: 0px;
        width: 60px;
    }

    .ycbf .tab-bd-con {
        padding-left: 10px;
    }
    #makesearch_div{ margin: 0px 20px}  
    .sjcx_sj {
        float: left;
        height: 90px;
        padding: 5px;
        text-align: center;
        width: 120px;}
    .sjcx_sj img{ width:60px; height:50px}
</style>
<div>
    <div  id="makesearch_div">
    </div>
</div>
<script>
    $(document).ready(function(){
        $.post(Yii_baseUrl+'/servicer/uniondealer/index',{'homeajax':'1'},function(data){
            if(data){
                var html='';
                $.each(data,function(k,v){
                    html += '<div class="sjcx_sj">';
                    html += '<div><a href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail'); ?>/dealer/'+v.ID+'"  target="_blank"><img src="<?php echo F::uploadUrl() ?>'+v.Logo+'"></a></div>';
                    html += '<div style="line-height:20px;"><span><a href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail'); ?>/dealer/'+v.ID+'"  target="_blank">'+v.OrganName+'</a></span></div></div>';
                    if((k+1)%3==0)
                        html += '<div style="clear:both; "></div>';
                })
                $('#makesearch_div').html(html);
            }
        },'json');
    });
</script>