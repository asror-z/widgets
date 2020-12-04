<?php

namespace zetsoft\widgets\chates;

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
 * Created By: Bekmuhammad Obidov
 * Refactored: Bekmuhammad Obidov
 */
class ZTelegramNavigationWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'grapes' => true,
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */

    public $layout = [];
    public $_layout = [

        "navigation" => <<<HTML
          <div class="title"  '>
    <div class="container">
        <div class="row flex-column">
            <div class="col-4 height">
                <div class="row">
                    <div class="lichka_box d-flex justify-content-between   ">
                        <div class="left1 d-flex">
                            <div class="img_box">
                                <!-- rasmmi o'rni -->
                            </div>
                            <div class="who_box">
                                <p class="recent">Sardor Kholmodov</p>
                                <p class="regular">You: yoq hali</p>
                            </div>
                        </div>
                        <div class="left2 ">
                            <p class="light">Feb 9</p>
                            <i class="fas fa-thumbtack"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 height">
                <div class="row">
                    <div class="lichka_box d-flex justify-content-between   ">
                        <div class="left1 d-flex">
                            <div class="img_box">
                                <!-- rasmmi o'rni -->
                            </div>
                            <div class="who_box">
                                <p class="recent">Sardor Kholmodov</p>
                                <p class="regular">You: yoq hali</p>
                            </div>
                        </div>
                        <div class="left2 ">
                            <p class="light">Feb 9</p>
                            <i class="fas fa-thumbtack"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 height">
                <div class="row">
                    <div class="lichka_box d-flex justify-content-between   ">
                        <div class="left1 d-flex">
                            <div class="img_box">
                                <!-- rasmmi o'rni -->
                            </div>
                            <div class="who_box">
                                <p class="recent">Sardor Kholmodov</p>
                                <p class="regular">You: yoq hali</p>
                            </div>
                        </div>
                        <div class="left2 ">
                            <p class="light">Feb 9</p>
                            <i class="fas fa-thumbtack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
HTML,

        'css' => <<<CSS
        .title {
            margin-top: 100px;
        }

        a {
            font-size: 14px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        .height {
            width: 100%;
            height: 30px;
            margin-top: 20px;

        }

        .recent {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 700;
            color: black;
        }

        .light {
            font-weight: 300;
            color: grey;
        }

        .blue {
            margin-left: 10px;
            margin-right: 10px;
        }

        .lichka_box {
            width: 100%;
            height: 60px;
        }

        .img_box {
            width: 60px;
            height: 60px;
            overflow: hidden;
            background: grey;
            border-radius: 50%;
        }

        .who_box {
            margin-left: 10px;
        }

        .who_box .recent {
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }

        .light {
            font-size: 16px;
            margin: 0;
            margin-top: 5px;
            margin-bottom: 2px;
        }
   
CSS,

    ];

    public function asset()
    {

    }

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);


        $this->htm = strtr($this->_layout['navigation'], [
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        $this->css = strtr($this->_layout['css'], []);


    }

}
