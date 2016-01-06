<?php

/**
 * EPC车型联动
 * @author Administrator
 *
 */
class WEpcModel extends CWidget
{
	public $scope = 'epc';		//字段名组成：epc['make'], 字段ID:epc_make
	public $cascade = 4;		//显示级数，1：只显示厂家，2：显示车系，3：显示年款，4：显示车型, 5：配件组联动
	public $make;
	public $series;
	public $year;
	public $model;
	public $makeField = 'make';		//字段基础名
	public $seriesField = 'series'; //字段基础名
	public $yearField = 'year'; 	//字段基础名
	public $modelField = 'model'; 	//字段基础名
	public $mainGroupField = 'mainGroup'; //字段基础名
        public $notlink = 'Y';                  // 联动，默认联动


        public function getMakes()
    {
        $makes = D::queryEpcMakes();
        return $makes;
    }
    
    public function getSeries()
    {
    	$series = D::queryEpcSeries(array('make'=>$this->make));
    	return $series;
    }
    
    public function getSeriesYears()
    {
    	$years = D::queryEpcSeriesYears(array('make'=>$this->make,'series'=>$this->series));
    	return $years;
    }
    
    public function getModels()
    {
    	$models = D::queryEpcModels(array('make'=>$this->make,'series'=>$this->series,'year'=>$this->year));
    	return $models;
    }
    
    public function run()
    {
    	$makeLabel = array('id'=>$this->scope.'_'.$this->makeField,'name'=>$this->scope.'['.$this->makeField.']');
    	$seriesLabel = array('id'=>$this->scope.'_'.$this->seriesField,'name'=>$this->scope.'['.$this->seriesField.']');
    	$yearLabel = array('id'=>$this->scope.'_'.$this->yearField,'name'=>$this->scope.'['.$this->yearField.']');
    	$modelLabel = array('id'=>$this->scope.'_'.$this->modelField,'name'=>$this->scope.'['.$this->modelField.']');
    	$mainGroupLabel = array('id'=>$this->scope.'_'.$this->mainGroupField,'name'=>$this->scope.'['.$this->mainGroupField.']');
        $this->render('epcModel',array('makeLabel'=>$makeLabel,'seriesLabel'=>$seriesLabel, 
        	'yearLabel'=>$yearLabel,'modelLabel'=>$modelLabel,'notlink'=>$this->notlink,
        	'mainGroupLabel'=>$mainGroupLabel));
    }
}