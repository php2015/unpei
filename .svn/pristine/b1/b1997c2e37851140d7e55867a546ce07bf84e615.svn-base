<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Commonmodel extends CActiveRecord {

    public static function getOrganID() {
        $organID = Yii::app()->user->getState('organID');
        if ($organID) {
            return $organID;
        }
        $userID = Yii::app()->user->id;
        $OrganID = Yii::app()->db->createCommand()
                ->select('OrganID')
                ->from('tbl_user')
                ->where("id=:userID", array(":userID" => $userID))
                ->queryRow();
        if (empty($OrganID['OrganID'])) {
            return $userID;
        } else {
            Yii::app()->user->setState('organID', $OrganID['OrganID']);
            return $OrganID['OrganID'];
        }
    }

    /*
     * 通过ID获取机构类型
     */

    public static function getIdentity($id) {
        $model = Yii::app()->db->createCommand()
                ->select("identity as identity")
                ->from("tbl_user")
                ->where("id=:userid", array(":userid" => $id))
                ->queryRow();
        return $model;
    }

    /*
     * 获取机构名称
     */

    public static function getOrganName() {
        $organName = Yii::app()->user->getState('organName');
        if ($organName) {
            return $organName;
        }
        //先获取角色身份（生产商/经销商/修理厂）
        $organName = "";
       // $userid = Yii::app()->user->id;
        $userid = Commonmodel::getOrganID();
        $model = self::getIdentity($userid);
        if ($model['identity'] == 1) {
            $organ = MakeOrgan::model()->find('userID=:userid', array(':userid' => $userid));
            $organName = $organ['name'];
        } else if ($model['identity'] == 2) {
            $organ = Dealer::model()->find('userID=:userid', array(':userid' => $userid));
            $organName = $organ['organName'];
        } else if ($model['identity'] == 3) {
            $organ = Service::model()->find('userId=:userid', array(':userid' => $userid));
            $organName = $organ['serviceName'];
        }
        Yii::app()->user->setState('organName', $organName);
        return $organName;
    }

    /**
     * 获取大类子类标准名称
     */
    public static function getCategory($id) {
        if (empty($id)) {
            return '';
        }
        $category = Yii::app()->db->createCommand()->select('name')->from('tbl_gcategory')->where("id = $id")->queryRow();
        return $category['name'];
    }

    /**
     * 获取厂家名
     */
    public static function getMake($makeid) {
        if ($makeid) {
            $Make = Yii::app()->db->createCommand()->select('Name')->from('goods_makes')->where("MakeId = $makeid")->queryRow();
            return $Make['Name'];
        } else {
            return "";
        }
    }

    /**
     * 获取车系
     */
    public static function getCar($seriesid) {
        if ($seriesid) {
            $series = Yii::app()->db->createCommand()->select('name')->from('goods_series')->where("seriesid = $seriesid")->queryRow();
            return $series['name'];
        } else {
            return "";
        }
    }

    /**
     * 获取年款
     */
    public static function getYear($yearid) {
        if ($yearid == 0) {
            return '';
        } else {
            //$data = Yii::app()->db->createCommand()->select('year')->from('front_model')->where("seriesid = {$yearid}")->queryRow();
            //return $data['year'];
            return $yearid;
        }
    }

    /**
     * 获取车型
     */
    public static function getModel($modelid) {
        if ($modelid == 0) {
            return '';
        } else {
            $data = Yii::app()->db->createCommand()->select('name,alias')->from('goods_model')->where("modelid = $modelid")->queryRow();
            if($data['alias']){
               return $data['name'].'('.$data['alias'].')';
            }else{
                return $data['name'];
            }
            
        }
    }

//     public static function OrganID(){
//        $model=Yii::app()->db->createCommand()
//                ->select("OrganID as organID")
//                ->from("tbl_user")
//                ->where("id=:userid",array(":userid"=>Yii::app()->user->id))
//                ->queryRow();
//        if(empty($model['organID'])){
//            return Yii::app()->user->id;
//        }else{
//            return $model['organID'];
//        }
//    }

//    public static function getAuthOrgan2() {
//        $organID = Yii::app()->user->getState('organID');
//        if (!empty($organID)) {
//            $identityorganID['organID']=$organID;
//            return $identityorganID;
//        }
//        $userID = Yii::app()->user->id;
//        $OrganID = Yii::app()->db->createCommand()
//                ->select('OrganID as organID,identity')
//                ->from('tbl_user')
//                ->where("id=:userID", array(":userID" => $userID))
//                ->queryRow();
//        Yii::app()->user->setState('organID', $OrganID['organID']);
//        return $OrganID;
//    }
    //权限 判断机构是否登记
    public static function getAuthOrgan(){
        $organID=Yii::app()->user->getOrganID();
         $organ= Yii::app()->jpdb->createCommand()
                ->select('ID ,Identity,OrganName,Phone,Email')
                ->from('jpd_organ')
                ->where("ID=:userID", array(":userID" =>$organID))
                ->queryRow();
      //  Yii::app()->user->setState('organID', $OrganID['organID']);
        return $organ;
    }
    /*
     * 调用方法
     * $res=  Commonmodel::Getcpnames();                 
     * <?php echo CHtml::dropDownlist('leafCategoryadd',$res['firstcpname'],$res['cpnames'],array('class' => 'width110 select', 'id' => 'leafCategoryadd','empty'=>'请选择配件品类'));
     * 如果不取默认值
     * <?php echo CHtml::dropDownlist('leafCategoryadd','',$res['cpnames'],array('class' => 'width110 select', 'id' => 'leafCategoryadd','empty'=>'请选择配件品类')); 
     */
    //获取配件品类
    public static function Getcpnames()
    {
    	
        $organID= self::getOrganID();
        
        //获取主营品类
        $model=  DealerCpname::model()->findAll("OrganID=:organID",array(':organID'=>$organID));
        //默认取第一个配件品类
        $firstcpname;
        $cpnames=array();
        if ($model) {
            foreach ($model as $key => $val) {
                $data[$key]['CpNameID'] = $val['CpNameID'];
                $data[$key]['CgName'] = $val['BigName'] . '-' . $val['SubName'] . '-' . $val['CpName'];
            }
            $firstcpname=$model[0]['CpNameID'];
            $cpnames=CHtml::listData($data,'CpNameID','CgName');
        }
        return array('firstcpname'=>$firstcpname,'cpnames'=>$cpnames);
    }
  public static function GetStand($makerID)
  {
  	
  	//$organID= self::getOrganID();
  	
  	//获取主营品类
  	$model=  DealerCpname::model()->findAll("OrganID=:organID",array(':organID'=>$makerID));
  	//默认取第一个配件品类
  	$firstcpname;
  	$cpnames=array();
  	if ($model) {
  		foreach ($model as $key => $val) {
  			$data[$key]['CpNameID'] = $val['CpNameID'];
  			$data[$key]['CgName'] = $val['BigName'] . '-' . $val['SubName'] . '-' . $val['CpName'];
  		}
  		$firstcpname=$model[0]['CpNameID'];
  		$cpnames=CHtml::listData($data,'CpNameID','CgName');
  	}
  	return array('firstcpname'=>$firstcpname,'cpnames'=>$cpnames);
  }
}

?>
