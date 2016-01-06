<?php

Class QuotationlistService {

    //获取报价单列表
    public static function getquolists($params) {
        $organID = Yii::app()->user->getOrganID();
        $where = ' where  IfSend="2" and ServiceID=' . $organID;
        if ($params) {
            $params['organID'] = $organID;
            $where.=self::quosql($params);
        }
        $sql = 'select * from `pap_quotation`' . $where;
        $sqlcount = 'select count(*) from `pap_quotation`  ' . $where;
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by CreateTime desc ';
        $lists = new CSqlDataProvider($sql,
                        array(
                            'db' => Yii::app()->papdb,
                            'totalItemCount' => $count,
                            'pagination' => array(
                                'pageSize' => 10,
                            ),
                        )
        );
        return $lists;
    }

    //报价单查询sql拼装
    public static function quosql($params) {
        $where = '';
        if (!empty($params['no'])) {
            $where.=' and QuoSn like "%' . trim($params['no']) . '%"';
        }
        if ($params['status']) {
            $where.=' and Status="' . $params['status'] . '"';
        }
        if ($params['start']) {
            $where.=' and CreateTime>' . strtotime($params['start']);
        }
        if ($params['end']) {
            $where.=' and CreateTime<' . (strtotime($params['end']) + 3600 * 24 - 1);
        }
        return $where;
    }
    
    public static function replacehtml($data){
        if($data){
            //得到商品Id
            $result=  explode('"', $data);
            $url=$result[3];
            if($url){
                $goods_str=  explode('/', $url);
                $goosid=  array_slice($goods_str, -1,1)[0];
                $data=  str_replace($url,'javascript:void(0);', $data);
                $data=  str_replace('target','onclick', $data);
                $fun='return_lms('.$goosid.')';
                $data=  str_replace('_blank',$fun, $data); 
            }
             return $data;
        }
    }
    public static function rep_html($data){
             if($data){
            //得到商品Id
            $result=  explode('"', $data);
            $url=$result[7];
//            var_dump($url);
            if($url){
                $data=  str_replace($url,'javascript:void(0);', $data);
            }
             return $data;
        } 
    }

}

?>
