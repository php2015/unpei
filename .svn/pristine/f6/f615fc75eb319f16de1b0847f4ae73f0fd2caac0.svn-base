<?php

class PrivateChat extends Cwidget {

    public function run() {
        $userid = Yii::app()->user->id;
        $organID = Yii::app()->user->getOrganID();
        $sessionlist = RemindService::getSessionList($userid);
        $logo = F::uploadUrl() . Organ::model()->findByPk($organID)->attributes['Logo'];
        $this->render('privatechat', array("userid" => $userid, "sessionlist" => $sessionlist, 'logo' => $logo));
    }

}
