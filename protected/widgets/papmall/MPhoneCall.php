<?php

class MPhoneCall extends CWidget {

//     数据源格式 
//     2、QQ号码=>昵称
//       $data = array(   
//        '123456' => '小李'
//    );
    public $data;
    public $phone; //电话号码
    public $servicetime; //服务时间

    public function run() {
        //添加默认值
        if (empty($this->data)) {
            $sql2 = 'select OpenTime,NickName,QQ from cs_help_contact where ID=2';
            $result2 = Yii::app()->csdb->createCommand($sql2)->queryRow();
            if ($result2) {
                $opentime = explode(',', $result2['OpenTime']);
                $name = explode(',', $result2['NickName']);
                $QQ = explode(',', $result2['QQ']);
                $lms_opentime = array(
                    0 => array_slice($opentime, 0, 4),
                    1 => array_slice($opentime, 4, 4),
                    2 => array_slice($opentime, 8, 4),
                    3 => array_slice($opentime, 12, 4),
                    4 => array_slice($opentime, 16, 4),
                );
                $this_data;
                foreach ($lms_opentime as $key => $value) {
                    $aaa = self::getweekrelation($value);
                    if ($aaa) {
                        $this_data[$QQ[$key]] = $name[$key];
                    }
                }
                $this->data = $this_data;
            }
        }
        $this->render('headcustomer', array(
            'datainfo' => $this->data,
            'phoneinfo' => $this->phone,
            'datetimeinfo' => $this->servicetime
        ));
    }

    //判断当前时间是否在规定时间内
    public function getweekrelation($date) {
        $result = false;
        $weekarray = array("日", "一", "二", "三", "四", "五", "六");
        $week = '周' . $weekarray[date('w', time())];
        $ars = array(
            '周一' => 1,
            '周二' => 2,
            '周三' => 3,
            '周四' => 4,
            '周五' => 5,
            '周六' => 6,
            '周日' => 7
        );
        $today = $ars[$week];
        $hour = date('H', time());
        $msg2 = explode(':', $date[2]);
        $msg3 = explode(':', $date[3]);
        $date[2] = $msg2 ? $msg2[0] : '';
        $date[3] = $msg3 ? $msg3[0] : '';
        if ($date[2] <= $hour && $date[3] > $hour) {
            if ($ars[$date[0]] <= $ars[$date[1]]) {//如果规定时间不跨过星期日
                if ($ars[$date[0]] <= $today && $ars[$date[1]] >= $today) {
                    $result = true;
                }
            } else {//如果规定时间跨过星期日
                if ($ars[$date[0]] >= $today && $ars[$date[1]] >= $today) {
                    $result = true;
                }
            }
        }

        return $result;
    }

}
