<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class HomeController extends HelpController {
    /*
     * 帮助中心首页
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "帮助中心-首页";
        $kefu = CsHelpContact::model()->find();
        $kefutel = explode(",", $kefu['TelPhone']);
        $opentime = explode(",", $kefu['OpenTime']);

        $dianhua = CsHelpContact::model()->findByPk('1'); //dianhua
        $qq = CsHelpContact::model()->findByPk('2'); //qq
        $opentime2 = explode(",", $qq['OpenTime']);  //qq服务时间

        $num = explode(",", $qq['QQ']);
        $nickname = explode(",", $qq['NickName']);
        $opentime_lms = explode(",", $qq['OpenTime']);
        if ($opentime_lms) {
            $lms_opentime = array(
                0 => array_slice($opentime_lms, 0, 4),
                1 => array_slice($opentime_lms, 4, 4),
                2 => array_slice($opentime_lms, 8, 4),
                3 => array_slice($opentime_lms, 12, 4),
                4 => array_slice($opentime_lms, 16, 4),
            );
            $fact_QQ; //要显示的QQ
            $fact_online; //在线的QQ
            $QQ_name; //QQ呢称
            foreach ($lms_opentime as $key => $value) {
                $aaa = self::getweekrelation($value);
                if ($aaa) {
                    $fact_online[$key] = $value;
                    $fact_QQ[$key] = $num[$key];
                    $QQ_name[$key] = $nickname[$key];
                }
            }
        }
        $qianbao = CsHelpContact::model()->findByPk('3'); //qq
        $this->render('index', array('kefu' => $kefu, 'nickname' => $QQ_name, 'num' => $fact_QQ, 'opentime2' => $opentime2, 'qq' => $qq, 'qianbao' => $qianbao, 'dianhua' => $dianhua, 'opentime' => $opentime, 'kefutel' => $kefutel, 'fact_online' => $fact_online));
    }

    //判断当前时间是否在规定时间内
    public static function getweekrelation($date) {
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

    /*
     * 问题类别菜单
     */

    public function actionAjaxFillTree() {
        $data = $this->actionGetmenu();
        echo str_replace(
                '"hasChildren":"0"', '"hasChildren":false', CTreeView::saveDataAsJson($data)
        );
        exit();
    }

    /*
     * 获取问题分类菜单
     */

    public function actionGetmenu() {
        //获取问题分类
        $menus = CsHelpQuestionType::model()->findAll();
        if (!empty($menus)) {
            foreach ($menus as $key => $val) {
                if (empty($val['ParentID']))
                    $val['ParentID'] = 0;
                $menu[$key]['id'] = $val['ID'];
                $menu[$key]['text'] = '<a class="type" style="cursor:pointer;">' . $val['TypeName'] . '</a>';
                $menu[$key]['parentID'] = $val['ParentID'];
            }
            $menus = self::Treearray($menu);
        } else {
            $menus[0]["id"] = 0;
            $menus[0]["text"] = "暂无问题类别";
        }
        return $menus;
    }

    /*
     * 获取问题分类菜单(添加常见问题时的下拉列表)
     */

    public function actionGetselect() {
        //获取问题分类
        $menus = CsHelpQuestionType::model()->findAll();
        if (!empty($menus)) {
            foreach ($menus as $key => $val) {
                if (empty($val['ParentID']))
                    $val['ParentID'] = 0;
                $menu[$key]['id'] = $val['ID'];
                $menu[$key]['text'] = $val['TypeName'];
                $menu[$key]['parentID'] = $val['ParentID'];
            }
            $menus = self::Treearray($menu);
        } else {
            $menus[0]["id"] = 0;
            $menus[0]["text"] = "暂无问题类别";
        }
        return $menus;
    }

    public static function Treearray($data) {
        $result = array();
        //定义索引数组，用于记录节点在目标数组的位置，类似指针
        $p = array();
        foreach ($data as $val) {
            if ($val['parentID'] == '0') {
                $i = count($result);
                $result[$i] = isset($p[$val['id']]) ? array_merge($val, $p[$val['id']]) : $val;
                $p[$val['id']] = & $result[$i];
            } else {
                $i = count($p[$val['parentID']]['children']);
                $p[$val['parentID']]['children'][$i] = $val;
                $p[$val['id']] = & $p[$val['parentID']]['children'][$i];
            }
        }
        return $result;
    }

    /*
     * 常见问题
     */

    public function actionQuestion() {
        $OrganID = Yii::app()->user->getOrganID();
        $OrganPk = Organ::model()->findByPk($OrganID);
        $this->pageTitle = Yii::app()->name . '-' . "常见问题";
        $select = $this->actionGetselect();
        $jutiques = CsHelpQuestion::model()->findAll('TypeID =:typeid', array(':typeid' => 1));
        if ($OrganPk['Identity'] == 3) {           //修理厂
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->condition = 'Status = :status';
            $criteria->order = 'CreateTime desc';
            $criteria->limit = 10;
            $criteria->params = array(':status' => 1);
            $criteria->addInCondition('part', array(0, 3));  //修理厂
            $hotques = CsHelpQuestion::model()->findAll($criteria);
        } else if ($OrganPk['Identity'] == 2) {    //经销商
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->condition = 'Status = :status';
            $criteria->order = 'CreateTime desc';
            $criteria->limit = 10;
            $criteria->params = array(':status' => 1);
            $criteria->addInCondition('part', array(0, 2));  //经销商
            $hotques = CsHelpQuestion::model()->findAll($criteria);
        } else {
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->condition = 'Status = :status';
            $criteria->order = 'CreateTime desc';
            $criteria->limit = 10;
            $criteria->params = array(':status' => 1);
            $criteria->addCondition("part = 0", "AND"); //全部
            $hotques = CsHelpQuestion::model()->findAll($criteria); //热门问题
        }
        $this->render('question', array('jutiques' => $jutiques, 'select' => $select, 'hotques' => $hotques));
    }

    /*
     * 常见问题搜索
     */

    public function actionSearchlist() {
        $this->pageTitle = Yii::app()->name . '-' . "帮助中心";
        $OrganID = Yii::app()->user->getOrganID();
        $OrganPk = Organ::model()->findByPk($OrganID);
        if ($_GET) {
            if ($OrganPk['Identity'] == 3) {  //修理厂 
                $TitleName = trim(Yii::app()->request->getParam('Title'));
                if ($TitleName) {
                    $sql = " select * from cs_help_question where Title like '%{$TitleName}%'";
                    $sql .="and Part in (0,3)";
                } else {
                    $TitleName = '';
                }
                $queslist = Yii::app()->csdb->createCommand($sql)->queryAll();
            }
            if ($OrganPk['Identity'] == 2) { //经销商
                $TitleName = trim(Yii::app()->request->getParam('Title'));
                if ($TitleName) {
                    $sql = " select * from cs_help_question where Title like '%{$TitleName}%'";
                    $sql .="and Part in (0,2)";
                } else {
                    $TitleName = '';
                }
                $queslist = Yii::app()->csdb->createCommand($sql)->queryAll();
            }
//            $TitleName = trim(Yii::app()->request->getParam('Title'));
//            if ($TitleName) {
//                $sql = " select * from cs_help_question where Title like '%{$TitleName}%'";
//            } else {
//                $TitleName = '';
//            }
//            $queslist = Yii::app()->csdb->createCommand($sql)->queryAll();
        }
        $this->render('searchlist', array('queslist' => $queslist, 'TitleName' => $TitleName));
    }

    /*
     * 点击左边菜单，获取常见问题列表
     */

    public function actionQuestionlist() {
        $OrganID = Yii::app()->user->getOrganID();
        $OrganPk = Organ::model()->findByPk($OrganID);
        $typeid = Yii::app()->request->getParam("typeid"); //ID
        if (empty($typeid)) {
            return false;
        }
        $cshequesID = CsHelpQuestionType::model()->findByPk($typeid);  //根据问题表typeID得到分类表 子类ID 
        $daleiID = CsHelpQuestionType::model()->findByPk($cshequesID['ParentID']);  //根据子类ParentID得到大类ID
        if (!empty($typeid)) {
            $childId = Yii::app()->csdb->createCommand("select ID from cs_help_question_type where ParentID = " . $typeid)->queryAll();
            $id = array();
            if (!empty($childId)) {    //大类下所有问题
                foreach ($childId as $key => $val) {
                    $id[] = $val["ID"];
                }
//                $id = "(" . rtrim($id, ",") . ")";
//                $jutiques = CsHelpQuestion::model()->findAll('TypeID in' . $id);  //不区分问题归属
                if ($OrganPk['Identity'] == 3) {
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addInCondition('TypeID', $id);
                    $criteria->addInCondition('part', array(0, 3));  //修理厂
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                } else if ($OrganPk['Identity'] == 2) {
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addInCondition('TypeID', $id);
                    $criteria->addInCondition('part', array(0, 2));  //修理厂
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                }
            } else {                //子类下所有问题
//                $jutiques = CsHelpQuestion::model()->findAll('TypeID =:typeid', array(':typeid' => $typeid)); //不区分问题归属
                if ($OrganPk['Identity'] == 2) { //经销商
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addCondition("TypeID = $typeid", "AND");
                    $criteria->addInCondition('part', array(0, 2));
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                } else if ($OrganPk['Identity'] == 3) { //修理厂
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addCondition("TypeID = $typeid", "AND");
                    $criteria->addInCondition('part', array(0, 3));
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                } else {
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addCondition("TypeID = $typeid", "AND");
                    $criteria->addCondition("part = 0", "AND"); //全部
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                }
            }
        }
        return $this->renderPartial('questionlist', array('jutiques' => $jutiques, 'cshequesID' => $cshequesID, 'daleiID' => $daleiID,));
    }

    /*
     * 快捷菜单进入
     */

//    public function actionQuestionlisttt() { //快捷分类跳转页面
//        $this->pageTitle = Yii::app()->name . '-' . "帮助中心";
//        $typeid = Yii::app()->request->getParam("typeid");
//
//        $xiaoleiID = CsHelpQuestionType::model()->findByPk($typeid); //小类数据
//        $daleiID = CsHelpQuestionType::model()->findByPk($xiaoleiID['ParentID']); //大类数据
//
//        $jutiques = CsHelpQuestion::model()->findAll('TypeID =:typeid', array(':typeid' => $typeid));
//        $this->render('questionlisttt', array('jutiques' => $jutiques, 'allchild' => $allchild, 'xiaoleiID' => $xiaoleiID, 'daleiID' => $daleiID));
//    }

    public function actionQuestionlisttt() { //快捷分类替换页面
        $this->pageTitle = Yii::app()->name . '-' . "帮助中心";
        $OrganID = Yii::app()->user->getOrganID();
        $OrganPk = Organ::model()->findByPk($OrganID);
        $typeid = Yii::app()->request->getParam("typeid");
        $xiaoleiID = CsHelpQuestionType::model()->findByPk($typeid); //小类数据
        $daleiID = CsHelpQuestionType::model()->findByPk($xiaoleiID['ParentID']); //大类数据
        if ($OrganPk['Identity'] == 3) { //修理厂
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->addCondition("TypeID = $typeid", "AND");
            $criteria->addInCondition('part', array(0, 3));
            $jutiques = CsHelpQuestion::model()->findAll($criteria);
        } else if ($OrganPk['Identity'] == 2) { //经销商
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->addCondition("TypeID = $typeid", "AND");
            $criteria->addInCondition('part', array(0, 2));
            $jutiques = CsHelpQuestion::model()->findAll($criteria);
        } else {
            $criteria = new CDbCriteria();
            $criteria->select = "*";
            $criteria->addCondition("TypeID = $typeid", "AND");
            $criteria->addCondition("part = 0", "AND"); //全部
            $jutiques = CsHelpQuestion::model()->findAll($criteria);
        }
//        $jutiques = CsHelpQuestion::model()->findAll('TypeID =:typeid', array(':typeid' => $typeid));
        return $this->renderPartial('questionlisttt', array('jutiques' => $jutiques, 'allchild' => $allchild, 'xiaoleiID' => $xiaoleiID, 'daleiID' => $daleiID));
    }

    /*
     * 获取问题详情
     */

//    public function actionQuestiondetail() {  //问题详情 跳转的页面
//        $this->pageTitle = Yii::app()->name . '-' . "帮助中心";
//        $ID = Yii::app()->request->getParam("ID");
//        $detail = CsHelpQuestion::model()->findByPk($ID);
//        $xiaoleiID = CsHelpQuestionType::model()->findByPk($detail['TypeID']);
//        $daleiID = CsHelpQuestionType::model()->findByPk($xiaoleiID['ParentID']);
//        $select = $this->actionGetselect();
//        $this->render('questiondetail', array('select' => $select, 'detail' => $detail, 'xiaoleiID' => $xiaoleiID, 'daleiID' => $daleiID,));
//    }
    public function actionQuestiondetail() { //问题详情 替换页面
        $this->pageTitle = Yii::app()->name . '-' . "帮助中心";
        $ID = Yii::app()->request->getParam("ID");
        $detail = CsHelpQuestion::model()->findByPk($ID);

        $xiaoleiID = CsHelpQuestionType::model()->findByPk($detail['TypeID']);

        $daleiID = CsHelpQuestionType::model()->findByPk($xiaoleiID['ParentID']);
        $select = $this->actionGetselect();
        return $this->renderPartial('questiondetail', array('select' => $select, 'detail' => $detail, 'xiaoleiID' => $xiaoleiID, 'daleiID' => $daleiID,));
    }

    /*
     * 提交问题(1.选择问题类型)
     */

    public function actionaddQuestion() {
        $this->pageTitle = Yii::app()->name . '-' . "提交问题";
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = 'ParentID=:ParentID';
        $criteria->params = array(':ParentID' => 0);
        $qestype = CsHelpQuestionType::model()->findAll($criteria);  //查询所有顶级分类
        $this->render('addquestion', array('questype' => $qestype));
    }

    /*
     * 提交问题（2.选择具体问题）
     */

    public function actionaddQuestion2() {
        $this->pageTitle = Yii::app()->name . '-' . "选择具体问题";
        $OrganID = Yii::app()->user->getOrganID();
        $OrganPk = Organ::model()->findByPk($OrganID);
        $TypeID = Yii::app()->request->getParam('ID');
        $qestype = CsHelpQuestionType::model()->findByPk($TypeID); //问题类型
        if (!$qestype) {
            $this->redirect(array('addquestion'));
        }
        if (!empty($TypeID)) {
            $childId = Yii::app()->csdb->createCommand("select ID from cs_help_question_type where ParentID = " . $TypeID)->queryAll();
            $id = array();
            if (!empty($childId)) {
                foreach ($childId as $key => $val) {
                    $id[] = $val["ID"];
                }
//                $id = "(" . rtrim($id, ",") . ")";
//                $jutiques = CsHelpQuestion::model()->findAll('TypeID in ' . $id); //不区分
                if ($OrganPk['Identity'] == 3) {
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addInCondition('TypeID', $id);
                    $criteria->addInCondition('part', array(0, 3));  //修理厂
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                } else if ($OrganPk['Identity'] == 2) {
                    $criteria = new CDbCriteria();
                    $criteria->select = "*";
                    $criteria->addInCondition('TypeID', $id);
                    $criteria->addInCondition('part', array(0, 2));  //修理厂
                    $jutiques = CsHelpQuestion::model()->findAll($criteria);
                }
            }
            $this->render('addquestion2', array('questype' => $qestype, 'jutiques' => $jutiques));
        } else {
            $this->redirect(array('addquestion'));
        }
    }

    /*
     * 填写表单（3.填写预约表单预约）
     */

    public function actionaddQuestion3() {
        $this->pageTitle = Yii::app()->name . '-' . "填写问题描述";
        $TypeID = Yii::app()->request->getParam('ID');

        $qestype = CsHelpQuestionType::model()->findByPk($TypeID); //问题类型
        $this->render('addquestion3', array('questype' => $qestype));

//        if (!empty($TypeID)) { //判断ID是否为空
//            $qestype = CsHelpQuestionType::model()->findByPk($TypeID); //问题类型
//            $this->render('addquestion3', array('questype' => $qestype));
//        } else {
//            $this->redirect(array('addquestion'));
//        }
    }

    /*
     * 提交问题
     */

    public function actionSubmit() {
        if ($_POST) {
            $model = new Question();
            $model->Title = Yii::app()->request->getParam("Title");
            $model->Type = Yii::app()->request->getParam("Type");
            $model->Desc = Yii::app()->request->getParam("Desc");
            $model->Promoter = Yii::app()->user->getOrganID(); //发起人
            $model->OrganName = Yii::app()->user->getOrganName();
            $model->Submitter = Yii::app()->user->id; //提交人
            $model->SubmitterType = '2';
            $model->SubmitTime = time();
            if ($model->save()) {
                $filename = Yii::app()->request->getParam('FileName');
                $filepath = Yii::app()->request->getParam('FileUrl');
                //保存附件
                if ($filepath) {
                    $queid = $model->ID;
                    $filename = explode(',;,', $filename);
                    $filepath = explode(',', $filepath);
                    $sql = 'insert into `cs_question_file` (QuesID,FileName,Path,Type,CreateTime) values ';
                    foreach ($filename as $k => $v) {
                        $sql.='( ' . $queid . ',"' . $v . '","' . $filepath[$k] . '",1,' . time() . '),';
                    }
                    $sql = rtrim($sql, ',');
                    Yii::app()->csdb->createCommand($sql)->execute();
                }
                $this->redirect("addquestion");
            }
        }
        $this->render("addquestion3");
    }

    //获取问题附件
    public function getfiles($params) {
        $sql = 'select FileName,Path,Type from `cs_question_file` where QuesID=' . $params['queid'];
        if ($params['type'])
            $sql.=' and type=' . $params['type'];
        $data = Yii::app()->csdb->createCommand($sql)->queryAll();
        $img = array('gif', 'jpg', 'png', 'bmp', 'jpeg');
        $lists = array();
        $upload = Yii::app()->params['helpPath'];
        foreach ($data as $k => $v) {
            //判断文件类型
            $lists[$k] = $v;
            $ext = pathinfo($v['FileName'], PATHINFO_EXTENSION);
            if (in_array($ext, $img)) {
                $lists[$k]['filetype'] = 1;  //图片
            } else {
                $lists[$k]['filetype'] = 2;  //文档
            }
            //判断文件是否存在
            if ($this->check_remote_file_exists($upload . 'upload/' . $v['Path']))
                $lists[$k]['exist'] = 1;
            else {
                $lists[$k]['exist'] = 0;
            }
        }
        return $lists;
    }

    //删除已上传附件
    public function actionDelfile() {
        if (Yii::app()->request->isAjaxRequest) {
            $path = Yii::app()->request->getParam('path');
            $filePath = Yii::app()->params['uploadHelpPath'] . $path;
            if (file_exists($filePath)) {
                if (unlink($filePath))
                    echo 1;
            }
        }
    }

    /*
     * 视频教学
     */

    public function actionVideo() {

        $this->pageTitle = Yii::app()->name . '-' . "视频教学";

        $id = Yii::app()->request->getParam("ID");
        if (isset($id)) {
            $model = CsHelpVideo::model()->findByPK($id);
        } else {
            $model = CsHelpVideo::model()->find(array(
                'order' => 'CreateTime DESC',
            ));
        }
//        $model->Path = $this->_getSwf($model->Path);
        if ($model) {
            $video = new VideoPath();
            $url = $model->Path;
            $contents = self::getUrl($url);
            if (false == $contents) {
                Yii::app()->user->setFlash('failed', '网络原因,访问视频失败');
                $this->redirect(array('index'));
            } else {
                $model->Path = $video->index($model->Path);
                $videolist = CsHelpVideo::model()->findAll();
            }
        }
        $this->render('video', array('videolist' => $videolist, 'model' => $model));
    }

    public static function getUrl($url) {
        $ch = curl_init();
        $timeout = 10;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contents = curl_exec($ch);
        return $contents;
    }

    /*
     * 根据用户提交的(swf/html)地址，获取优酷，土豆的swf播放地址
     * */

    private function _getSwf($url = '') {
        if (isset($url) && !empty($url)) {
            preg_match_all('/http:\/\/(.*?)?\.(.*?)?\.com\/(.*)/', $url, $types);
        } else {
            return false;
        }
        $type = $types[2][0];
        $domain = $types[1][0];
        $isswf = strpos($types[3][0], 'v.swf') === false ? false : true;
        $method = substr($types[3][0], 0, 1);

        switch ($type) {
            case 'youku' :
                if ($domain == 'player') {
                    $swf = $url;
                } else if ($domain == 'v') {
                    preg_match_all('/http:\/\/v\.youku\.com\/v_show\/id_(.*)?\.html/', $url, $url_array);
                    $swf = 'http://player.youku.com/player.php/sid/' . str_replace('/', '', $url_array[1][0]) . '/v.swf';
                } else {
                    $swf = $url;
                }
                break;
            case 'tudou' :
                if ($isswf) {
                    $swf = $url;
                } else {
                    $method = $method == 'p' ? 'v' : $method;
                    preg_match_all('/http:\/\/www.tudou\.com\/(.*)?\/(.*)?/', $url, $url_array);
                    $str_arr = explode('/', $url_array[1][0]);
                    $count = count($str_arr);
                    if ($count == 1) {
                        $url_arr = explode('.', $url_array[2][0]);
                        $id = $url_arr[0];
                    } else if ($count == 2) {
                        $id = $str_arr[1];
                    } else if ($count == 3) {
                        $id = $str_arr[2];
                    }
                    $swf = 'http://www.tudou.com/' . $method . '/' . $id . '/v.swf';
                }
                break;
            default :
                $swf = $url;
                break;
        }
        return $swf;
    }

    /*
     * 联系客服
     */

    public function actionKefu() {
        $this->pageTitle = Yii::app()->name . '-' . "联系客服";
        $Telkefu = CsHelpContact::model()->findByPk('1');
        $qq = CsHelpContact::model()->findByPk('2');

        $num = explode(",", $qq['QQ']);
        $nickname = explode(",", $qq['NickName']);
        $qqopentime = explode(",", $qq['OpenTime']);
        $isline = explode(",", $qq['TelPhone']);

        $dianhua = explode(",", $Telkefu['TelPhone']);
        $opentime = explode(",", $Telkefu['OpenTime']);
        $opentime_lms = explode(",", $qq['OpenTime']);
        if ($opentime_lms) {
            $lms_opentime = array(
                0 => array_slice($opentime_lms, 0, 4),
                1 => array_slice($opentime_lms, 4, 4),
                2 => array_slice($opentime_lms, 8, 4),
                3 => array_slice($opentime_lms, 12, 4),
                4 => array_slice($opentime_lms, 16, 4),
            );
            $fact_QQ; //要显示的QQ
            $fact_online; //在线的QQ
            $QQ_name; //QQ呢称
            foreach ($lms_opentime as $key => $value) {
                $aaa = self::getweekrelation($value);
                if ($aaa) {
                    $fact_online[$key] = $value;
                    $fact_QQ[$key] = $num[$key];
                    $QQ_name[$key] = $nickname[$key];
                }
            }
        }
        $this->render('kefu', array('Telkefu' => $Telkefu,
            'opentime' => $opentime,
            'qq' => $qq,
            'dianhua' => $dianhua,
            'num' => $num,
            'nickname' => $nickname,
            'isline' => $isline,
            'qqopentime' => $qqopentime,
            'lms_time' => $fact_online,
            'lms_qq' => $fact_QQ,
            'lms_name' => $QQ_name
        ));
    }

    /*
     * 平台规则
     */

    public function actionRule() {
        $this->pageTitle = Yii::app()->name . '-' . "平台规则";
        $rule = CsRule::model()->findAll();
        $this->render('rule', array('rule' => $rule));
    }

}
