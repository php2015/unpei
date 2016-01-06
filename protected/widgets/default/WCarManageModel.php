<?php

/**
 * 车辆管理适用车系
 */
class WCarManageModel extends CWidget {

    public $mallSearch = false;
    public $goodsID = '';

    public function run() {
        $this->render('CarManageModel', array('mallSearch' => $this->mallSearch, 'goodsid' => $this->goodsID));
    }

}
