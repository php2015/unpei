<style>
    .selected2 { background:#0065bf; color: #fff;}
    /*.selectBig{background: #fff;clear:both; overflow:auto;border:1px solid #39AE39;position: absolute; width:215px; float:left; z-index: 500;}*/
    .selectBig{background: #fff;clear:both; overflow:auto;border:1px solid #0164C2;position: absolute; width:725px; float:left; z-index: 11500;}
    .selectBig2{background: #fff;clear:both;border:2px solid #0164C2;position: absolute; width:715px; float:left; z-index: 11500}
    .choseX{display:block;float:right; margin-top:7px; margin-right:3px}

    /*    *{ padding:0; margin:0;}border:1px solid #e1e1e1;width:20px;height:20px;
        a{ text-decoration:none;}*/
    .SelectName{background: #fff;}

    /* 大类*/
    .select_Bigname{width:200px; clear:both; float:left;}
    .xuanze{font:16px Arial;display:block; float:left; height:25px;line-height:30px; padding-left:10px; margin:5px 0}
    .Bigname_list{float:left;border:1px solid #DEDEDC; margin-left:5px;width:190px;height:235px;margin-bottom:10px; overflow: auto}
    .cpnamelist ul li{
        line-height: 24px;
        list-style: none outside none;
        margin-bottom: 1px;}
    .cpnamelist ul li:hover{background:#0065bf}
    .cpnamelist ul li a{color:#676767; font-size:12px; padding-left:15px;}
    .cpnamelist ul li.selected2 a{color:#fff}
    .cpnamelist ul li:hover a{color:white}
    .cpnamelist ul li:hover .next_name{color:white}
    /* 子类*/
    .select_Somname{width:200px; float:left;margin-left: 2px;}
    .Somname_list{float:left;border:1px solid #DEDEDC; width:189px; height:235px;margin-bottom:10px;}
    .cpnamelist .next_name{ float:right; color:#C4C4C4; font-weight:bolder;padding-right:5px}
    /* 标准名称*/
    .select_BiaoName{   background: none repeat scroll 0 0 #FFFFFF;

                        float: left;
                        margin-left: 395px;
                        *margin-left: 0px;
                        /*    margin-top: 108px;*/
                        position: absolute;
                        width: 310px;
                        z-index: 500;}
    .cpnameleft_A ul li{ border:1px solid #e1e1e1; width:14px; height:14px; background:#e8f0fb; margin-bottom:1PX; }
    .dom-display .cpnameright_A p a{color:#676767}
    .dom-display .cpnameright_A p a.selected2{color:#fff}
    .cpnameright_A a.selected2{ color:#fff}
    .cpnameleft_A ul li a{color:#0065bf;font:12px Arial; padding-left:3px; display:block; float:left;width:12px; height:14px;}
    .cpnameleft_A ul li a:hover{background:#0065bf; color:white}



    .select_BiaoName{ height:282px;* height:272px; border-left: none}
    .cpnameright_A{float:left;border:1px solid #DEDEDC; margin-left:5px;width:258px; margin-bottom:10px;background: #fff;}
    .biaozhun_top{height:28px; line-height:28px; background:#F0F0F0; color:#414141; padding-left:10px; font:18px/26px Arial; margin:5px 2px 2px 5px; font-weight:bold; clear:both}
    .cpnameright_A a{color:#676767;line-height: 30px; padding-left: 5px;  padding-right: 5px; display:block; float:left;}
    .cpnameright_A label{display:block; float:left; line-height: 30px;}
</style>
<!--<span style="margin-left:300px;">
    <input id="cpname-select" class=" input width260" type="text" value="请选择" style="width:230px;height:20px">
</span>-->
<div class="SelectName">

    <div class="selectBig" id="selectBig" style="display:none;">
        <div class="select_Bigname" >
            <span class="xuanze">请选择标准名称</span>
            <div class="Bigname_list">
                <?php
                $mainCagegorys = D::getMainCategorys();
                // var_dump($mainCagegorys);
                ?>
                <div class="cpnamelist" >
                    <ul id="ul-bigcate">
                        <?php foreach ($mainCagegorys as $key => $value): ?>
                            <li class="li_list" style=" margin-top: 1px;"><a href="javascript:;;" key="<?php echo $value['ID'] ?>"><?php echo $value['Name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="select_Somname" style="display:block;">
            <span class="xuanze"></span>
            <span class="choseX" style=" border:none"><a href="javascript:;;" id="close-categroy" style="padding-left:7px; padding-top: 12px; color:#ABABAB ;"></a></span>
            <div class="Somname_list">
                <div class="cpnamelist" style="height:235px;overflow-y:scroll;" >
                    <ul id="ul-subcate">

                    </ul>
                </div>
            </div>
        </div>
        <div class="select_BiaoName" style="display: block;">
            <span class="xuanze"></span>
            <span class="xuanze" style="display:none"><input type="text" name="pinyin-w" id="pinyin-w" class="input width260"/>
                <input type="button" id="pinyin-search" value="拼音检索"  class="btn-green" style="cursor:pointer;"/>
            </span>
            <span class="choseX"><a href="javascript:;;" id="close-categroy" style="padding-left:7px; padding-top: 12px; color:#ABABAB"><img src="<?php echo F::themeUrl() ?>/images/papmall/guanbi2.png"></a></span>
            <p style="clear:both" style="*margin-top:-5px"></p>
            <div style="height:235px;overflow-y: scroll;">
                <div class="cpnameleft_A" style="float:left; padding-left:10px">
                    <ul class="cpname_f" style="list-style:none; margin:0;">
                        <?php
                        for ($i = ord("A"); $i <= ord("Z"); $i++) {
                            echo "<li><a href='#" . chr($i) . "'>" . chr($i) . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="cpnameright_A" >
                    <div class="" style="height:auto;">
                        <div class="biaozhun_list">
                            <!--<p class="biaozhun_top"><a href="">D</a></p>-->
                            <p id="p-leafcate">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
    var subcate_id = ''; 
    var cpnametxt = '';
    var cpname_search = false;
    $(function(){
        // 点击输入框弹出div层
        $("#cpname-select").click(function(e){
            cpname_search = false;
            e.stopPropagation();
            //alert(1234);
            cpnametxt ='';
            $("#cpname-select").val(cpnametxt);
            var offset = $(this).offset();
            var left, top,url,data;
            //            if(typeof(countSelf) == 'undefined'){
            //                left = offset.left + 'px';
            //                top = offset.top +26 + 'px';
            //            }
            //            else{
            var width = $(window).width();
            //屏幕宽度大于1000
            if( width> 1000){
                var cutwidth =  (width - 1000)/2;
            }else{
                cutwidth = 0;
            }
                
            left = (offset.left -cutwidth) + 'px';
            top = (offset.top +26) + 'px';
            //            }
            // alert(offset.left);
            $("#selectBig").css({ 'left':left, 'top':top }).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
        // 点击输入框弹出div层
        $("#cpname-select-index").click(function(e){
            cpname_search = false;
            e.stopPropagation();
            //alert(1234);
            cpnametxt ='';
            $("#cpname-select-index").val(cpnametxt);
            var offset = $(this).offset();
            var left, top,url,data;
            //            if(typeof(countSelf) == 'undefined'){
            //                left = offset.left-700+548 + 'px';
            //                top = offset.top +26 + 'px';
            //            }
            //            else{
            var width = $(window).width();
            //屏幕宽度大于1000
            if( width> 1000){
                var cutwidth =  (width - 1000)/2;
            }else{
                cutwidth = 0;
            }
                
            left = (offset.left -cutwidth) + 'px';
            top = (offset.top +26) + 'px';
            //            }
            // alert(offset.left);
            $("#selectBig").css({ 'left':left, 'top':top }).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
        // 点击每一项 选中 bigcate
        $("#ul-bigcate .li_list").click(function(){
            var clas =$(this).attr('class');
            var selected=clas.split(" "); //字符分割 
            if(selected[1] && selected['1']== 'selected'){
                return false;
            }
            $(this).addClass('selected2').siblings().removeClass('selected2');
            $(".selectBig").removeClass('selectBig').addClass('selectBig2');
            var mainCategory = $(this).find('a').attr('key');
            cpnametxt ='';
            $("#cpname-select").val(cpnametxt);
            $("#cpname-select-index").val(cpnametxt);
            //            var maketxt= $(this).find('a').text();
            $('.select_BiaoName').hide();
           
            
            url = Yii_chenhgUrl + '/common/getSubCategorys';
            data = {mainCategory: mainCategory}
            $("#ul-subcate").empty();
            $.getJSON(url, data, function(result){
                //   console.log(result);
                $('.select_Somname').show();
                $.each(result,function(index,value){
                    var li= '<li class="li_list"><a key='+ value[0]+' href="javascript:void(0)">'+value[1]+'</a><span class="next_name">></span></li>';
                    $("#ul-subcate").append(li);
                })
                $("#ul-subcate li:first").click();
            })
        });
        
        // 点击每一项 选中子类
        $("#ul-subcate .li_list").live('click',function(){
            var clas =$(this).attr('class');
            var selected=clas.split(" "); //字符分割 
            if(selected[1] && selected['1']== 'selected'){
                return false;
            }
            $(this).addClass('selected2').siblings().removeClass('selected2');
            var subCategory = $(this).find('a').attr('key');
            subcate_id = subCategory;
            cpnametxt ='';
            $("#cpname-select").val(cpnametxt);
            $("#cpname-select-index").val(cpnametxt);
            var url = Yii_chenhgUrl + '/common/getLeafCategorys';
            var data = {subCategory: subCategory}
            $("#p-leafcate").empty();
            $.getJSON(url, data, function(result){
                $('.select_BiaoName').show();
                //var a ='';// '<p class="biaozhun_top"><a href="">A</a></p>';
                $(".cpname_f li").remove();  
                $("<li><a href='javascript:void(0)'>全</a></li>").appendTo(".cpname_f");
                $.each(result,function(index,first){
                    $("<li><a href='javascript:void(0)'>" + first.first+ "</a></li>").appendTo(".cpname_f");
                    var li = '<p class="biaozhun_top" style="*margin-top:5px"><a href="#" name='+first.first+'>'+first.first+'</a></p>'
                    $.each(first.children,function(index,value){
                        if(index == 0){
                            if(typeof(value[1]) != 'undefined'){
                                // li+= '<li class="li_list"><a key='+ value.modelId+' name='+year.year+' href="javascript:void(0)">'+value.name+'</a></li>';
                                li += '<a style="white-space:nowrap" class="li_list" key='+ value[0]+' code='+value[3]+' href="javascript:void(0)">'+value[1]+'</a>';
                            }  
                        }else{
                            if(typeof(value[1]) != 'undefined'){
                                // li+= '<li class="li_list"><a key='+ value.modelId+' name='+year.year+' href="javascript:void(0)">'+value.name+'</a></li>';
                                li += '<label class="line"> |</label><a style="white-space:nowrap"  class="li_list" key='+ value[0]+'  code='+value[3]+' href="javascript:void(0)">'+value[1]+'</a>';
                            }  
                        }

                    })
                    $("#p-leafcate").append(li);
                     
                })
                $("<li><a href='javascript:void(0)'>全</a></li>").appendTo(".cpname_f");
                //                $.each(result,function(index,value){
                //                   // var a= '<li class="li_list"><a key='+ value.id+' href="javascript:void(0)">'+value.name+'</a><span class="next_name">></span></li>';
                //                    
                //                   var a =  '<a class="li_list" key='+ value.id+' href="javascript:void(0)">'+value.name+'</a><label class="line"> |</label>';
                //                    $("#p-leafcate").append(a);
                //                })
           
            })
        });
        
        // 点击每一项 选中 cpname
        $("#p-leafcate .li_list").live('click',function(){
            $(this).addClass('selected2').siblings().removeClass('selected2');
            //  var cpname = $(this).attr('key');
            var cpname = $(this).text();
            cpnametxt = cpname;
            $("#cpname-select").val(cpname);
            $("#cpname-select-index").val(cpname);
            if(cpname_search){
                $("#cpname-search").val(cpname);
            }
        });
        
        $(".cpname_f li").live('click',function(){
            var litxt = $(this).text();
            if(/[A-Z]+/.test(litxt)){
                $("#pinyin-w").val(litxt);                
            }else{
                $("#pinyin-w").val(""); 
            }            
            $("#pinyin-search").click();
        })
        // 拼音检索
        $("#pinyin-search").live('click',function(){
            var pinyin = $("#pinyin-w").val();
            
            // alert(subcate_id);
            var url = Yii_chenhgUrl + '/common/getLeafCategorysofp';
            var data = {subCategory: subcate_id,pinyin:pinyin};
            $("#p-leafcate").empty();
            $.getJSON(url, data, function(result){
                $('.select_BiaoName').show();
                //                $.each(result,function(index,value){
                //                   var a =  '<a class="li_list" key='+ value.id+' href="javascript:void(0)">'+value.name+'</a><label class="line"> |</label>';
                //                    $("#p-leafcate").append(a);
                //                })
                $.each(result,function(index,first){
                    // var li = ' <li class="li_top"><a href="javascript:void(0)" key ='+first.first+' >'+first.first+'</a></li>';
                    var li = '<p class="biaozhun_top"><a href="#" name='+first.first+'>'+first.first+'</a></p>'
                    $.each(first.children,function(index,value){
                        if(index == 0){
                            if(typeof(value.Name) != 'undefined'){
                                // li+= '<li class="li_list"><a key='+ value.modelId+' name='+year.year+' href="javascript:void(0)">'+value.name+'</a></li>';
                                li += '<a style="white-space:nowrap"  class="li_list" key='+ value.ID+' code='+value.Code+' href="javascript:void(0)">'+value.Name+'</a>';
                            }  
                        }else{
                            if(typeof(value.Name) != 'undefined'){
                                // li+= '<li class="li_list"><a key='+ value.modelId+' name='+year.year+' href="javascript:void(0)">'+value.name+'</a></li>';
                                li += '<label class="line"> |</label><a style="white-space:nowrap"  class="li_list" key='+ value.ID+' code='+value.Code+' href="javascript:void(0)">'+value.Name+'</a>';
                            }  
                        }
                    })
                    $("#p-leafcate").append(li);
                })
            
            });
        });
        
        $("#close-categroy").live('click',function(){
            $('#selectBig').hide();
            //            $('.select_BiaoName').hide();
        });
        $("#selectBig").live('click',function(event){ // mouseout
            var e = (event) ? event : window.event;
            if (window.event) {//IE
                e.cancelBubble=true;
                e.stopPropagation();
            } else { //火狐
                e.stopPropagation();
            }
            // e.stopPropagation();
        });
        $(document).click(function(e){
            //    alert(2)
            e.stopPropagation();
            $("#selectBig").hide();
        })
    })
   
    
</script>
