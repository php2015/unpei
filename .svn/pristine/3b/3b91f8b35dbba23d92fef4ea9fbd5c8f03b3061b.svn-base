<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WMainMenuCommon extends CWidget {
	
    public function run() {
    	//$mainMenu = $this->getController()->getMainMenu();
    	$route = Yii::app()->getController()->getRoute();
    	$identity = Yii::app()->user->getIdentity();
    	$mainMenu = MenuUtil::getMainMenu($route,$identity);
    	
        $result=true;
//         $organ = Yii::app()->db->createCommand()
//                 ->select('OrganID,identity')
//                 ->from('tbl_user')
//                 ->where('id=:id', array(':id' => Yii::app()->user->id))
//                 ->queryRow();
//         if(Yii::app()->user->id==$organ['OrganID'] || empty($organ['OrganID'])){
        $orginID = Yii::app()->user->getOrganID();
        if (Yii::app()->user->id == $orginID || empty($orginID)) {	
            foreach($mainMenu as $key=>$val){
                $Menu[$key]=$val;
                $Menu[$key]['show']=true;
            }
        }else{
            $roles = Yii::app()->db->createCommand()
                    ->select('RoleID')
                    ->from('tbl_user_role')
                    ->where('EmployeeID=:employeeid', array(':employeeid' => Yii::app()->user->id))
                    ->queryAll();
            if(empty($roles)){
                $result = false;
            }else{
                foreach ($roles as $val){
                    $role[]=$val['RoleID'];
                }
                $rolemenus = Yii::app()->db->createCommand()
                        ->select('Jurisdiction')
                        ->from('tbl_role')
                        ->where(array('in','ID',$role))
                        ->queryAll();
                if(empty($rolemenus)){
                    $result = false;
                }else{
                    $jurisdiction='';
                    foreach ($rolemenus as $val){
                        $jurisdiction.=$val['Jurisdiction'];
                    }
                    if(empty($jurisdiction)){
                        $result = false;
                    }
                }
            }
            foreach($mainMenu as $key=>$val){
                $Menu[$key]=$val;
                if($result){
                    $Menu[$key]['show']=$this->if_show($jurisdiction,$key);
                }else{
                    $Menu[$key]['show']=$result;
                }
            }
        }
        $this->render('mainMenuCommon',array('mainMenu'=>$Menu));
    }
    public function if_show($jurisdiction,$menuID){
        $jurisdiction = substr($jurisdiction, 0, strlen($jurisdiction) - 1);
        $jurisdiction = explode(',', $jurisdiction);
        $jurisdiction = array_flip(array_flip($jurisdiction));
        if(in_array($menuID, $jurisdiction)){
            return true;
        }else{
            return false;
        }
    }
}