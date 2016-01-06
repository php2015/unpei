<?php

/**
 * GOODS车型联动
 * @author Administrator
 *
 */
class WGoodsModel extends CWidget {

    public $scope = 'goods';  //字段名组成：epc['make'], 字段ID:epc_make
    public $cascade = 4;  //显示级数，1：只显示厂家，2：显示车系，3：显示年款，4：显示车型, 5：配件组联动
    public $make;
    public $series;
    public $year;
    public $model;
    public $makeField = 'make';  //字段基础名
    public $seriesField = 'series'; //字段基础名
    public $yearField = 'year';  //字段基础名
    public $modelField = 'model';  //字段基础名
    public $mainGroupField = 'mainGroup'; //字段基础名
    public $notlink = 'Y';                  // 联动，默认联动
    public $link = 'N';                  // 是否一个都不联动
    public $all = 'Y';                     //是否在结果中添加all
    public $dealerID = null;              //获取经销商自身经营车系

    public function getMakes() {
        if ($this->dealerID)
            $makes = D::queryGoodsMakeself();
        else
            $makes = D::queryGoodsMakes();
        return $makes;
    }

    public function getSeries() {
        if ($this->dealerID)
            $series = VehicleService::queryGoodsSerieself(array('make' => $this->make));    
        else
            $series = D::queryGoodsSeries(array('make' => $this->make));
        
        return $series;
    }

    public function getSeriesYears() {
        $years = D::queryGoodsSeriesYears(array('make' => $this->make, 'series' => $this->series));
//        if (!empty($years)) {
//            $add_year = array(array("year" => "ALL"));
//            $years = array_merge($add_year, $years);
//        }
        return $years;
    }

    public function getModels() {
        $models = D::queryGoodsModels(array('make' => $this->make, 'series' => $this->series, 'year' => $this->year));
//        if (!empty($models)) {
//            $add_model = array(array("modelId" => "ALL", "name" => "ALL"));
//            $models = array_merge($add_model, $models);
//        }
        return $models;
    }

    public function run() {
        $makeLabel = array('id' => $this->scope . '_' . $this->makeField, 'name' => $this->scope . '[' . $this->makeField . ']');
        $seriesLabel = array('id' => $this->scope . '_' . $this->seriesField, 'name' => $this->scope . '[' . $this->seriesField . ']');
        $yearLabel = array('id' => $this->scope . '_' . $this->yearField, 'name' => $this->scope . '[' . $this->yearField . ']');
        $modelLabel = array('id' => $this->scope . '_' . $this->modelField, 'name' => $this->scope . '[' . $this->modelField . ']');
        $mainGroupLabel = array('id' => $this->scope . '_' . $this->mainGroupField, 'name' => $this->scope . '[' . $this->mainGroupField . ']');
        $this->render('goodsModel', array('makeLabel' => $makeLabel, 'seriesLabel' => $seriesLabel,
            'yearLabel' => $yearLabel, 'modelLabel' => $modelLabel, 'notlink' => $this->notlink,
            'mainGroupLabel' => $mainGroupLabel));
    }

}
