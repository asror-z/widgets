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
 * 
 *
 */
class ZBarInputRavWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'type' => ZInputWidget::type['text'],
        'grapes' => true,
        'class' => '',
        'isLabel' => false,
        
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
    <div id="{idApp}" class="m-0 {class}">
        {geticon}
            
            <input 
                type="{type}" 
                id="{inputId}" 
                class="m-0 form-control"
                placeholder ="{placeholder}" 
                name="{name}" 
                value ="{value}"
                {readonly}>
                {range}
          
    </div>
HTML,

        'label' => <<<HTML
     <label for="{inputId}" class="ZInputWidget  grapesInput">{label}</label>
HTML,

        'range' => <<<HTML
        <p class="range-value">50</p>
HTML,

        'icon' => <<<HTML
        <i class="prefix icon-prefix {icon} mr-2"></i>
HTML,

        'css' => <<<CSS

CSS,

        'js' => <<<JS
        
        onScan.attachTo(document, {
        
            suffixKeyCodes: [13],
            reactToPaste: false, 
            onScan: function(sCode, iQty) {
               let filterCode = $(document).find('#shoporder-code')
               filterCode.val(sCode)
               filterCode.trigger('change')
            },
             
        })
        
        $(document).on('scan', function() {
                      
            $(document).find('#{inputId}').focus();
            var scan = onScan;
            scan.detachFrom(document); 
            
            scan.attachTo(document,  {
                suffixKeyCodes: [13],
                reactToPaste: false, 
                onScan: function(sCode, iQty) {
                   let filterCode = $(document).find('#shoporder-code')
                   filterCode.val(sCode)
                   filterCode.trigger('change')
                }, 
            })
        })
    
JS,

       

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/onscan.js@1.5.2/onscan.js');
    }

    public function codes()
    {
        
        $range = '';
        if ($this->_config['type'] === 'range') {
            $range = $this->_layout['range'];
        }
        $geticon = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon']
        ]);
        
        if ($this->_config['isLabel']) {
            $this->htm .= strtr($this->_layout['label'], [
                '{label}' => $this->_config['placeholder'],
                '{inputId}' => $this->id,
            ]);
        }

        $this->js = strtr($this->_layout['js'],[
            '{change}' => $this->eventCode('change'),
            '{inputId}' => $this->id,
        ]);

    }
}

