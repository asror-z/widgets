<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\builder;

use zetsoft\dbitem\wdg\MenuItem;
use zetsoft\models\shop\ShopCategory;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZMetisMenuWidget
 * https://cdnjs.com/libraries/metisMenu //cdn assets
 * https://github.com/onokumus/metismenu //GitHub
 * @author MurodovMirbosit, Ravshan Davlatov, Yosin Obidov
 */
class  ZBuilderWidgetA extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        
    ];

    
    /**
     *
     * Plugin Events
     */
    public $event = [];
    public $_event = [

    ];


    public function asset()
    {
           $this->fileCss('/render/builder/ZBuilderWidgetA/assets/main.css');

           $this->fileJs('/render/builder/ZBuilderWidgetA/assets/main.js');
    }



    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="d-flex">
            <div class="canvas empty">
            
                <div class="d-flex">
                
                    <div class="col-md-5 empty border"></div>
                    <div class="col-md-5 empty border"></div>
                
                </div>
            
            </div>
            
            <div class="menu">
            
                <div class="menu-open">
                
                    <a href="#" class="menu-button mx-auto menu-open--icon">
                        <i class="fal fa-bars"></i>
                    </a>
                    
                    
                    <div class="forWidgets">
                    
                    </div>
                    
                </div>
            
            </div>
        </div>
HTML,
        
        'js' => <<<JS
 
JS,

    ];

    
    public function codes()
    {
        
        $this->htm = strtr($this->_layout['main'], [
            
        ]);

        $this->js = strtr($this->_layout['js'],[]);

    }
}

