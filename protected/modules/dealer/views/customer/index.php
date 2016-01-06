<?php
$this->pageTitle = Yii::app()->name . ' - ' . "客服平台";
$this->breadcrumbs = array(
    '客服平台' => Yii::app()->createUrl('dealer/customer/index'),
    '回答问题'
);
?>
<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
    .grid-view table {
        border: 0 none;
        border-collapse: collapse;
    }
    .next{background:none}
</style>
<div class="bor_back m-top">

    <div class="m_top10" style="margin:10px 20px;">
            <p class='form-row'>
                <span class='label label-inline'>标题：</span>
                <input class='width98 input' id="Title" value="<?php echo $title; ?>">
                <span class='label label-inline'>发起人：</span>
                <input class='width98 input' id="OrganName" value="<?php echo $organName; ?>">
                <span class='label label-inline'>状态：</span>
                <select class='width60 select' id="State" name="State">
                    <option value="">显示全部</option>
                    <option value='2' <?php if ($state == 2) echo "selected=selected" ?>>待解答</option>
                    <option value='3' <?php if ($state == 3) echo "selected=selected" ?>>待反馈</option>
                    <option value='4' <?php if ($state == 4) echo "selected=selected" ?>>完结</option>
                    <option value='5' <?php if ($state == 5) echo "selected=selected" ?>>重新开启</option>
                </select>
                <span class='label'></span>
                <input class='submit ml10 m_left' type='submit' id="search-btn" value='查询'>
            </p>
    </div>
    <div class="bor_back m_top10">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'name' => '问题编号',
                    'value' => 'CHtml::encode($data->ID)',
                ),
                array(
                    'name' => '标题',
                    'value' => 'CHtml::encode($data->Title)'
                ),
                array(
                    'name' => '发起人',
                    'value' => 'CHtml::encode($data->OrganName)'
                ),
                array(
                    'name' => '类型',
                    'value' => 'CHtml::encode($data->Type)'
                ),
                array(
                    'name' => '提交时间',
                    'value' => 'CHtml::encode($data->SubmitTime)'
                ),
                array(
                    'name' => '状态',
                    'value' => 'CHtml::encode($data->State)'
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{view}',
                    'buttons' => array(
                        'view' => array(
                            'label' => '详情',
                            'url' => 'Yii::app()->createUrl("dealer/customer/detail",array("id"=>$data->ID))'
                        ),
                    ),
                ),
            )
        ))
        ?>
    </div>
</div>
<script>
    $(function() {
        //搜索
        $('#search-btn').click(function() {
            var url = Yii_baseUrl + '/dealer/customer/index';
            var data = {};
            data.Title = $('#Title').val();
            data.OrganName = $('#OrganName').val();
            data.State = $('#State').val();
            $.each(data, function(k, v) {
                if (v != '')
                    url += '/' + k + '/' + v;
            })
            window.location.href = url;
        })
    })
</script>