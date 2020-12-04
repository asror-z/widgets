<?php

namespace zetsoft\widgets\blocks;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\assets\ZColor;
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
 * Created By: Jahongir Qudratov
 *
 */
class ZInfoBoxWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'color' => 'green',
        'icon' => FA::_COMMENTS,
        'infoValue' => '123',
        'infoText' => 'This info text',
        'infoUrl' =>'#'

    ];

    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];
       public $layout=[];
       public $_layout=[
           'main'=>  <<<HTML
             <div class="vd_status-widget {color} widget">
                 <div class="vd_panel-menu">
                    <div data-action="refresh" data-original-title="Refresh" data-rel="tooltip" class=" menu entypo-icon smaller-font"> <i class="fa fa-refresh"></i> </div>
                 </div>
                 <a class="panel-body" href="{infoUrl}">
                 <div class="clearfix">
                    <span class="menu-icon">
                        <i><i class="{icon}"></i></i>
                    </span>
                    <span class="menu-value info-value">
                        {infoValue}
                    </span>
                 </div>
                    <div class="menu-text clearfix">
                      {infoText}
                    </div>
                 </a>
             </div>
HTML,
            'css'=><<<CSS
            .info-value{
                font-weight: bold;    
            }
CSS



       ];
    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm = strtr($this->_layout["main"],[
            '{color}' =>  $this->_config['color'],
            '{infoUrl}' =>  $this->_config['infoUrl'],
            '{icon}' =>  $this->_config['icon'],
            '{infoValue}' =>  $this->_config['infoValue'],
            '{infoText}' =>  $this->_config['infoText'],


        ]);
        $this->css = strtr($this->_layout['css'],[]);
    }
}
