<?php

namespace zetsoft\widgets\ALL;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZScrollWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
      
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
          <button onclick="topFunction()" id="scrolltop" class="position-fixed " title="Go to top">Top</button>
          
HTML,


        'js' => <<<JS
           window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

  
    function topFunction() {
        document.body.scrollTop = 0; 
        document.documentElement.scrollTop = 0;
    }
JS,

        'css' => <<<CSS
    /*#scrolltop{*/
    /*         */
    /*    position: fixed; */
    /*    bottom: 20px;*/
    /*    right: 30px; */
    /*    z-index: 99; */
    /*    border: none; */
    /*    outline: none;*/
    /*    background-color: red; */
    /*    color: white; */
    /*    cursor: pointer; */
    /*    padding: 15px; */
    /*    border-radius: 10px; */
    /*    font-size: 18px; */
    /*}*/
    
    /*#scrolltop:hover {*/
    /*    background-color: #555; */
    /*}*/
    
CSS,
    ];

    /**
     *
     * Constants
     */
   

    public function asset()
    {
        /*$this->fileCss('/publish/yarner/smartmenus/dist/css/sm-blue/sm-blue.css');
        $this->fileJs('/publish/yarner/smartmenus/dist/css/sm-blue/sm-blue.js');*/
    }





    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = strtr($this->_layout['main'], []);

        $this->js = strtr($this->_layout['js'], []);

        $this->css = strtr($this->_layout['css'], []);


    }

}
