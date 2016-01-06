<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarMenuCommon extends CWidget {
	
    public function run() {
        //$sidebarMenu = $this->getController()->getSidebarMenu();
        $route = Yii::app()->getController()->getRoute();
        $identity = Yii::app()->user->getIdentity();
        $sidebarMenu = MenuUtil::getSidebarMenu($route,$identity);
        
        $result=true;
//         $organ = Yii::app()->db->createCommand()
//                 ->select('OrganID,identity')
//                 ->from('tbl_user')
//                 ->where('id=:id', array(':id' => Yii::app()->user->id))
//                 ->queryRow();
//         if(Yii::app()->user->id==$organ['OrganID'] || empty($organ['OrganID'])){
        $orginID = Yii::app()->user->getOrganID();
        if (Yii::app()->user->id == $orginID || empty($orginID)) {
            foreach($sidebarMenu as $key=>$val){
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
            foreach($sidebarMenu as $key=>$val){
                $Menu[$key]=$val;
                if($result){
                    $Menu[$key]['show']=$this->if_show($jurisdiction,$key);
                }else{
                    $Menu[$key]['show']=$result;
                }
            }
        }
        $this->render('sidebarMenuCommon',array('menu'=>$Menu));
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