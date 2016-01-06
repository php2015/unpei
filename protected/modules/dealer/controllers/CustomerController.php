
<?php

/*
 * 经销商客服控制器
 */

class CustomerController extends Controller {

    public $layout = '//layouts/news';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $UserID = Yii::app()->user->id;
        $criteria->order = 'ID DESC';
        $criteria->addCondition("Executor = " . Yii::app()->user->getOrganID());
        $criteria->addCondition("State != 1");

        //接收表单数据（查询条件）
        $title = Yii::app()->request->getParam("Title");
        $organName = Yii::app()->request->getParam("OrganName");
        $state = Yii::app()->request->getParam("State");
        if (!empty($title)) {
            $criteria->addSearchCondition("Title", "{$title}");
        }
        if (!empty($organName)) {
            $criteria->addSearchCondition("OrganName", "{$organName}");
        }
        if (!empty($state)) {
            $criteria->addCondition("State = {$state}");
        }

        $dataProvider = new CActiveDataProvider('Question', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '15'
            ),
                )
        );
        $data = $dataProvider->getData();
        foreach ($data as $key => $val) {
            $val['SubmitTime'] = date("Y-m-d h:i:s", $val['SubmitTime']);
            //状态
            if ($val['State'] == 2) {
                $val['State'] = "待解答";
            } elseif ($val['State'] == 3) {
                $val['State'] = "待反馈";
            } elseif ($val['State'] == 4) {
                $val['State'] = "完结";
            } elseif ($val['State'] == 5) {
                $val['State'] = "重新开启";
            } elseif ($val['State'] == 6) {
                $val['State'] = "待回访";
            }
            //类型
            if ($val['Type'] == 1) {
                $val['Type'] = "账号问题";
            } elseif ($val['Type'] == 2) {
                $val['Type'] = "交易问题";
            } elseif ($val['Type'] == 3) {
                $val['Type'] = "商品问题";
            } elseif ($val['Type'] == 4) {
                $val['Type'] = "数据问题";
            } elseif ($val['Type'] == 5) {
                $val['Type'] = "意见和建议";
            } elseif ($val['Type'] == 6) {
                $val['Type'] = "其他";
            }
        }
        $this->render("index", array(
            'dataProvider' => $dataProvider,
            'title' => $title,
            'organName' => $organName,
            'state' => $state
        ));
    }

    /*
     * 自己提交的问题
     */

    public function actionSelfquestion() {
        $criteria = new CDbCriteria();
        $criteria->order = 'ID DESC';
        $criteria->addCondition("Promoter = '" . Yii::app()->user->getOrganID() . "'");
        //接收表单数据（查询条件）
        $title = Yii::app()->request->getParam("Title");
        $organName = Yii::app()->request->getParam("OrganName");
        $state = Yii::app()->request->getParam("State");
        if (!empty($title)) {
            $criteria->addSearchCondition("Title", "{$title}");
        }
        if (!empty($organName)) {
            $criteria->addSearchCondition("OrganName", "{$organName}");
        }
        if (!empty($state)) {
            $criteria->addCondition("State = {$state}");
        }
        $dataProvider = new CActiveDataProvider('Question', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '15'
            ),
                )
        );
        $data = $dataProvider->getData();
        foreach ($data as $key => $val) {
            $val['SubmitTime'] = date("Y-m-d h:i:s", $val['SubmitTime']);
            //状态
            if ($val['State'] == 1) {
                $val['State'] = "待分配";
            } elseif ($val['State'] == 2) {
                $val['State'] = "待解答";
            } elseif ($val['State'] == 3) {
                $val['State'] = "待反馈";
            } elseif ($val['State'] == 4) {
                $val['State'] = "完结";
            } elseif ($val['State'] == 5) {
                $val['State'] = "重新开启";
            } elseif ($val['State'] == 6) {
                $val['State'] = "待回访";
            }
            //类型
            if ($val['Type'] == 1) {
                $val['Type'] = "账号问题";
            } elseif ($val['Type'] == 2) {
                $val['Type'] = "交易问题";
            } elseif ($val['Type'] == 3) {
                $val['Type'] = "商品问题";
            } elseif ($val['Type'] == 4) {
                $val['Type'] = "数据问题";
            } elseif ($val['Type'] == 5) {
                $val['Type'] = "意见和建议";
            } elseif ($val['Type'] == 6) {
                $val['Type'] = "其他";
            }
        }
        $this->render("selfquestion", array(
            'dataProvider' => $dataProvider,
            'title' => $title,
            'organName' => $organName,
            'state' => $state
        ));
    }

    /* 功能：判断远程文件是否存在
     * 参数： $url -远程文件URL
     * 返回：存在返回true，不存在或者其他原因返回false
     */

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
        return $found;
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
                $this->redirect("selfquestion");
            }
        }
        $this->render("submit");
    }

    /*
     * 问题详情
     */

    public function actionDetail() {
        $ID = Yii::app()->request->getParam("id");
        //问题提交
        if ($_POST['Answer']) {
            $answer = trim(Yii::app()->request->getParam('Answer'));
            if (!empty($answer) && mb_strlen($answer, 'utf8') <= 200) {
                //回答问题时 判断是否为平台用户提交，平台用户State为3，非平台为6
                $sql_find_state = 'select UserType from cs_question where ID=' . $ID;
                $query_result = Yii::app()->csdb->createCommand($sql_find_state)->queryRow();
                if ($query_result && $query_result['UserType'] == 2) {
                    $_state = 6;
                } else {
                    $_state = 3;
                }
                $result = Question::model()->updateByPk($ID, array(
                    'Answer' => htmlspecialchars($answer),
                    'AnswerTime' => time(),
                    'State' => $_state,
                        ), "State in(2,5) and Executor = " . Yii::app()->user->getOrganID()
                );
                echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
                echo "<script>alert('保存成功！');"
                . "window.location.href='" . Yii::app()->createUrl('dealer/customer/detail', array('id' => $ID)) . "'</script>";
            }
        }

        $model = Question::model()->findByPK($ID);
        $data = array();
        $data = $model->attributes;
        //问题状态
        if ($data['State'] == 1) {
            $data['StateText'] = "待分配";
        } elseif ($data['State'] == 2) {
            $data['StateText'] = "待解答";
        } elseif ($data['State'] == 3) {
            $data['StateText'] = "待反馈";
        } elseif ($data['State'] == 4) {
            $data['StateText'] = "完结";
        } elseif ($data['State'] == 5) {
            $data['StateText'] = "重新开启";
        } elseif ($data['State'] == 6) {
            $data['StateText'] = "待回访";
        }
        //问题类型
        if ($data['Type'] == 1) {
            $data['TypeText'] = "账号问题";
        } elseif ($data['Type'] == 2) {
            $data['TypeText'] = "交易问题";
        } elseif ($data['Type'] == 3) {
            $data['TypeText'] = "商品问题";
        } elseif ($data['Type'] == 4) {
            $data['TypeText'] = "数据问题";
        } elseif ($data['Type'] == 5) {
            $data['TypeText'] = "意见和建议";
        } else {
            $data['TypeText'] = "其他";
        }
        //反馈评分
        $satisfy = array('非常不满意', '不满意', '一般', '满意', '非常满意');
        $data['SatisfyText'] = $satisfy[$data['Satisfaction'] - 1];

        $data['userid'] = Yii::app()->user->id;
        $params['type'] = 1;
        $params['queid'] = $ID;
        $files = $this->getfiles($params);
        $self = Yii::app()->request->getParam("self");

        //解答人
        if ($data['Executor']) {
            if ($data['ExecutorType'] == 1)
                $data['ExecutorName'] = $this->getunipeiservice($data['Executor']);
            elseif ($data['ExecutorType'] == 2)
                $data['ExecutorName'] = $this->getorganname($data['Executor']);
        }

        //反馈评分
        if ($_POST['satisfy'] && in_array($_POST['satisfy'], array(1, 2, 3, 4, 5))) {
            $satisdesc = trim(Yii::app()->request->getParam('SatisDesc'));
            if (mb_strlen($satisdesc, 'utf8') <= 30) {
                //如果评分小于4；改为6，否则不变
                if ($_POST['satisfy'] < 4) {
                    $_state2 = 6;
                } else {
                    $_state2 = 4;
                };
                $result = Question::model()->updateByPk($ID, array(
                    'SatisfactionDesc' => htmlspecialchars($satisdesc),
                    'Satisfaction' => $_POST['satisfy'],
                    'SatisfactionTime' => time(),
                    'State' => $_state2,
                        ), "State =3 and Promoter=" . Yii::app()->user->getOrganID()
                );
                $this->redirect(array('detail', 'id' => $ID, 'self' => 1));
            }
        }
        //var_dump($data);die;

        if (!empty($self)) {
            $this->render("selfdetail", array('data' => $data, 'files' => $files));
        } else {
            $this->render("detail", array('data' => $data, 'files' => $files));
        }
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

}
