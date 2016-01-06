<?php
class CommonAction{
	public function Dynamiccities() {
        echo $_GET['province'];
        $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $_GET['province']));

        $data = CHtml::listData($data, "id", "name");
        echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        foreach ($data as $value => $name) {
            echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
        }
    }

    public function Dynamicdistrict() {
        if ($_GET["city"]) {
            $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $_GET["city"]));

            $data = CHtml::listData($data, "id", "name");
            echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }
}