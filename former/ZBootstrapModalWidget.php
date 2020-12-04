<?php

namespace zetsoft\widgets\former;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZBootstrapModalWidget
 * Demo:
 * https://www.w3schools.com/bootstrap4/tryit.asp?filename=trybs_modal_nofade&stacked=h
 *
 * Created By: Tursunaliyev Abdulloh
 *
 */

class ZBootstrapModalWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZBootstrapModalWidget::type['main'],
         'grapes' => true
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/former/ZBootstrapModalWidget/image/icon.png',
        'name' => Azl . 'BootstrapModal',
        'title' => Azl . '<b>safasfsa</b><img src="/render/former/ZBootstrapModalWidget/image/icon.png"/>',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="container" {readonly}> 
    
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{id}">
        Open modal
    </button>
    
    <button type="button" class="btn btn-danger" data-toggle="modal-second" data-target="#{id}">
        Open modal
    </button>

    <!-- The Modal -->
    <div class="modal" id="{id}">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Modal Heading</h1>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {content}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    
     <div class="modal-second" id="{id}">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Modal Heading</h1>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {content}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</div>
HTML

    ];
    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */

    public const type = [
        'main' => 'main',

    ];

    public function asset()
    {
        
        /*$this->fileJs('/publish/yarner/popper.js/dist/popper.min.js');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/popper.min.js.map');
    }



    public function init()
    {
        parent::init();
        ob_start();
    }

    public function codes()
    {


        $content = ob_get_clean();

        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            
            '{content}' => $content,
            '{id}' => $this->id,
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',

        ]);

        $this->js = <<<JS
           
JS;


        $this->css = <<<CSS
         .modal{
         position: relative;
        
         }
CSS;


    }

}
