<?php
class  MGoods extends CWidget{
    public $GoodsID;
    public $OrganID;
    public function  run(){
    $this->render('goodseval',array('GoodsID'=>  $this->GoodsID,'OrganID'=>  $this->OrganID));
}
}

