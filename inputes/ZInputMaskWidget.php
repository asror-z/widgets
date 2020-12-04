<?php

namespace zetsoft\widgets\inputes;

use zetsoft\service\utility\Views;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget2;
use zetsoft\system\kernels\ZWidget3;
use function Complex\theta;
use function False\true;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Samoiddin Salohiddinov and Jahongir Qudratov
 *
 */
class ZInputMaskWidget extends ZWidget
{

    /**
     * Configuration
     *
     */
    public $config = [];
    public $_config = [
        'type' => ZInputMaskWidget::type['ready'],
        'dateFormat' => 'dd/mm/yyyy',
        'alias' => ZInputMaskWidget::aliase['datetime'],
        'mask' => '99999',
        'ready' => ZInputMaskWidget::ready['phone'],
        'readonly' => false,
        'class' => ''
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'width' => '500px',
        'height' => '450px',
        'image' => '/render/inputes/ZInputMaskWidget/image/icon.png',
        'name' => Azl . 'InputMask',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZInputMaskWidget/image/icon.png"/>',

    ];

    public const type = [
        'alias' => 'alias',
        'mask' => 'mask',
        'ready' => 'ready'
    ];

    public const ready = [
        'phone' => '99-999-99-99',
        'passportNumber' => 'AA-9999999',
        'email' => 'email',
        'ip' => 'ip',
        'url' => 'url'
    ];


    public const aliase = [
        'email' => 'email',
        'ssn' => 'ssn',
        'vin' => 'vin',
        'mac' => 'mac',
        'ip' => 'ip',
        'url' => 'url',
        'datetime' => 'datetime',
        'integer' => 'integer',
        'decimal' => 'decimal',
        'currency' => 'currency',
        'numeric' => 'numeric',
        'percentage' => 'percentage'
    ];
    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

        'oncomplete' => 'console.log("ZInputMaskWidget | oncomplete")',
        'onincomplete' => 'console.log("ZInputMaskWidget | onincomplete");',
        'oncleared' => 'console.log("ZInputMaskWidget | oncleared");',
        'onKeyDown' => 'console.log("ZInputMaskWidget | onKeyDown");',
        'onBeforeMask' => 'console.log("ZInputMaskWidget | onBeforeMask");',
        'onBeforeWrite' => 'console.log("ZInputMaskWidget | onBeforeWrite");',
        'onBeforePaste' => 'console.log("ZInputMaskWidget | onBeforePaste");',
        'isComplete' => 'console.log("ZInputMaskWidget | isComplete");',
        'onKeyValidation' => 'console.log("ZInputMaskWidget | onKeyValidation");',


    ];

    public $active = [];
    public $_active = [
        'open' => false,
        'oncomplete' => false,
        'onincomplete' => false,
        'oncleared' => false,
        'onKeyDown' => false,
        'onBeforeMask' => false,
        'onBeforeWrite' => false,
        'onBeforePaste' => false,
        'isComplete' => false,
        'onKeyValidation' => false,
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/inputmask@5.0.5/dist/jquery.inputmask.js', Views::position['begin']);

    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <div id="{idApp}" class="m-0 {class}">
                 {iconCode}
                 <input id="{id}" name="{name}" class="kv-editable-input inputmask form-control {class}" 
                placeholder="{placeholder}" value="{value}">       
            </div> 
HTML,
        'js' => <<<JS
            
                $('#{id}').inputmask({
                     greedy: false,
                     placeholder: '{placeholder}',
                     //optionalmarker :  { start: "[", end: "]" },
                     //quantifiermarker : { start: "{", end: "}" },
                     //groupmarker : { start: "(", end: ")" },
                     //alternatormarker : '|',
                     //escapeChar : "\\"",
                     
                     //repeat : '',
                     autoUnmask : false,
                     removeMaskOnSubmit : false,
                     clearMaskOnLostFocus : true,
                     insertMode : true,
                     insertModeVisual : false,
                     clearIncomplete : true,

                     //numericInput : true,
                     rightAlign : false,
                     undoOnEscape : true,
                     //radixPoint : '',
                     //groupSeparator : '',
                      keepStatic : null,
                      positionCaretOnTab : true,
                      tabThrough : false,
                      //definitions : {},
                  
                       //postValidation : "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                       //preValidation:  "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                       /*definitions: {
                          '*': {
                            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                            /!*casing: "lower"*!/
                          }
                        },*/
                     
                     
                   
                     
                 oncomplete : {oncomplete},
                 onincomplete : {oncleared},
              
                     oncleared : {onincomplete},
                     
                     onKeyDown : {onKeyDown},
                     onBeforeMask : {onBeforeMask},
                     onBeforePaste : {onBeforePaste}, 
                     onBeforeWrite : {onBeforeWrite},
                     showMaskOnFocus : true,
                     onKeyValidation : {onKeyValidation},
                     isComplete : {isComplete},
          
                     
                       //staticDefinitionSymbol : '*',
                       nullable : true,
                       noValuePatching : false,
                       positionCaretOnClick : 'lvp',
                       casing : false,
                       inputmode : 'verbatim',
                       importDataAttributes : true,
                       shiftPositions : true,            
                       {alias}
                       {masked}
                       {ready}          
                })
                
                ;  
             
                         
