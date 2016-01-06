<?php
/**
 * 自动化执行 命令行模式
 */

class OrderFirstCommand extends CConsoleCommand
{
    public function run() {
    	Yii::app()->getComponent('log');
    	Yii::log(date('Y-m-d H:i:s') . " [DealerPromotion] start", 'info', 'command');
        //所要执行的任务，如数据符合某条件更新，删除，修改
       // $sql="update pap_promotion_times set LastTime=UNIX_TIMESTAMP(NOW()),Num=0";
        $sql="delete from pap_promotion_times";
        $res=Yii::app()->papdb->createCommand($sql)->execute();
    	Yii::log(date('Y-m-d H:i:s') . " [DealerPromotion] end \n", 'info', 'command');
    	echo date('Y-m-d H:i:s') . " [DealerPromotion] result:\n";
    }
}
