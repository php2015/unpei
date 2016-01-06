<?php

class MycouponController extends Controller {
    public function actionIndex() {
       $select="a.CouponSn,b.Title,a.Amount,a.CreateTime,(a.CreateTime+a.Valid*3600*24) as EndTime,"
                . "(case when UNIX_TIMESTAMP()>(a.CreateTime+a.Valid*3600*24) then '<p style=color:red>已过期</p>' when a.IsUse=0 then '未使用'  else  '已使用' end)  as IsUse";
        $sql   = "select  $select"
                . " from pap.pap_coupon_manage  as a "
                ." left join  pap.pap_promotion as b "
                . "on a.PromoID=b.ID "
                ." left join  jpd.jpd_organ as c "
                . "on a.OwnerID=c.ID where 1=1";
       
        $OrganID   = intval(Yii::app()->user->getOrganID());
        $sql      .=" and c.ID=$OrganID";
        $ID        = Yii::app()->request->getParam('ID');
        $IsUse = Yii::app()->request->getParam('IsUse');
      
        if ($ID && trim($ID) != null) {
            $ID=trim($ID);
            $sql.=" and a.CouponSn like  '%$ID%'";
        }
        if ($IsUse) {
            if($IsUse==1){
               $sql.=" and   a.IsUse=0";
            }else if($IsUse==2){
               $sql.=" and   a.IsUse=1";
            }else if($IsUse==3){
               $sql.=" and  UNIX_TIMESTAMP()>(a.CreateTime+a.Valid*3600*24)";
            }
            
        }
        $count = Yii::app()->papdb->createCommand(str_replace($select, 'count(a.ID)', $sql))->queryScalar();
        $lists = new CSqlDataProvider($sql, array(
            'totalItemcount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $datas = $lists->getData();
          // var_dump($sql);die;    
        $op[1]=array('ID'=>1,'Name'=>"未使用");
        $op[2]=array('ID'=>2,'Name'=>"已使用");
        $op[3]=array('ID'=>3,'Name'=>"已过期");
       //var_dump($sql);die;       
        $this->render('index',array('lists' => $lists,'datas' => $datas,'op'=>$op));
    }

}
