<?php

class PartsService {

    //查询厂家车型对应主组
    public static function queryChildGroups($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        $modelId = $params['modelId'];
        $groupId = empty($params['groupId']) ? 0 : $params['groupId'];
        $sql = "select a.groupid as groupId, a.name as name, a.haschildren as hasChildren"
                . " from {{epc_group}} a"
                . " where a.modelid = :modelid and a.parentid = :parentid order by a.groupid";
        $sqlParams = array(':modelid' => $modelId, ':parentid' => $groupId);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

    //查询子组信息
    public static function queryGroupInfo($params) {
        if (!isset($params['groupId']) || empty($params['groupId'])) {
            return null;
        }
        $groupId = $params['groupId'];
        //权限信息
        $hasPerm = ($params['hasPerm'] === true) ? true : false;
        $picture = "concat(TRIM('/' from picturepath),'/',a.picture)"; //此处为未授权用户查看到的图片的地址
        if ($hasPerm) {
            $picture = "concat(TRIM('/' from picturepath),'/',a.picture)";
        }

        //子组信息
        $sql = "select a.groupid as groupId, a.name as name, $picture as picture"
                . " ,a.note, a.applicableModel, a.modelid as modelId"
                . " ,a.parentid as groupPid"
                . " from {{epc_group}} a"
                . " where a.groupid = :groupid";
       
        $sqlParams = array(':groupid' => $groupId);
        $groupInfo = DBUtil::query($sql, $sqlParams);
        return $groupInfo;
    }

    //查询子组包含的配件列表信息
    public static function queryGroupParts($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        if (!isset($params['groupId']) || empty($params['groupId'])) {
            return null;
        }
        $modelId = $params['modelId'];
        $groupId = $params['groupId'];

        //配件列表信息
        $sql = "select a.partid as partId, a.name as name, a.oeno as n_oeno, concat(left(a.oeno,2),'****',right(a.oeno,2)) as oeno, "
                . " a.amount, a.note, a.markNo"
                . "  from {{epc_parts}} a"
                . "  where a.groupid = :groupid"
                . " group by a.partid";
        $sqlParams = array(':groupid' => $groupId);
        $parts = DBUtil::queryAll($sql, $sqlParams);
        return $parts;
    }

    //查询子组包含的配件列表信息
    public static function queryGroupPartOenos($params) {
        if (!isset($params['groupId']) || empty($params['groupId'])) {
            return null;
        }
        $groupId = $params['groupId'];

        //配件列表信息
        $sql = "select a.oeno as oeno "
                . "  from {{epc_parts}} a"
                . "  where a.groupid = :groupid";
        $sqlParams = array(':groupid' => $groupId);
        $oenos = DBUtil::queryAll($sql, $sqlParams);
        return $oenos;
    }

    //配件详细信息
    public static function queryPartInfo($params) {
        //检查参数
        if (!isset($params['partId']) || empty($params['partId'])) {
            return null;
        }
        $partId = $params['partId'];
        $sql = "select a.partid as partId, a.name as name, a.oeno as oeno, a.amount as amount,"
                . " a.jpid as jpno, a.price as price, concat(TRIM('/' from picturepath),'/',a.picture) as picture"
                . " ,a.markNo, a.note, a.specification, a.beginyear, a.endyear, a.applicableModel, a.groupid as groupId"
                . " from {{epc_parts}} a where a.partid = :partid";
        $sqlParams = array(':partid' => $partId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

    //依据OE号查询配件
    public static function queryPartsByOeno($params) {
        //检查参数
        if (!isset($params['oeno']) || empty($params['oeno'])) {
            return null;
        }
        //查询参数
        $oeno = $params['oeno'];
       
        $makeId = $params['makeId'];

        //查询配件
        $sql = " select a.partid as partId, a.name as partName,a.oeno as n_oeno, concat(left(a.OENO,2),'****',right(a.OENO,2)) as oeno, a.jpid as jpno, "
                . " d.name as makeName, c.modelid as modelId, c.name as modelName, b.groupid as subGroupId, b.name as subGroupName, "
                . " (select g.name from jpd_epc_group g where g.groupid = b.parentid) as mainGroupName"
                . " from jpd_epc_parts a, jpd_epc_group b, jpd_epc_model c, jpd_epc_makes d"
                . " where a.groupid = b.groupid "
                . "   and b.modelid = c.modelid"
                . "   and c.makeid = d.makeid";
        //增加oe号条件
        if (strpos($oeno, '*') !== false) {
            $oeno = str_replace('*', '%', $oeno);
            $sql .= " and a.oeno like :oeno";
        } else {
            $sql .= " and a.oeno = :oeno";
        }
        $sqlParams = array(':oeno' => $oeno);
      
        //增加厂商条件
        if (!empty($makeId)) {
            $sql .= " and c.makeid = :makeid";
            $sqlParams[':makeid'] = $makeId;
        }
        $sql .= " limit 51";
       
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

    //依据配件名称或首字母模糊查询配件信息
    public static function queryPartsByPartname($params) {
        //检查参数
        if (!isset($params["partname"]) || empty($params["partname"])) {
            return null;
        }
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        //查询参数
        $partname = $params["partname"];
        $modelId = $params["modelId"];

        //查询配件
        $sql = " select a.partid as partId, a.name as partName,a.oeno as n_oeno, concat(left(a.OENO,2),'****',right(a.OENO,2)) as oeno, a.jpid as jpno, "
                . " d.name as makeName, c.modelid as modelId, c.name as modelName, b.groupid as subGroupId, b.name as subGroupName, "
                . " (select g.name from {{epc_group}} g where g.groupid = b.parentid) as mainGroupName"
                . " from {{epc_parts}} a, {{epc_group}} b, {{epc_model}} c, {{epc_makes}} d"
                . " where a.groupid = b.groupid "
                . "   and b.modelid = c.modelid"
                . "   and c.makeid = d.makeid"
                . "   and (a.name like :partname or a.ename like :partcname ) ";
        $partname = '%' . $partname . '%';
        $sqlParams = array(':partname' => $partname, ':partcname' => $partname);
        if (!empty($modelId)) {
            $sql .= " and c.modelid = :modelid";
            $sqlParams[':modelid'] = $modelId;
        }
        $sql .= " limit 51";
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

}