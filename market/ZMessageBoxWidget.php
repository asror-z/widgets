<?php

namespace zetsoft\widgets\market;

use yii\grid\Column;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 *
 * Created By: Malika Parmanova
 * Refactored: Malika Parmanova
 */

class ZMessageBoxWidget extends ZKSelect2Widget
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
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
         
<div class="container">
        <div class="row">
            <div class="content-box position-relative border-bottom border-success mt-5">
                <span class="round"></span>
                <p class="content-uzb">Uzbekistan Pass</p>
                <p class="content-thank">Спасибо за риобритения дискон...</p>
                <p class="content-thanks">Спасибо за риобритения дисконтнова кода спасибо за риобритения...
                </p>
                <span class="content-date position-absolute light-green-text">22.03.2020</span>
            </div>

        </div>
    </div>
HTML,


        'css' => <<<CSS
     
        .content-box .content-date{
            font-size: 19px;
            font-weight: 500;
            
            left: 85%;
            top: 0%;

        }

        .content-box .round{
            width: 70px;
            height: 70px;
            background: limegreen;
            position: absolute;
            left: 0;
            top: 20%;
            border-radius: 50%;
        }
        .content-uzb {
            font-size: 25px;
            font-weight: 600;
            margin-left: 77px;
            margin-bottom: 5px;
        }
        .content-thank{
            font-size: 20px;
            font-weight: 400;
            margin-left: 77px;
            margin-bottom: 2px;
        }
        .content-thanks{
            margin-left: 77px;
        }

  
CSS,
    ];

    /**
     *
     * Constants
     */


    public function asset()
    {
        $this->fileCss('/render/asrorz/mdb/css/mdb.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.0/build/css/intlTelInput.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.0/build/js/intlTelInput.js');

    }

    public function codes()
    {

        $this->htm = strtr($this->_layout['main'], []);
        $this ->css = strtr($this ->_layout['css'],[

        ]);
    }

}






