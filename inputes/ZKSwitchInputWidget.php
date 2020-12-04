<?php

namespace zetsoft\widgets\inputes;

use kartik\rating\StarRating;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\SwitchInput;
use yii\web\JsExpression;
use function False\true;

/**
 * Class ZKSwitchInputWidget
 * @package widgets\inputes
 * http://demos.krajee.com/widget-details/switchinput
 *
 *
 */
class ZKSwitchInputWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'width' => 30,
        'type' => ZKSwitchInputWidget::type['checkbox'],
        'size' => ZKSwitchInputWidget::size['small'],
        'title' => 'My Title',
        'label' => 'My Label',
        'readonly' => false,
        'grapes' => false,
        'onText' => null,
        'offText' => null,
    ];


    public $_active = [
        'switchChange.bootstrapSwitch' => true,
    ];

    /**
     *
     * Constants
     */


    public const size = [
        'large' => 'large',
        'small' => 'small',
        'mini' => 'mini',
    ];

    public const type = [
        'checkbox' => SwitchInput::CHECKBOX,
        'radio' => SwitchInput::RADIO,
    ];

    public const color = [
        'success' => 'success',
        'danger' => 'danger',
    ];

    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'init.bootstrapSwitch' => ' console.log("ZKSwitchInputWidget | init.bootstrapSwitch") ',
        'switchChange.bootstrapSwitch' => 'console.log("ZKSwitchInputWidget | switchChange.bootstrapSwitch");',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="border-0 d-flex align-items-center form-group ">
            &ensp; 
            <div class="">
                {getIcon}
            </div>
               {input}
                
          </div> 
HTML,
        'icon' => <<<HTML
          <i class="fa-2x {icon}"></i>&nbsp; &nbsp; &nbsp;
HTML,
        'place' => <<<HTML
          <div class="mr-2 forGrapes">{placeholder}</div>
HTML,
        'input' => null,


    ];

    public function codes()
    {

        if ($this->_config['onText'] === null)
            $this->_config['onText'] = Az::l('Да');


        if ($this->_config['offText'] === null)
            $this->_config['offText'] = Az::l('Нет');




        $this->options = [
            'name' => $this->name,
            'value' => $this->value,
            'bsVersion' => $this->bsVersion,
            'type' => $this->_config['type'],
            'tristate' => false,
            'indeterminateValue' => null,
            'indeterminateToggle' => [
                'label' => '&times;'
            ],
            'items' => [],
            'inlineLabel' => false,
            'itemOptions' => [
                'style' => 'text-align:left'
            ],
            'labelOptions' => false,
            'separator' => ' &nbsp;',
            'containerOptions' => [],
            'disabled' => $this->_config['readonly'],
            'readonly' => $this->_config['readonly'],
            'options' => [
                'id' => $this->id,
                'class' => $this->_config['class']
            ],
            'pluginOptions' => [
                'size' => $this->_config['size'],
                'onColor' => 'success',
                'offColor' => 'danger',
                'labelText' => '<i class="glyphicon glyphicon-fullscreen"></i>',
                'onText' => Az::l('Да'),
                'offText' => Az::l('Нет'),
                'animate' => true,
                'options' => [

                ],
                'title' => $this->_config['title'],
                'toggleButton' => [
                    'label' => $this->_config['label'],
                    'class' => 'btn btn-lg btn-primary '
                ],
                'handleWidth' => $this->_config['width'],
            ],

            'pluginEvents' => $this->eventsAll([
                'init.bootstrapSwitch' => $this->_event['init.bootstrapSwitch'],

                'switchChange.bootstrapSwitch' => <<<JS
console.log('switchChange.bootstrapSwitch Main')
JS,
            ])
        ];


        if (!$this->_config['changeSave']) {
            $this->options = ZArrayHelper::merge($this->options, [
                'model' => $this->model,
                'attribute' => $this->attribute,
            ]);
        }


        $getIcon = '';
        if ($this->_config['hasIcon'] === true) {
            $getIcon = $this->htm .= strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        }

        $getPlace = '';
        if ($this->_config['hasPlace'] === true) {
            $getPlace = strtr($this->_layout['place'], [
                '{placeholder}' => $this->_config['placeholder'],
            ]);
        }


        $this->htm = strtr($this->_layout['main'], [
            '{getIcon}' => $getIcon,
            '{place}' => $getPlace,
            '{input}' => SwitchInput::widget($this->options),
        ]);


        $this->css = <<<CSS
            .bootstrap-switch-handle-on {
            width: 60px!important;
            }
            .bootstrap-switch{
            width: 80px!important;
            }
            .bootstrap-switch-handle-off {
               width: 60px!important;
            }       
        CSS;


    }


}
