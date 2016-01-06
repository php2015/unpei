<?php

class SumGoodsCommand extends CConsoleCommand {
    
    //统计商品数量，每日执行
    public function run() {
        echo date('Y-m-d H:i:s') . " [SumGoodsCommand]  start \n";
        //删除旧数据
             $delete = 'delete from jpd_number_goods ';
        Yii::app()->jpdb->createCommand($delete)->execute();
        $sql='select a.Car,count(distinct b.ID) as number from pap_goods as b,pap_goods_vehicle_relation as a where a.GoodsID=b.ID and b.ISdelete=1 and b.IsSale=1 group by a.Car';
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        if($result){
            $insert='insert into jpd_number_goods (`Type`,`ReID`,`Number`) values';
           foreach ($result as $key => $val) {
               $insert.=' (1,'.$val["Car"].','.$val["number"].')';
                if($key<(count($result)-1)){
                    $insert.=',';
                }
           }
           Yii::app()->jpdb->createCommand($insert)->execute();
        }
        $sql2='select a.Model,count(distinct b.ID) as number from pap_goods as b,pap_goods_vehicle_relation as a where a.GoodsID=b.ID and b.ISdelete=1 and b.IsSale=1 group by a.Model';
        $result2 = Yii::app()->papdb->createCommand($sql2)->queryAll();
        if($result2){
            $insert2='insert into jpd_number_goods (`Type`,`ReID`,`Number`) values';
           foreach ($result2 as $keys => $vals) {
               $insert2.=' (2,'.$vals["Model"].','.$vals["number"].')';
                if($keys<(count($result2)-1)){
                    $insert2.=',';
                }
           }
           Yii::app()->jpdb->createCommand($insert2)->execute();
        }

        echo date('Y-m-d H:i:s') . " [SumGoodsCommand]  end \n";
    }

}
