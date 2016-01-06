<?php
/*
 * 积分统计
 */
class RecordController extends Controller {

    public function actionIndex(){
        $identity = Yii::app()->user->identity;
        $OrganID = Yii::app()->user->getOrganID();
        $model = User::model()->with('organ')->findByPk(Yii::app()->user->id);
        if($identity == 3){
            $modelname = "jpd_llegal_record_service";
        }  else {
            $modelname = "jpd_llegal_record_dealer";
        }
        $sql = "SELECT a.*, c.Behavior, b.OrganName, b.Identity, d.`Name` FROM " . $modelname . " AS a 
                LEFT JOIN jpd_organ AS b ON a.OrganID = b.ID LEFT JOIN jpd_irregular AS c on a.SettingsID = c.ID 
                LEFT JOIN jpd_irregular_item AS d ON c.ItemID = d.ID
                WHERE a.IsDelete = 0 AND a.Status = 1 AND c.`Status` = 1 AND a.OrganID = '{$OrganID}' Order By a.CreateTime DESC";
        $data = Yii::app()->jpdb->createCommand($sql)->queryAll();
        foreach ($data as $key => $val) {
            $data[$key]['ListNumber'] = "第" . $val['ListNumber'] . "次";
        }
        $dataProvider = self::getdataprovider($data);
        $totalmodel = LlegalRecord::model()->find("OrganID = '{$OrganID}'");
        if (empty($totalmodel)) {
            $totalmodel = new LlegalRecord();
            $totalmodel->OrganID = $OrganID;
            $totalmodel->save();
        }
        $TotalScore = $totalmodel->TotalScore;
        $this->render('index', array("model"=>$model, "dataProvider" => $dataProvider, "TotalScore" => $TotalScore));
    }
    
    /*
     * 扣分申请表详情
     */
    public function actionDetail(){
        $OrganID = Yii::app()->user->getOrganID();
        $id = Yii::app()->request->getParam('id');
        $Identity = Yii::app()->request->getParam('Identity');
        if ($Identity == 3) {
            $modelname = "jpd_llegal_record_service";
        } else {
            $modelname = "jpd_llegal_record_dealer";
        }
        $sql = "SELECT b.OrganName, b.Identity, b.UnionID, c.Behavior, e.Name AS itemName, a.* 
                FROM " . $modelname . " AS a LEFT JOIN jpd_organ AS b ON a.OrganID = b.ID LEFT JOIN jpd_irregular AS c on a.SettingsID = c.ID 
                LEFT JOIN jpd_irregular_item AS e ON c.ItemID = e.ID
                WHERE a.IsDelete = 0 AND a.ID = '{$id}' AND c.`Status` = 1";
        $data = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $TotalScore = LlegalRecord::model()->find("OrganID = '{$OrganID}'")->TotalScore;
        if(!$TotalScore){$TotalScore = 100;}
        $this->render('detail',array("data"=>$data[0],"TotalScore"=>$TotalScore));
    }
    
    //运用数组生成dataprovider数据源
    public static function getdataprovider($data) {
        $dataProvider = new CArrayDataProvider($data, array(
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
        return $dataProvider;
    }
}
