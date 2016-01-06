<?php

/**
 * EPC车型联动
 * @author Administrator
 *
 */
class WEpcGroup extends CWidget
{
	public $scope = 'epc';
	public $cascade = 2;
	public $model;
	public $mainGroup;
	public $group;
	public $modelField = 'model';
	public $mainGroupField = 'mainGroup';
	public $groupField = 'group';
	
    public function getGroups($groupId=0)
    {
        $result = D::queryPartChildGroups(array('modelId'=>$this->model,'groupId'=>$groupId));
        return $result;
    }
    
    public function run()
    {
    	$modelLabel = array('id'=>$this->scope.'_'.$this->modelField,'name'=>$this->scope.'['.$this->modelField.']');
    	$mainGroupLabel = array('id'=>$this->scope.'_'.$this->mainGroupField,'name'=>$this->scope.'['.$this->mainGroupField.']');
    	$groupLabel = array('id'=>$this->scope.'_'.$this->groupField,'name'=>$this->scope.'['.$this->groupField.']');
        $this->render('epcGroup',array('modelLabel'=>$modelLabel,'mainGroupLabel'=>$mainGroupLabel,
        		'groupLabel'=>$groupLabel));
    }
}