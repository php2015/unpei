<?php

/*
 * 自动删除过期的业务提醒
 */

class RemindCommand extends CConsoleCommand {

    public function run() {
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [Remind] start", 'info', 'command');

        $time = time();
        //删除已处理或已失效的业务提醒
        $sql = "delete from pap_remind_business where HandleStatus=2 or EffectiveTime<$time";
        $del = Yii::app()->papdb->CreateCommand($sql)->execute();

        Yii::log(date('Y-m-d H:i:s') . "Delete $del business_remind " . " [Remind] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [Remind] end \n";
    }

}
?>
