<style>
    .width270{
        width: 270px;
    }
    .more{
        padding-left: 175px;
        padding-top: 5px; 
        display: block;
        color: #0065bf;
        padding-bottom: 10px;
    }
    .m_left36{
        margin-left: 36px;
    }
</style>
<div id="layout-t4" class="tab-product tab-sub-3 ui-style-gradient" >
    <h2 class="tab-hd"> 
        <span class="tab-hd-con current" style="margin-left:30px" key="inquiry"><a href="javascript:;">询价单管理</a></span>
        <span class="tab-hd-con" key="quotation"><a href="javascript:;">收到的报价单</a></span>
        <span class="tab-hd-con"  style="border-right: 1px solid #e2e2e2"  key="order"><a href="javascript:;">采购订单总览</a></span> 
    </h2>
    <div class="tab-bd dom-display dom-display8">
        <div class="tab-bd-con inquiry" style="display:block;"> 
            <form id="searchinquiry"  action="<?php echo Yii::app()->createUrl("/pap/inquiryorder/index") ?>" medthod="get">
                <p> <label class="label1 m_left12">询价时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'startdate',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                            'yearRange' => ''
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:120px;',
                            'class' => 'input',
                        )
                    ));
                    ?>   <span>-</span>          <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'enddate',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                            'yearRange' => ''
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:120px;',
                            'class' => 'input',
                        )
                    ));
                    ?> 
                </p><p>
                    <label class="label1 m_left36">状态：</label>
                    <select class="select select2 td_w80" id="status1" name="status" >
                        <option value ="">全部</option>
                        <option value ="0">待报价</option>
                        <option value ="1">已报价待确认</option>
                        <option value ="2">已确认</option>
                        <option value ="3">已撤销</option>
                        <option value ="4">已拒绝</option>
                        <option value ="5">已失效</option>
                    </select>
                </p><p>
                    <label class="label1">询价单编号：</label>
                    <input type="text"  class=" input input3 " name="inquirySn" ></p>
                <p align="center">
                    <input type="button" value="查 询" class="submit m_left" id="searchinquirybutton">
                </p>

            </form>
        </div>
        <div class="tab-bd-con quotation" > 



            <form id="searchquotationlist"  action="<?php echo Yii::app()->createUrl("/pap/quotationlist/index") ?>" medthod="get">
                <p>
                    <label class="label1">报价单编号：</label>
                    <input type="text" class="input"  id='no' name="no">
                </p><p>
                    <label class="label1"  >报价单状态：</label>
                    <select class="select" id='status2' name="status">
                        <option value ="">全部</option>
                        <option value ="1" >已报价待确认</option>
                        <option value ="2" >已确认</option>
                        <option value ="4" >已拒绝</option>
                        <option value ="5" >已失效</option>
                    </select>
                </p><p>
                    <label class="labell">发送时间段：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'start',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:90px;',
                            'class' => 'input',
                        )
                    ));
                    ?>  
                    至
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'end',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:90px;',
                            'class' => 'input',
                        )
                    ));
                    ?>  
                </p>
                <p align="center">
                    <input type="button" value="查 询" class="submit m_left" id="searchquotationlistbutton">
                </p>

            </form>
        </div>
        <div class="tab-bd-con order" style=" padding-left: 0px;"> 
            <?php
            $params['OrganID'] = Yii::app()->user->getOrganID();
            $params['pageSize'] = 4;
            $this->widget('widgets.default.WGridView', array(
                'dataProvider' => OrderService::getOrderlist($params),
//                'pager' => false,
                'columns' => array(
                    array(// display 'create_time' using an expression
                        'name' => '序号',
                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                        'headerHtmlOptions' => array('width' => '30px'),
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '订单编号',
                        'value' => '$data[OrderSN]',
                        'headerHtmlOptions' => array('width' => '80px'),
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '卖家名称',
                        'type' => 'raw',
                        'value' => '$data[SellerName]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '总金额',
                        'value' => '￥.$data[RealPrice]',
                        'headerHtmlOptions' => array('width' => '50px'),
                    ),
                    array(
                        // display a column with "view", "update" and "delete" buttons
                        'class' => 'CButtonColumn',
                        'header' => '详情',
                        'headerHtmlOptions' => array('width' => '30px'),
                        'template' => '{view}',
                        'buttons' => array(
                            'view' => array(
                                'label' => '详情',
                                'url' => 'Yii::app()->createUrl("/pap/orderreview/detail",array("orderid"=>$data->ID))'
                            ),
                        ),
                    ),
                ),
            ));
            ?>
            <div><a class="more" href="<?php echo Yii::app()->createUrl("pap/orderreview/index") ?>">查看更多</a></div>
        </div>

    </div>
</div>
<script>

    //搜索
    $("#searchinquirybutton").click(function(){
        var startdate=$("#startdate").val();
        var enddate=$("#enddate").val();
        if(enddate){
            if(enddate<startdate){
                alert('起始时间不能大于截止时间')
                return false
            }  
        }
        if(!$('#status1').val()  && !$('input[name=inquirySn]').val()  && !enddate && !startdate){
            alert('请填写查询条件')
            return false;
        }
        $("#searchinquiry").submit()
    })          
    $("#searchquotationlistbutton").click(function(){
        if(!$('#status2').val()  && !$('input[name=no]').val()  && !$("#start").val() && !$("#end").val()){
            alert('请填写查询条件')
            return false;
        }
        $("#searchquotationlist").submit()
    })
</script>