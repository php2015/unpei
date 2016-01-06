<?php

/**
 * 嘉配商城适用车系
 */
class MCarModel extends CWidget {

    public $mallSearch = false;
    public $goodsID = '';

    public function run() {
        $this->render('carModel', array('mallSearch' => $this->mallSearch, 'goodsid' => $this->goodsID));
    }

}
