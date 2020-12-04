<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;


/**
 *
 *
 * https://github.com/archan937/animate.js
 *
 * Created By: Umarov Sunnat
 * Refactored: Umarov Sunnat
 * no cdn
 */
class ZAnimateJsWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [


    ];

    public $layout = [];
    public $_layout = [

    ];

    public function asset()
    {
        $this->fileCss('/publish/bower/hover3d/style_hover3d.css');
        //$this->fileJs('/publish/bower/hover3d/dist/js/vendor/jquery-1.12.1.min.js');
        $this->fileJs('/publish/bower/hover3d/source/js/jquery.hover3d.js');   //no cdn link for this library
    } //
 
    public function codes()
    {


            


    }

}
