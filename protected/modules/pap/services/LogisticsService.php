<?php

Class LogisticsService {

    //获取经销商物流配送列表
    public static function getlists($params) {
        $sql = 'select * from `jpd_logistics` ';
        $sqlcount = 'select count(*) from `jpd_logistics`  ';
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by ID desc ';
        $lists = new CSqlDataProvider($sql,
                        array(
                            'db' => Yii::app()->jpdb,
                            'totalItemCount' => $count,
                            'pagination' => array(
                                'pageSize' => 5,
                            ),
                        )
        );
        $datas = $lists->getData();
        foreach ($datas as $k => $data) {
            $datas[$k]['area'] = self::getlogarea($data['ID']);
        }
        $lists->setData($datas);
        return $lists;
    }

    //获取物流配送区域
    public static function getlogarea($logid) {
        $sql = 'select Province,City,Area from `jpd_logistics_area` where LogID=' . $logid;
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $lists = array();
        foreach ($datas as $k => $v) {
            $lists[$k]['p'] = $v['Province'];
            $lists[$k]['c'] = $v['City'];
            $lists[$k]['a'] = $v['Area'];
            $lists[$k]['address'] = self::getarea($lists[$k]);
        }
        return $lists;
    }

    //获取物流配送地址
    public static function getarea($params) {
        if ($params['p'] != 0) {
            $provinceinfo = Area::model()->findByPk($params['p']);
            if ($provinceinfo) {
                $address.=$provinceinfo['Name'];
                if ($params['c'] != 0) {
                    $cityinfo = Area::model()->findByPk($params['c']);
                    if ($cityinfo) {
                        $address.=' ' . $cityinfo['Name'];
                        if ($params['a'] != 0) {
                            $areainfo = Area::model()->findByPk($params['a']);
                            $address.=' ' . $areainfo['Name'];
                        }
                    }
                }
            }
        } else {
            $address = '全国';
        }
        return $address;
    }

    //添加物流配送
    public static function addwuliu($params) {
        $time = time();
        //$exist['organID']=$params['organID'];
        $exist['name']=$params['name'];
        self::nameexist($exist);
        //添加物流配送
        //$data['OrganID'] = $params['organID'];
        $data['LogisticsCompany'] = $params['name'];
        $data['LogisticsDescription'] = $params['desc'];
        $data['Status'] = 2;
        $data['CreateTime'] = $time;
        $data['UpdateTime'] = $time;
        $result = Yii::app()->jpdb->createCommand()->insert('jpd_logistics', $data);
        $ID = Yii::app()->jpdb->getLastInsertID();
        //物流配送区域处理
        $p = explode(',', $params['p']);
        $c = explode(',', $params['c']);
        $a = explode(',', $params['a']);
        $area = array();
        foreach ($p as $k => $v) {
            $area[$k]['p'] = $v;
            $area[$k]['c'] = $c[$k];
            $area[$k]['a'] = $a[$k];
        }
        $list['LogID'] = $ID;
        $list['CreateTime'] = $time;
        $list['UpdateTime'] = $time;
        foreach ($area as $vv) {
            $list['Province'] = $vv['p'];
            $list['City'] = $vv['c'];
            $list['Area'] = $vv['a'];
            $result = Yii::app()->jpdb->createCommand()->insert('jpd_logistics_area', $list);
        }
        $res = Yii::app()->jpdb->getLastInsertID();
        if ($res) {
            echo json_encode(array('res' => 1));
            exit;
        } else {
            echo json_encode(array('res' => 0));
            exit;
        }
    }

    //获取物流信息
    public static function getwuliuinfo($params) {
        $sql = 'select * from `jpd_logistics` where ID=' . $params['logid'];
        $datas = Yii::app()->jpdb->createCommand($sql)->queryRow();
        $datas['area'] = self::getlogarea($datas['ID']);
        return $datas;
    }

    //编辑物流配送
    public static function editwuliu($params) {
        $time = time();
        //$exist['organID']=$params['organID'];
        $exist['name']=$params['name'];
        $exist['logid']=$params['logid'];
        self::nameexist($exist);
        //添加物流配送
        $data['LogisticsCompany'] = $params['name'];
        $data['LogisticsDescription'] = $params['desc'];
        $data['UpdateTime'] = $time;
        $result = Yii::app()->jpdb->createCommand()->update('jpd_logistics', $data, 'ID=' . $params['logid']);
        //物流配送区域处理
        $p = explode(',', $params['p']);
        $c = explode(',', $params['c']);
        $a = explode(',', $params['a']);
        $area = array();
        foreach ($p as $k => $v) {
            $area[$k]['p'] = $v;
            $area[$k]['c'] = $c[$k];
            $area[$k]['a'] = $a[$k];
        }
        $olddata = JpdLogisticsArea::model()->findAll('LogID=' . $params['logid']);
        foreach ($olddata as $key => $v) {
            if (isset($area[$key])) {
                //更新
                $v->Province = $area[$key]['p'];
                $v->City = $area[$key]['c'];
                $v->Area = $area[$key]['a'];
                $v->save();
            } else {
                //删除
                JpdLogisticsArea::model()->deleteByPk($v->ID);
            }
        }
        //添加新的配送地区
        if (count($olddata) < count($area)) {
            $newarea = array_slice($area, count($olddata));
            $list['LogID'] = $params['logid'];
            $list['CreateTime'] = $time;
            $list['UpdateTime'] = $time;
            foreach ($newarea as $vv) {
                $list['Province'] = $vv['p'];
                $list['City'] = $vv['c'];
                $list['Area'] = $vv['a'];
                $result = Yii::app()->jpdb->createCommand()->insert('jpd_logistics_area', $list);
            }
        }
        if ($result) {
            echo json_encode(array('res' => 1));
            exit;
        } else {
            echo json_encode(array('res' => 0));
            exit;
        }
    }

    //删除物流配送
    public static function delwuliu($logid) {
        $res = JpdLogisticsArea::model()->deleteAll('LogID=' . $logid);
        $count = Logistics::model()->deleteByPk($logid);
        echo json_encode(array('count' => $count + $res));
    }
    
    //物流公司名称是否重复
    public static function nameexist($params){
        $sql='select ID from `jpd_logistics` where';
        if($params['logid']){
            $sql.=' ID!='.$params['logid'].' and LogisticsCompany ="'.$params['name'].'"';
        }else{
            $sql.=' LogisticsCompany ="'.$params['name'].'"';
        }
        $res=Yii::app()->jpdb->createCommand($sql)->queryRow();
        if($res){
            echo json_encode(array('res' => 2,'msg'=>'物流公司名称已存在!'));
            exit;
        }
    }

}

?>
