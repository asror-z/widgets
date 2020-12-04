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
class  ZBuilderWidgetF extends ZWidget
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
           $this->fileCss('/render/builder/ZBuilderWidgetF/assets/main.css');

           $this->fileJs('/render/builder/ZBuilderWidgetF/assets/main.js');
           $this->fileJs('https://cdn.jsdelivr.net/npm/slideout@1.0.1/dist/slideout.min.js');
    }



    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div class="d-flex">
            <div class="canvas">
            <button class="btn">Try it</button>
                <div class="box">
                    box
                </div>
            </div>
            
            <div class="menu">
            
                <div class="menu-open">
                
                    <a href="#" class="menu-button mx-auto menu-open--icon">
                        <i class="fal fa-bars"></i>
                     
                    </a>
                    
                </div>
            
            </div>

        </div>
            
        
        <div class="empty">
            <div class="fill" draggable="true"></div>
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

