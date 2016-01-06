<?php

class ServicequestionController extends Controller {

    public $layout = '//layouts/news';

//新建问题页面
    public function actionNewquestion() {

        $this->render('newquestion');
    }

    /*
     * 待解决问题页
     */

    public function actionWait() {
        $main = self::ismain(Yii::app()->user->id);
        if ($main) {
            $sql = 'select ID,Title,Type,SubmitTime from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and State in(1,2) order by SubmitTime desc';
        } else {
            $sql = 'select ID,Title,Type,SubmitTime from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and Submitter=' . Yii::app()->user->id . ' and State in(1,2) order by SubmitTime desc';
        }
        $aps = Yii::app()->csdb->createCommand($sql)->queryAll();
        $arr = array();
        if ($aps) {
            foreach ($aps as $key => $value) {
                $value['SubmitTime'] = date('Y-m-d H:i:s', $value['SubmitTime']);
                $value['Type'] = self::gettype($value['Type']);
                $arr[$key] = $value;
                $arr[$key]['caozuo'] = '<a href="' . Yii::app()->baseUrl . '/servicer/servicequestion/questiondetail/ID/' . $value['ID'] . '">操作</a>';
            }
        }
//        var_dump($arr);exit;
        $data = new CArrayDataProvider($arr, array(
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('wait', array('data' => $data));
    }

    /*
     * 已回复问题页
     */

    public function actionAnswer() {
        $main = self::ismain(Yii::app()->user->id);
        if ($main) {
            $sql = 'select ID,Title,Type,SubmitTime,AnswerTime,Satisfaction,State from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and State in(3,4,6) order by SubmitTime desc';
        } else {
            $sql = 'select ID,Title,Type,SubmitTime,AnswerTime,Satisfaction,State from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and Submitter=' . Yii::app()->user->id . ' and State in(3,4,6) order by SubmitTime desc';
        }
        $aps = Yii::app()->csdb->createCommand($sql)->queryAll();
        $arr = array();
        if ($aps) {
            foreach ($aps as $key => $value) {
                $value['SubmitTime'] = date('Y-m-d H:i:s', $value['SubmitTime']);
                $value['AnswerTime'] = date('Y-m-d H:i:s', $value['AnswerTime']);
                $value['Type'] = self::gettype($value['Type']);
                if ($value['State'] == 3 && $value['Satisfaction'] < 4)
                    $value['Satisfaction'] = '待评价';
                else
                    $value['Satisfaction'] = self::getsatisf($value['Satisfaction']);
                $arr[$key] = $value;
                $arr[$key]['caozuo'] = '<a href="' . Yii::app()->baseUrl . '/servicer/servicequestion/questiondetail/ID/' . $value['ID'] . '">操作</a>';
            }
        }
        $data = new CArrayDataProvider($arr, array(
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('answer', array('data' => $data));
    }

    /*
     * 重新打开问题页
     */

    public function actionReopen() {
        $main = self::ismain(Yii::app()->user->id);
        if ($main) {
            $sql = 'select ID,Title,Type,SubmitTime,AnswerTime,Satisfaction,Submitter,Promoter from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and State=5 order by SubmitTime desc';
        } else {
            $sql = 'select ID,Title,Type,SubmitTime,AnswerTime,Satisfaction,Submitter,Promoter from cs_question where Promoter=' . Yii::app()->user->getOrganID() . ' and Submitter=' . Yii::app()->user->id . ' and State=5 order by SubmitTime desc';
        }
        $aps = Yii::app()->csdb->createCommand($sql)->queryAll();
        $arr = array();
        if ($aps) {
            foreach ($aps as $key => $value) {
                $value['SubmitTime'] = date('Y-m-d H:i:s', $value['SubmitTime']);
                $value['AnswerTime'] = date('Y-m-d H:i:s', $value['AnswerTime']);
                $value['Type'] = self::gettype($value['Type']);
                $value['Satisfaction'] = self::getsatisf($value['Satisfaction']);
                $value['Submitter'] = self::getOrgan($value['Promoter']);
                $arr[$key] = $value;
                $arr[$key]['caozuo'] = '<a href="' . Yii::app()->baseUrl . '/servicer/servicequestion/questiondetail/ID/' . $value['ID'] . '">操作</a>';
            }
        }
        $data = new CArrayDataProvider($arr, array(
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('reopen', array('data' => $data));
    }

    function ismain($id) {
        $sql = 'select OrganID from jpd_user where ID=' . $id;
        $result = Yii::app()->jpdb->createCommand($sql)->queryRow();
        if ($result && $result['OrganID'] == Yii::app()->user->getOrganID()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionQuestiondetail() {
        $show = false;
        $organID = yii::app()->user->getOrganID();
        $id = Yii::app()->request->getParam('ID');
        if (!$id) {
            throw new Exception('404');
        }
        $result = 'select * from cs_question where ID=' . $id;
        $arr = Yii::app()->csdb->createCommand($result)->queryRow();
        //获取问题附件信息
        $sql_file = 'select * from cs_question_file where Type=1 and QuesID=' . $id;
        $fileall = Yii::app()->csdb->createCommand($sql_file)->queryAll();
        if ($fileall) {
            $fileall = self:: getfiles($fileall);
        }

        //获取反馈附件信息
        $sql_file_answer = 'select * from cs_question_file where Type=2 and QuesID=' . $id;
        $file_answer = Yii::app()->csdb->createCommand($sql_file_answer)->queryAll();
        if ($file_answer) {
            $file_answer = self:: getfiles($file_answer);
        }
        $arr['Type'] = self::gettype($arr['Type']);
        // $arr['SubmitTime']=$arr['SubmitTime']?date('Y-m-d H:i:s',$arr['SubmitTime']):'';
        // $arr['AnswerTime']=$arr['AnswerTime']?date('Y-m-d H:i:s',$arr['AnswerTime']):'';
        if ($arr && $arr['Promoter'] != $organID) {
            throw new Exception('404', '没有权限');
        }
        if ($arr['Executor']) {
            if ($arr['ExecutorType'] == 1)
                $arr['ExecutorName'] = self::getunipeiservice($arr['Executor']);
            elseif ($arr['ExecutorType'] == 2)
                $arr['ExecutorName'] = self::getorganname($arr['Executor']);
        }
        $this->render('questiondetail', array(
            'data' => $arr,
            'files' => $fileall,
            'answerfile' => $file_answer
        ));
    }

    //判断文件类型，判断是否存在
    public function getfiles($data) {
        $img = array('gif', 'jpg', 'png', 'bmp', 'jpeg');
        $lists = array();
        $upload = Yii::app()->params['ftpserver']['visiturl'];
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
//            if (self::check_remote_file_exists($upload. $v['Path'])){
//                $lists[$k]['exist'] = 1;
//            }else {
//                $lists[$k]['exist'] = 0;
//            }
        }
        return $lists;
    }

    function check_remote_file_exists($url) {
        $curl = curl_init($url);
        //不取回数据
        curl_setopt($curl, CURLOPT_NOBODY, true);
        //发送请求
        $result = curl_exec($curl);
        $found = false;
        if ($result !== false) {
            //检查http响应码是否为200
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                $found = true;
            }
        }
        curl_close($curl);
        return 1;
    }

    //获取嘉配客服名称
    public function getunipeiservice($id) {
        $sql = 'select UserName from cs_user where ID=' . $id;
        $data = Yii::app()->csdb->createCommand($sql)->queryRow();
        return $data['UserName'];
    }

    //获取机构名称
    public function getorganname($id) {
        $sql = 'select OrganName from jpd_organ where ID=' . $id;
        $data = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $data['OrganName'];
    }

    //保存评价
    public function actionSavexin() {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getParam('ID');
            $xin = Yii::app()->request->getParam('satisfy');
            $SatisDesc = Yii::app()->request->getParam('SatisDesc');
            $sql = 'select Satisfaction,Promoter from cs_question where ID=' . $id;
            $data = Yii::app()->csdb->createCommand($sql)->queryRow();
            if ($data['Promoter'] != Yii::app()->user->getOrganID()) {
                throw new Exception('404');
            }
            // if($data['Satisfaction']){
            //     echo json_encode(array('success'=>false,'message'=>'您已评价过'));
            //     exit;
            // }
            if ($xin < 4) {
                $_state = 6;
            } else {
                $_state = 4;
            }
            $result = Yii::app()->csdb->createcommand()->update('cs_question', array('Satisfaction' => $xin, 'SatisfactionDesc' => $SatisDesc, 'State' => $_state, 'SatisfactionTime' => time()), 'ID=:ID', array(':ID' => $id));
            if ($result == 1) {
                echo json_encode(array('success' => true, 'message' => '评价成功'));
            } else {
                echo json_encode(array('success' => false, 'message' => '保存失败'));
            }
        }
    }

    public function actionDelfile() {
        $filepath = Yii::app()->params['uploadHelpPath'] . $_POST['path'];
        if (file_exists($filepath)) {
            if (unlink($filepath))
                echo 1;
        }
    }

    //保存问题
    public function actionSavequestion() {
        $organID = Yii::app()->user->getOrganID();
        $sql_find = 'select * from jpd_organ where ID=' . $organID;
        $organinfo = Yii::app()->jpdb->createCommand($sql_find)->queryRow();
        $data = array(
            'Type' => $_POST['Type'],
            'Title' => $_POST['Title'],
            'Desc' => $_POST['Desc'],
            'State' => 1,
            'Promoter' => $organID,
            'OrganName' => $organinfo['OrganName'],
            'Phone' => $organinfo['Phone'],
            'Email' => $organinfo['Email'],
            'QQ' => $organinfo['QQ'],
            'UserType' => 1,
            'Submitter' => Yii::app()->user->id,
            'SubmitTime' => time(),
            'SubmitterType' => '2'
        );
        $arr = Yii::app()->csdb->createCommand()->insert('cs_question', $data);
        if ($arr == 1) {
            $insertID = Yii::app()->csdb->getLastInsertID();
            if (!empty($_POST['files'])) {
                foreach ($_POST['files'] as $key => $val) {
                    $filedata = array(
                        'QuesID' => $insertID,
                        'FileName' => $val[0],
                        'Path' => $val[1],
                        'Type' => 1,
                        'CreateTime' => time()
                    );
                    Yii::app()->csdb->createCommand()->insert('cs_question_file', $filedata);
                }
            }
            echo json_encode(array('success' => true, 'message' => '保存成功'));
        } else {
            echo json_encode(array('success' => false, 'message' => '保存失败'));
        }
    }

    //附件下载
    public function actionImport() {
        $fileurl = Yii::app()->request->getParam('fileurl');
        $filename = Yii::app()->request->getParam('filename');
        if ($fileurl) {
            $fileurl = substr($fileurl, 7);
            $file = Yii::app()->params['uploadHelpPath'] . $fileurl;
            if (is_file($file)) {
                $ua = $_SERVER["HTTP_USER_AGENT"];
                $encoded_filename = urlencode($filename);
                $encoded_filename = str_replace("+", "%20", $encoded_filename);
                header('Content-Type: application/octet-stream');
                if (preg_match("/MSIE/", $ua) || preg_match("/Trident\/7.0/", $ua)) {
                    header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
                } else if (preg_match("/Firefox/", $ua)) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
                } else {
                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                }
                readfile($file);
                exit;
            } else {
                echo json_encode(array('fail' => "文件不存在或路径错误！"));
            }
        } else {
            echo json_encode(array('fail' => "文件不存在或路径错误！"));
        }
    }

    //重新打开操作
    // public function  actionCxdk(){
    //     if(Yii::app()->request->isAjaxRequest){
    //         $id=Yii::app()->request->getParam('ID');
    //         if($id){
    //             $sql='select State from cs_question where ID='.$id.' and Promoter='.Yii::app()->user->getOrganID();
    //             $result=Yii::app()->csdb->createCommand($sql)->queryRow();
    //             if($result && $result['State']==3){
    //               $excut=  Yii::app()->csdb->createCommand()->update('cs_question',array('State'=>5),'ID=:ID',
    //                       array(
    //                           ':ID'=>$id
    //                       ));
    //               if($excut==1){
    //                    echo json_encode(array('success'=>true,'message'=>'已重新打开')); 
    //               }else{
    //                    echo json_encode(array('success'=>false,'message'=>'重新打开失败')); 
    //               }
    //               }else{
    //                 echo json_encode(array('success'=>false,'message'=>'重新打开失败'));
    //             }
    //         }
    //     }
    // }
    private function gettype($code) {
        $data = array(
            1 => '账号问题',
            2 => '交易问题',
            3 => '商品问题',
            4 => '数据问题',
            5 => '意见和建议问题',
            6 => '其他',
        );
        if ($data[$code])
            return $data[$code];
    }

    private function getsatisf($code) {
        $data = array(
            0 => '待评价',
            1 => '非常不满意',
            2 => '不满意',
            3 => '一般',
            4 => '满意',
            5 => '非常满意',
        );
        if (!$code) {
            return $data[0];
        } else {
            if ($data[$code])
                return $data[$code];
        }
    }

    private function getOrgan($id) {
        $sql = 'select OrganName from jpd_organ where ID=' . $id;
        $result = Yii::app()->jpdb->Createcommand($sql)->queryRow();
        if ($result) {
            return $result['OrganName'];
        }
    }

}
