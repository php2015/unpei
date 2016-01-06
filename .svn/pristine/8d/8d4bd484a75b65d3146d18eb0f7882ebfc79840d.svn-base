<?php

/**
 * 前市场车型联动
 * @author Administrator
 *
 */
class WFrontModel extends CWidget
{
	public $scope = 'front';	//字段名组成：front['make'], 字段ID:front_make
	public $cascade = 4;		//显示级数，1：只显示厂家，2：显示车系，3：显示年款，4：显示车型
	public $make;
	public $series;
	public $year;
	public $model;
	public $makeField = 'make';	//字段基础名
	public $seriesField = 'series'; //字段基础名
	public $yearField = 'year'; //字段基础名
	public $modelField = 'model'; //字段基础名
	
    public function getMakes()
    {
        $makes = D::queryFrontMakes();
        return $makes;
    }
    
    public function getSeries()
    {
    	$series = D::queryFrontSeries(array('make'=>$this->make));
    	return $series;
    }
    
    public function getSeriesYears()
    {
    	$years = D::queryFrontSeriesYears(array('make'=>$this->make,'series'=>$this->series));
    	return $years;
    }
    
    public function getModels()
    {
    	$models = D::queryFrontModels(array('make'=>$this->make,'series'=>$this->series,'year'=>$this->year));
    	return $models;
    }
    
    public function run()
    {
    	$makeLabel = array('id'=>$this->scope.'_'.$this->makeField,'name'=>$this->scope.'['.$this->makeField.']');
    	$seriesLabel = array('id'=>$this->scope.'_'.$this->seriesField,'name'=>$this->scope.'['.$this->seriesField.']');
    	$yearLabel = array('id'=>$this->scope.'_'.$this->yearField,'name'=>$this->scope.'['.$this->yearField.']');
    	$modelLabel = array('id'=>$this->scope.'_'.$this->modelField,'name'=>$this->scope.'['.$this->modelField.']');
    	$this->render('frontModel',array('makeLabel'=>$makeLabel,'seriesLabel'=>$seriesLabel,
    			'yearLabel'=>$yearLabel,'modelLabel'=>$modelLabel));
        //$this->render('frontModel');
    }
}