<?php
/**
 * 自动化执行 命令行模式
 */
Yii::import('application.modules.pap.models.*'); //引入models
class DealerPromotionCommand extends CConsoleCommand
{
    public function run($args) {
    	Yii::app()->getComponent('log');
    	Yii::log(date('Y-m-d H:i:s') . " [DealerPromotion] start", 'info', 'command');
        //所要执行的任务，如数据符合某条件更新，删除，修改
    	$Times = time() - 24 * 60 * 60 * 7 * 2;
    	$count = PapGoods::model()->updateAll(array(
    			'IsPro' => 0,
    			'UpdateTime' => time(),
    			'ProTime' => '',
    			'ProPrice' => NULL,
    	), "ProTime < $Times");
    	Yii::log(date('Y-m-d H:i:s') . " [DealerPromotion] end \n", 'info', 'command');
    	echo date('Y-m-d H:i:s') . " [DealerPromotion] result:".$count."\n";
    }
}