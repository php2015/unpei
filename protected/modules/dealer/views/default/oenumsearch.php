<div class="auto_height">
    <ul class="search-content" style="height:154px;">
        <li class="width300" style="margin-top:23px">
            <label>OE号：</label>
            <input type="text" class="width150 input" id="oeno" value="" style="margin-bottom:10px"/>
            <br />
            <span><b>(可输入带*的部分OE号,但至少有3位非*字符)</b></span>
        </li>
        <li style="display:none;margin-top:20px" class="width650" >
            <label>厂家：</label>
            <select id="oeno-search-make-list" class="width150 select">
                <option value="0">--请选择厂家类别</option>
            </select>
        </li>
        <li class="query-btn" style="margin-left:66px;margin-top: 20px">
            <input class="btn-green" type="submit" value="查&nbsp;&nbsp;询" id="oeno-search" />
        </li>
    </ul>
</div>
<script>
    $('#oeno-search').click(function(){
        var oeno = $.trim($('#oeno').val());
        var makeId = "";
        if(oeno == ''){
            return false;
        }
        //如果oe号中带有*，则为部分匹配，需要选择厂商
        if(oeno.indexOf('*') >= 0){
            $('#oeno-search-make-list').parent().show();
            if(oeno.replace(/\*/g,'').length < 3){
             $('#oeno').nextAll('span').find('b').css('color','red');
                return false;
            }
            makeId = $('#oeno-search-make-list').val();
            if(!makeId){
                return false;	
            }
        }else{
            $('#oeno-search-make-list').find("option[value='']").attr("selected","true");
            $('#oeno-search-make-list').parent().hide();
             if(oeno.length < 3){
                    $('#oeno').nextAll('span').find('b').css('color','red');
                    return false;
	     }
        }
		
        var url = Yii_jpdata_baseUrl + "/parts/searchPartsByOeno";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'oeno': oeno,
                'make': makeId
            },
            dataType: "html",
            success:function(html){
                var locationHash = global_oe.hashPrefix + oeno;
                if(makeId && makeId != '0') {
                    locationHash += "__" + makeId;
                }
                window.location.hash = locationHash;
                location.href=Yii_baseUrl+'/jpdata/parts/index'+window.location.hash;
            }
        });
        return false;
    });
		
</script>