JS,

        //start: JakhongirKudratov
        'icon' => <<<HTML
          <!--<i class="icon-prefix prefix {icon}" title="{tooltip}"></i>-->
          <span class="hint--top-right prefix d-block" aria-label="{tooltip}"><i class="icon-prefix prefix {icon}"></i></span>

HTML,
        //end JakhongirKudratov


        'alias' => <<<JS
           alias : '{alias}',
           inputFormat : '{inputFormat}'
JS,
        'mask' => <<<JS
            mask : '{mask}'
JS,
        'ready' => <<<JS
            mask : '{ready}',
            placeholder : '{placeholder}',
            alias: '{alias}'

JS,
    ];

    public function codes()
    {


//vdd($this->_config['enableEvent']);

        $maskCode = '';
        $aliasCode = '';
        $readyCode = '';

        switch ($this->_config['type']) {
            case 'alias':
                if ($this->_config['alias'] === 'datetime')
                    $aliasCode = strtr($this->_layout['alias'], [
                        '{alias}' => $this->jscode($this->_config['alias']),
                        '{inputFormat}' => $this->jscode($this->_config['dateFormat']),

                    ]);
                else
                    $aliasCode = strtr($this->_layout['alias'], [
                        '{alias}' => $this->jscode($this->_config['alias']),
                        '{inputFormat}' => '',
                    ]);

                break;

            case 'mask':
                $maskCode = strtr($this->_layout['mask'], [
                    '{mask}' => $this->jscode($this->_config['mask'])
                ]);
                break;
            case 'ready':
                if ($this->_config['ready'] === '99-999-99-99' || $this->_config['ready'] === 'AA-9999999') {
                    $readyCode = strtr($this->_layout['ready'], [
                        '{ready}' => $this->jscode($this->_config['ready']),
                        '{placeholder}' => $this->jscode($this->_config['ready'])
                    ]);
                } else {
                    $readyCode = strtr($this->_layout['ready'], [
                        '{ready}' => $this->jscode($this->_config['ready']),
                        '{placeholder}' => $this->jscode($this->_config['ready']),
                        '{alias}' => $this->jscode($this->_config['ready'])
                    ]);
                }
                break;
            default:
                'This maskinput not is!';
        }
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{idApp}' => $this->idApp,
            '{name}' => $this->name,
            '{value}' => $this->value,
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{readonly}' => $this->_config['readonly'] ? 'disabled' : '',
            //start: JakhongirKudratov
            '{iconCode}' => $this->_config['iconCode'],
            '{class}' => $this->_config['class']
            //end JakhongirKudratov
        ]);


     

        $this->js .= strtr($this->_layout['js'], [
                '{id}' => $this->id,
                '{idApp}' => $this->idApp,
                '{type}' => $this->jscode($this->_config['type']),
                '{mask}' => $this->jscode($this->_config['mask']),
                /*
                 * events
                 */
                   '{oncomplete}' => $this->eventCode('oncomplete'),
                   '{onincomplete}' => $this->eventCode('onincomplete'),
                   '{oncleared}' => $this->eventCode('oncleared'),
                   '{onKeyDown}' => $this->eventCode('onKeyDown'),
                   '{onBeforeMask}' => $this->eventCode('onBeforeMask'),
                   '{onBeforeWrite}' => $this->eventCode('onBeforeWrite'),
                   '{onBeforePaste}' => $this->eventCode('onBeforePaste'),
                   '{isComplete}' => $this->eventCode('isComplete'),
                   '{onKeyValidation}' => $this->eventCode('onKeyValidation'),

                '{alias}' => $aliasCode,
                '{masked}' => $maskCode,
                '{ready}' => $readyCode
            ]

        );
    }
}
