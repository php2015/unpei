<?php

class WebUser extends CWebUser {

    /**
     * @var boolean whether to enable cookie-based login. Defaults to false.
     */
    public $allowAutoLogin = true;

    /**
     * @var string|array the URL for login. If using array, the first element should be
     * the route to the login action, and the rest name-value pairs are GET parameters
     * to construct the login URL (e.g. array('/site/login')). If this property is null,
     * a 403 HTTP exception will be raised instead.
     * @see CController::createUrl
     */
    public $loginUrl = array('/user/login');

    public function getRole() {
        return $this->getState('__role');
    }

    public function getId() {
        return $this->getState('__id') ? $this->getState('__id') : 0;
    }

    protected function afterLogin($fromCookie) {
        parent::afterLogin($fromCookie);
        $this->updateSession();
        $this->updateIdentity();
        $this->recordlogintime();
        $this->recordonline();
    }

    public function updateSession() {
        $user = Yii::app()->getModule('user')->user($this->id);

        $userAttributes = array(
            'userName' => $user->UserName,
            'organID' => $user->OrganID,
            'LastVisitTime' => $user->LastVisitTime,
            'email' => $user->organ->Email,
            'createTime' => $user->organ->CreateTime,
            'identity' => $user->organ->Identity,
            'organName' => $user->organ->OrganName,
            'Province' => $user->organ->Province,
            'City' => $user->organ->City,
            'Area' => $user->organ->Area,
            'Address' => $user->organ->Address,
            'ExpirationTime' => $user->organ->ExpirationTime,
            'OrganPhone' => $user->organ->Phone,
        );
        if ($user->EmployeID) {
            $userAttributes["employeID"] = $user->EmployeID;
        }
        foreach ($userAttributes as $attrName => $attrValue) {
            $this->setState($attrName, $attrValue);
        }
    }

    public function model($id = 0) {
        return Yii::app()->getModule('user')->user($id);
    }

    public function user($id = 0) {
        return $this->model($id);
    }

    public function getUserByName($username) {
        return Yii::app()->getModule('user')->getUserByName($username);
    }

    public function getAdmins() {
        return Yii::app()->getModule('user')->getAdmins();
    }

    public function isAdmin() {
        return Yii::app()->getModule('user')->isAdmin();
    }

    public function isEmploye() {
        return $this->getState('employeID', false);
    }

    public function updateIdentity() {
        $identity = $this->identity;
        if ($identity == 1) {
            $this->setState('__isMaker', true);
        } else {
            $this->setState('__isMaker', false);
        }

        if ($identity == 2) {
            $this->setState('__isDealer', true);
        } else {
            $this->setState('__isDealer', false);
        }

        if ($identity == 3) {
            $this->setState('__isServicer', true);
        } else {
            $this->setState('__isServicer', false);
        }

        //设置机构信息
        //$organID = $this->organID;
        //$this->setState('__organID', $organID);
    }

    public function isMaker() {
        return $this->getState('__isMaker', false);
    }

    public function isDealer() {
        return $this->getState('__isDealer', false);
    }

    public function isServicer() {
        return $this->getState('__isServicer', false);
    }

    // 获取用户身份
    public function getIdentity() {
        return ($this->isMaker() ? 'maker' : ($this->isDealer() ? 'dealer' : ($this->isServicer() ? 'servicer' : 'unknown')));
    }

    // 获取机构ID
    public function getOrganID() {
        return $this->getState('organID') ? $this->getState('organID') : 0;
    }

    public function getEmployeID() {
        return $this->getState('employeID') ? $this->getState('employeID') : false;
    }

    public function getOrganName() {
        return $this->getState('organName') ? $this->getState('organName') : "";
    }

    public function getLastVisitTime() {
        return $this->getState('LastVisitTime') ? $this->getState('LastVisitTime') : "";
    }

    public function getExpirationTime() {
        return $this->getState('ExpirationTime') ? $this->getState('ExpirationTime') : "";
    }
    
    public function getOrganPhone() {
        return $this->getState('OrganPhone') ? $this->getState('OrganPhone') : "";
    }

    public function getOrganAddress() {
        if ($this->getState('Province')) {
            return array(
                'Province' => $this->getState('Province'),
                'City' => $this->getState('City'),
                'Area' => $this->getState('Area'),
                'Address' => $this->getState('Address'),
            );
        } else {
            return array();
        }
    }

    public function getLogTitle() {
        $h = date('G');
        if ($h < 11)
            $title .= '早上好';
        else if ($h < 13)
            $title .= '中午好';
        else if ($h < 18)
            $title .= '下午好';
        else
            $title .= '晚上好';

        if (!Yii::app()->user->isGuest) {
            $option = "[" . CHtml::link('退出', Yii::app()->getModule('user')->logoutUrl) . "]";
            $organName = $this->getOrganName() . ",";
            $title.= ",欢迎回来！";
        } else {
            $option = "[" . CHtml::link('登录', Yii::app()->getModule('user')->loginUrl) . "]";
            $organName = "尊敬的用户,";
            $title.= "!";
        }
        return $organName . $title . $option;
    }

    //权限控制
    public function checkAccess($operation, $params = array()) {
        if (empty(Yii::app()->user->id)) {
            // 验证是否登陆
            return false;
        }
        if ($operation == 0) {
            // 验证是否登陆
            return true;
        }
        $organID = Yii::app()->user->getOrganID();
        $employeeid = Yii::app()->user->isEmploye();
        $sql = "select RoleID  from jpd_organ_role_employees where OrganID=$organID and EmployeeID=$employeeid and Status=0";
        $roles = Yii::app()->jpdb->createCommand($sql)->queryAll();

        if (empty($roles)) {
            return false;
        }
        foreach ($roles as $val) {
            $role[] = $val['RoleID'];
        }
        $rolemenus = Yii::app()->jpdb->createCommand()
                ->select('Jurisdiction')
                ->from('jpd_organ_roles')
                ->where(array('in', 'ID', $role))
                ->queryAll();

        if (empty($rolemenus)) {
            return false;
        }
        $jurisdiction = '';
        foreach ($rolemenus as $val) {
            $jurisdiction.=$val['Jurisdiction'];
        }
        if (empty($jurisdiction)) {
            return false;
        }
        $jurisdiction = explode(',', $jurisdiction);
        $jurisdiction = array_flip(array_flip($jurisdiction));
        if (in_array($operation, $jurisdiction)) {
            return true;
        } else {
            return false;
        }
    }

    //登录之后记录登录时间
    public function recordlogintime() {
        $now = $_SERVER['REQUEST_TIME'];
        //更改上次登录时间
        $sql = 'update `jpd_user` set LastVisitTime=' . $now . ' where ID=' . $this->id;
        Yii::app()->jpdb->createCommand($sql)->execute();
        $organID = $this->getOrganID();
        $sql = 'update `jpd_organ` set LastVisitTime=' . $now . ' where ID=' . $organID;
        Yii::app()->jpdb->createCommand($sql)->execute();
    }

    //记录登录状态
    public function recordonline() {
        $sql = 'update `jpd_user` set Online=1 where ID=' . $this->id;
        return Yii::app()->jpdb->createCommand($sql)->execute();
    }

//    public function afterLogout(){
//       $sql = 'update `jpd_user` set Online=0 where ID=' . $this->id;
//       $res= Yii::app()->jpdb->createCommand($sql)->execute();
//       return $res;
//    }
}
