<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZJoerezWoahWidget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZJoerezWoahWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
       
    ];
     public  $layout=[];
     public  $_layout=[

           'main'=><<<HTML
        <div class="animatebox">
    <h1 class="woah comeInStyle">Woah.css</h1>

    <div class="box woah wowzors"></div>

    <div class="form">
      <h3 class="woah blazingStarText">Animations for eccentric developers</h3>
      <form>
        <center>
          <select class="picker" name="animate" form="animate">
            <optgroup label="Woah">
              <option value="wowzors">wowzors</option>
              <option value="comeInStyle">comeInStyle</option>
              <option value="leaveInStyle">leaveInStyle</option>
              <option value="dealWithIt">dealWithIt</option>
              <option value="rotateComplex">rotateComplex</option>
              <option value="rotateComplexOut">rotateComplexOut</option>
              <option value="flyOut">flyOut</option>
              <option value="flyIn">flyIn</option>
              <option value="fedoraTip">fedoraTip</option>
              <option value="blackMirror">blackMirror</option>
              <option value="blackMirrorTextVersion">blackMirrorTextVersion</option>
              <option value="spin3D">spin3D</option>
              <option value="simpleEntrance">simpleEntrance</option>
              <option value="scaleOut">scaleOut</option>
            </optgroup>
            <optgroup label="Wow">
              <option value="starWars">starWars</option>
              <option value="blazingStar">blazingStar</option>
              <option value="blazingStarText">blazingStarText</option>
            </optgroup>
            <optgroup label="Normie">
              <option value="fadeIn">fadeIn</option>
              <option value="pulse">pulse</option>
              <option value="shaker">shaker</option>
            </optgroup>
          </select>
          <button type="button" class="subButton">Animate It</button>
          <br>
          
        
      </center>
      </form>
      </div>
     </div>
HTML



     ];

    /**
     *
     * Constants
     */
    

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/woah.css@1.3.1/styles.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/woah.css@1.3.1/woah.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/woah.css@1.3.1/scripts.js');
    }


   


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm= strtr($this->_layout["main"],[]);

        $this->js = <<<JS
           
JS;


        $this->css = <<<CSS
    
CSS;


    }

}
