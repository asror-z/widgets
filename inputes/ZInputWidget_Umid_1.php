<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZMultiWidget;

/**
 * Class ZInputWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#input()-detail
 * https://mdbootstrap.com/docs/jquery/forms/inputs/
 *
 * Clean Css By: Jasur Shukurov
 *
 */
class ZInputWidget_Umid_1 extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZInputWidget::type['text'],
        'grapes' => true,
        'class' => '',
        'isLabel' => false,
        'readonly' => true,
    ];

    public $event = [];


    public const type = [
        'button' => 'button',
        'color' => 'color',
        'date' => 'date',
        'datetime-local' => 'datetime-local',
        'email' => 'email',
        'file' => 'file',
        'hidden' => 'hidden',
        'image' => 'image',
        'month' => 'month',
        'number' => 'number',
        'password' => 'password',
        'radio' => 'radio',
        'range' => 'range',
        'reset' => 'reset',
        'search' => 'search',
        'submit' => 'submit',
        'tel' => 'tel',
        'text' => 'text',
        'time' => 'time',
        'url' => 'url',
        'week' => 'week',
        'checkbox' => 'checkbox',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div id="{idApp}" class="m-0 {class} readonly">
        {icon}
            
            <input 
                type="{type}" 
                id="{inputId}" 
                class="form-control"
                placeholder ="{placeholder}" 
                name="{name}" 
                value="{value}"
                {readonly}>
                {range}
          
    </div>
HTML,

        // start|MuminovUmid|2020-10-09
        'tooltip' => <<<HTML
          <span class="hint--top-right prefix d-block" aria-label="{tooltip}"><i class="icon-prefix prefix {icon}"></i></span>
HTML,
        // end|MuminovUmid|2020-10-09

        'label' => <<<HTML
     <label for="{inputId}" class="ZInputWidget  grapesInput">{label}</label>
HTML,

        'range' => <<<HTML
        <p class="range-value">50</p>
HTML,
        //start: JakhongirKudratov
        'icon' => <<<HTML
          <!--<i class="icon-prefix prefix {icon}" title="{tooltip}"></i>-->
          
          <span class="hint--top-right prefix d-block" aria-label="{tooltip}"><i class="icon-prefix prefix {icon}"></i></span>

HTML,
        //end JakhongirKudratov


        'css' => <<<CSS
/*Select2 ReadOnly Start*/
     .field-{id}{
        pointer-events: none;
        touch-action: none;
        cursor:not-allowed;
     }
   
/*Select2 ReadOnly End*/
CSS,


        'js' => <<<JS
        $('#{inputId}').on('change', {change});
JS,
    ];

    public function codes()
    {

        $range = '';
        if ($this->_config['type'] === 'range') {
            $range = $this->_layout['range'];
        }


        if ($this->_config['isLabel']) {
            $this->htm .= strtr($this->_layout['label'], [
                '{label}' => $this->_config['placeholder'],
                '{inputId}' => $this->id,
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{name}' => $this->name,
            '{id}' => $this->id,
            '{inputId}' => $this->id,
            '{idApp}' => $this->idApp,
            '{label}' => $this->_config['placeholder'],
            '{value}' => $this->value,
            '{type}' => $this->_config['type'],
            '{placeholder}' => $this->_config['placeholder'],

            //start: JakhongirKudratov
            '{class}' => $this->_config['hasIcon'] ? 'md-form' : $this->_config['class'],
            '{icon}' => $this->_config['iconCode'],
            //end JakhongirKudratov

            '{range}' => $range,
        ]);


        $this->js = strtr($this->_layout['js'], [
            '{change}' => $this->eventCode('change'),
            '{inputId}' => $this->id,
        ]);
        
        $css = '';
        if ($this->_config['readonly']) {
            $css = strtr($this->_layout['css'], [
                '{id}' => $this->id,
            ]);
        }
        $this->css = $css;

    }
}

