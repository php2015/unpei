<?php

class TopNews extends CWidget {

    public function run() {
        //获取
        $params = M::getRoot();
        //组装参数
        $params["scope"] = "sliderbar"; //指定定查询范围
        //获取菜单数组
        $navarr = FrontMenu::getChildMenu($params);
        $service_arr = array('orders' => '订单管理', 'quos' => '查看报价单', 'returns' => '退货管理');
        $dealer_arr = array('orders' => '订单管理', 'quos' => '管理报价单', 'returns' => '退货管理');
        foreach ($navarr as $key => $val) {
            if (Yii::app()->user->isServicer()) {
                if ($val['name'] != '采购管理') {
                    unset($navarr[$key]);
                    continue;
                }
                foreach ($navarr[$key]['children'] as $k => $v) {
                    if ($v['name'] == $service_arr['orders']) {
                        $data['order'] = $v['name'];
                    } else if ($v['name'] == $service_arr['quos']) {
                        $data['quo'] = $v['name'];
                    } else if ($v['name'] == $service_arr['returns']) {
                        $data['return'] = $v['name'];
                    }
                }
            }
            if (Yii::app()->user->isDealer()) {
                if ($val['name'] != '销售管理') {
                    unset($navarr[$key]);
                    continue;
                }
                foreach ($navarr[$key]['children'] as $k => $v) {
                    if ($v['name'] == $dealer_arr['orders']) {
                        $data['order'] = $v['name'];
                    } else if ($v['name'] == $dealer_arr['quos']) {
                        $data['quo'] = $v['name'];
                    } else if ($v['name'] == $dealer_arr['returns']) {
                        $data['return'] = $v['name'];
                    }
                }
            }
        }
        $this->render('topnews', array('mesmenu' => $data));
    }

}
