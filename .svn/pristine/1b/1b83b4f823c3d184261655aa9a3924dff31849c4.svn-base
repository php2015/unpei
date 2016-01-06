<?php

class DealerModule extends CWebModule {

    public $layouts = '//layouts/column1';

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'dealer.models.*',
            'servicer.models.*',
            'maker.models.*',
            'member.models.*',
            'dealer.components.*',
            'pap.services.*',
            'maker.models.MakePartsGroupFather'
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
