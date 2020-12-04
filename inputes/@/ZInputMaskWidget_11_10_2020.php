<?php

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget2;
use zetsoft\system\kernels\ZWidget3;
use function Complex\theta;
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
class ZInputMaskWidget_11_10_2020 extends ZWidget
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
        'open' => 'console.log("ZKSelect2Widget | $eventOpen")',
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
        'open' => true,
        'oncomplete' => true,
        'onincomplete' => true,
        'oncleared' => true,
        'onKeyDown' => true,
        'onBeforeMask' => true,
        'onBeforeWrite' => true,
        'onBeforePaste' => true,
        'isComplete' => true,
        'onKeyValidation' => true,
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/inputmask@5.0.3/dist/jquery.inputmask.js');
        //$this->fileJs('https://cdn.jsdelivr.net/npm/inputmask@5.0.3/dist/inputmask.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <div id="{idApp}" class="m-0 {class}">
                 {iconCode}
                <input id="{id}" name="{name}" class="kv-editable-input inputmask form-control " 
                placeholder="{placeholder}" value="{value}" {readonly}>       
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
                     oncomplete : {oncomplete},
                     onincomplete : {oncleared},
                     oncleared : {onincomplete},
                     //repeat : '',
                     autoUnmask : false,
                     removeMaskOnSubmit : false,
                     clearMaskOnLostFocus : true,
                     insertMode : true,
                     insertModeVisual : false,
                     clearIncomplete : true,
                     onKeyDown : {onKeyDown},
                     onBeforeMask : {onBeforeMask},
                     onBeforePaste : {onBeforePaste}, 
                     onBeforeWrite : {onBeforeWrite},
                     showMaskOnFocus : true,
                     onKeyValidation : {onKeyValidation},
                     //numericInput : true,
                     rightAlign : false,
                     undoOnEscape : true,
                     //radixPoint : '',
                     //groupSeparator : '',
                      keepStatic : null,
                      positionCaretOnTab : true,
                      tabThrough : false,
                      //definitions : {},
                      isComplete : {isComplete},
                       //postValidation : "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                       //preValidation:  "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                       /*definitions: {
                          '*': {
                            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                            /!*casing: "lower"*!/
                          }
                        },*/
                     
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


        $maskCode = '';
        $aliasCode = '';
        $readyCode = '';

        switch ($this->_config['type']) {
            case 'alias':
                if ($this->_config['alias'] === 'datetime') {
                    $aliasCode = strtr($this->_layout['alias'], [
                        '{alias}' => $this->jscode($this->_config['alias']),
                        '{inputFormat}' => $this->jscode($this->_config['dateFormat']),

                    ]);
                } else {
                    $aliasCode = strtr($this->_layout['alias'], [
                        '{alias}' => $this->jscode($this->_config['alias']),
                        '{inputFormat}' => '',

                    ]);
                }
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
            '{class}' => $this->_config['hasIcon'] ? 'md-form' : $this->_config['class']
            //end JakhongirKudratov
        ]);


        /* $eventsAll = $this->eventsAll([
             'keydown' => 'keydown',
             'cleared' => 'cleared',
             'select2:open' => 'open',
             'select2:closing' => 'closing',
             'select2:close' => 'close',
             'select2:selecting' => 'selecting',
             'select2:unselecting' => 'unselecting',
             'select2:clear' => 'clear',
             'select2:unselect' => 'unselect',
             'select2:clearing' => 'clearing',
         ]);

         $eventItem = $this->eventsOn($eventsAll);*/

        $this->js = strtr($this->_layout['js'], [
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
