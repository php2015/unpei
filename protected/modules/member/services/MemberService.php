<?php

class MemberService {

    //获取无限级部门员工菜单
    public static function getmenu() {
        $organid = Yii::app()->user->getOrganID();
        if ($organid) {
            $menus = Yii::app()->jpdb->createCommand()
                    ->select('ID,DepartmentName,ParentID,Describe')
                    ->from('jpd_organ_department')
                    ->where('OrganID=:OrganID and Status=:sta', array(':OrganID' => $organid, ':sta' => '0'))
                    ->queryAll();
            $departcount = count($menus);
            if (!empty($menus)) {
                foreach ($menus as $key => $val) {
                    if (empty($val['ParentID']))
                        $val['ParentID'] = 0;
                    $menu[$key]['id'] = 'dep_' . $val['ID'];
                    $menu[$key]['text'] = '<a key="0" class="bumen">' . $val['DepartmentName'] . '</a>';
                    $menu[$key]['describe'] = $val['Describe'];
                    $menu[$key]['parentID'] = 'dep_' . $val['ParentID'];
                    $menu[$key]['type'] = 0;
                    $employee = JpdOrganEmployees::model()->findAll('DepartmentID=:dep and OrganID=:org and Status=:stau', array(
                        ':dep' => $val['ID'], ':org' => $organid, ':stau' => '0'
                    ));
                    if (!empty($employee)) {
                        foreach ($employee as $empkey => $empval) {

                            $menu[$departcount]['id'] = 'emp_' . $empval['ID'];
                            $menu[$departcount]['text'] = '<a class="part_current ren" od="' . $empval['ID'] . '" key="1">' . $empval['Name'] . '</a>';
                            $menu[$departcount]['parentID'] = 'dep_' . $val['ID'];
                            $menu[$departcount]['type'] = 1;
                            $departcount++;
                        }
                    }
                }
                $menus = self::Treearray($menu);
            } else {
                $menus[0]["id"] = 0;
                $menus[0]["text"] = "暂无部门";
            }
        } else {
            $menus[0]["id"] = 0;
            $menus[0]["text"] = "暂无部门";
        }
        return $menus;
    }

    public static function Treearray($data) {
        $result = array();
        //定义索引数组，用于记录节点在目标数组的位置，类似指针
        $p = array();

        foreach ($data as $val) {
            if ($val['parentID'] == 'dep_0') {
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
     * 获得时间
     */

    public static function gettime($createtime, $updatetime) {
        if ($updatetime > $createtime) {
            return $updatetime;
        } else {
            return $createtime;
        }
    }
    
}
