<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class ChatService{
    
      //获取会话列表
    public static function getSessionList($userid) {
        if ($userid) {
            $res = Yii::app()->chatmongodb->getDbInstance()->chat_sessions->find(array("userid" => $userid));
            $data=array();
            if($res){
                foreach($res as $key=>$value){
                    if($value['touserid']){
                       $datas=self::getuserinfo($value['touserid']);
                       $datas['sessionid']=$value['sessionid'];
                         $data[]=$datas;
                    }
                }
            }
        }
        return $data;
    }
    
    //获取机构信息
    public static function getuserinfo($userid){
        if(!isset($userid) || empty($userid)){
            Yii::app()->end;
        }
//         $sql = "SELECT a.OrganName,a.Logo,d.ID ,d.UserName,d.IsMain,d.name FROM `jpd_organ` a 
//                        left join 
//                        (select b.ID,b.UserName,b.OrganID,b.IsMain,c.name from jpd_user b 
//                        left join jpd_organ_employees c on b.EmployeID=c.ID
//                        where b.ID!=:touserid) as d
//                        on a.ID=d.OrganID
//                        where IsBlack='0' and IsFreeze='0' and IsAuth='0' and Status!='0'
//                        order by a.ID asc ";
               
        $sql ="SELECT a.ID userid,a.UserName,a.IsMain,a.OrganID,a.EmployeID,b.ID OrganID,b.Logo as Path,b.OrganName FROM `jpd_user` a join 
              jpd_organ b on b.ID=a.OrganID 
              where a.ID=:touserid ";
//        $sql ="SELECT a.ID,a.OrganName,b.Path FROM `jpd_organ` a join 
//              (select Path,OrganID from jpd_organ_photo a GROUP BY OrganID) as b
//              on a.ID=b.OrganID 
//              where a.ID=:touserid";
        $datas=Yii::app()->jpdb->createCommand($sql)->bindParam(':touserid',$userid)->queryRow();
        return $datas;
    }
    //获取用户回话列表
    public static function lists($params){
        if(empty($params)||!is_array($params)){
            Yii::app()->end;
        }
        $userid=Yii::app()->user->getOrganID();
        $touserid=$params['touserid'];
        $sessionid=$params['sessionid'];
        $data=array();
        
        $touser=Yii::app()->chatmongodb->getDbInstance()->record->find(array("sessionid" => $sessionid));
        if($touser){
            foreach($touser as $k=>$value){
              $data[$k]=$value;
            }
        }
      return $data;
    }
}

