<?php

class MakerModule extends CWebModule {

    public $layouts = '//layouts/column1';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'maker.models.*',
            'maker.components.*',
            'maker.models.MakePartsGroupFather',
            'dealer.models.Dealer',
            'user.models.*',
            'dealer.models.DealerVehicle',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
