<?php

class CsService {

    //获取客服列表
    public static function getcslists($params) {
        $where = 'where OrganID=' . $params['organID'];
        $sql = 'select * from `jpd_cs_qq` ' . $where;
        $sqlcount = 'select count(*) from `jpd_cs_qq`  ' . $where;
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by ID desc ';
        if($params['type']==1){
            $lists=Yii::app()->jpdb->createCommand($sql)->queryAll();
            return $lists;
        }
        $lists = new CSqlDataProvider($sql,
                        array(
                            'db' => Yii::app()->jpdb,
                            'totalItemCount' => $count,
                            'pagination' => array(
                                'pageSize' => 5,
                            ),
                        )
        );
        return $lists;
    }

    //获取客服信息
    public static function getcsinfo($params) {
        $sql = 'select * from `jpd_cs_qq` where ID=' . $params['id'];
        if($params['check']==1){
            $sql.=' and OrganID='.$params['organID'];
            $data=Yii::app()->jpdb->createCommand($sql)->queryRow();
            if(!$data)
                throw new CHttpException(400);
            else
                return $data;
        }
        return Yii::app()->jpdb->createCommand($sql)->queryRow();
    }

    //添加客服信息
    public static function addcs($params) {
        self::check($params);
        $time = $_SERVER['REQUEST_TIME'];
        $model = new JpdCsQq;
        $model->Name = $params['Name'];
        $model->QQ = $params['QQ'];
        $model->OrganID=$params['organID'];
        $model->CreateTime = $time;
        $model->UpdateTime = $time;
        if ($model->save()) {
            echo json_encode(array('res' => 1));
            die;
        } else {
            echo json_encode($model->errors);
            die;
        }
    }

    //修改客服信息
    public static function editcs($params) {
        self::check($params);
        $time = $_SERVER['REQUEST_TIME'];
        $model = JpdCsQq::model()->updateByPk($params['ID'], array(
            'UpdateTime' => $time,
            'Name' => $params['Name'],
            'QQ' => $params['QQ']));
        echo json_encode(array('res' => $model));
        die;
    }

    //验证信息是否重复
    public static function check($params) {
        $sql = 'select ID from jpd_cs_qq where OrganID='.$params['organID'].' and ';
        $exist = array(0, 0);
        if ($params['ID']) {
            //编辑
            $nsql = ' Name="' . $params['Name'] . '" and ID!=' . $params['ID'];
            $name = Yii::app()->jpdb->createCommand($sql . $nsql)->queryRow();
            if ($name)
                $exist[0] = 1;
            $qsql = ' QQ=' . $params['QQ'] . ' and ID!=' . $params['ID'];
            $qq = Yii::app()->jpdb->createCommand($sql . $qsql)->queryRow();
            if ($qq)
                $exist[1] = 1;
        }else {
            //新建
            $nsql = ' Name="' . $params['Name'] . '"';
            $name = Yii::app()->jpdb->createCommand($sql . $nsql)->queryRow();
            if ($name)
                $exist[0] = 1;
            $qsql = ' QQ=' . $params['QQ'];
            $qq = Yii::app()->jpdb->createCommand($sql . $qsql)->queryRow();
            if ($qq)
                $exist[1] = 1;    
        }
        if($exist[0]==1||$exist[1]==1){
            echo json_encode(array('res'=>0,'name'=>$exist[0],'qq'=>$exist[1]));
            die;
        }
    }

}

?>
