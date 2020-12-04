<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZIconPickerWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZIconPickerWidget::type['buttonIconPicker'],
        'icon' => 'fas fa-plus',
        'placement' => 'right',
        'searchText' => 'search something',
        'cols' => 4,
        'rows' => 3,
        'align' => 'center',
        'readonly' => false,
        'btncolor' => 'info',
        'isLabel' => false

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZIconPickerWidget/image/icon.png',
        'name' => Azl . 'IconPicker',
        'title' => Azl . '<b>safasfsa</b><img src="/render/inputes/ZIconPickerWidget/image/icon.png"/>',

    ];

    /**
     *
     * Constants
     */
    public const type = [
        'buttonIconPicker' => 'buttonIconPicker',
        'divIconPicker' => 'divIconPicker',
        'inputIconPicker' => 'inputIconPicker',
    ];


    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
    ];

    public $layout = [];
    public $_layout = [
        'label' => <<<HTML
        <label for="">{label}</label>
HTML,

        'buttonIconPicker' => <<<HTML
            <div>
                 {label}
                <button class="d-block btn btn-{btncolor}" id="{id}"></button>
                <input type="hidden" name="{name}" id="{id}-buttonTypeInput" value="{value}"> 
            </div>
HTML,
        'divIconPicker' => <<<HTML
                <div id="{id}"></div>
                  <input type="hidden" name="{name}" id="{id}-Icon" value="{value}">
                
HTML,
        'inputIconPicker' => <<<HTML
                <div class="input-group" id="{id}-inp5">
                    <span class="input-group-append">
                        <button id="{id}" class="btn btn-secondary" 
                        data-icon="fas fa-map-marker-alt" role="iconpicker"></button>
                    </span>
                    <input type="text" value="{value}" class="form-control" name="{name}" id="{id}-inputType">
                </div>
HTML,

        'js' => <<<JS
            
            /*$(document).ready(function() {*/
                
            $('#{id}').iconpicker({
            align: '{align}', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-righr',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: '{cols}',
            footer: true,
            header: true,
            icon: '{icon}',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0}-{1} of {2} icons',
            placement: '{placement}', // Only in button tag
            rows: '{rows}',
            search: true,
            searchText: '{search}',
            selectedClass: 'btn-success',
            unselectedClass: '',
        })
        /* start|AzimjonToirov|10/20/2020 */
        .on('change', () => {
            const pickedIcon = $('#{id}').find('input').val();
            $('#{id}-buttonTypeInput').val(pickedIcon);
        })
        
        .change('change', () => {
            const pickedIcon = $('#{id}').find('input').val();
            $('#{id}-inputType').val(pickedIcon);
        })
        
        .on('click', () => { 
            const pickedIcon = $('.search-control').val();
            $('#{id}-Icon').val(pickedIcon) 
        })
        /* end|AzimjonToirov|10/20/2020 */
        
        .keyup((event) => {
            if (event.which === 27) {
                $(this).popover('hide')
            }
        })
            
        $('#{id}').find('i').attr('class', '{value}');
JS,
        'event' => <<<JS
             $('#{id}')
            .on('click', function (event){
                console.log(event.which);
            })
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
JS,

        'style' => <<<CSS
         .iconpicker-popover{
              display: block !important;
              float: right!important; 
         }
CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-iconpicker@1.8.2/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js');
    }

    public function codes()
    {


        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);

        $label = '';
        if ($this->_config['isLabel']) {
            $label = strtr($this->_layout['label'], [
                '{label}' => $this->_config['placeholder'],
            ]);
        }


        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{btncolor}' => $this->_config['btncolor'],
            '{name}' => $this->modelCheck() ? $this->name : '',
            '{value}' => $this->modelCheck() ? $this->value : '',
            '{placeholder}' => $this->modelCheck() ? $this->_config['placeholder'] : '',
            '{label}' => $label,
            '{class}' => $this->_config['class'],
            '{readonly}' => $this->_config['readonly'],
        ]);


        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{icon}' => $this->modelCheck() ? $this->value : '',
            '{placement}' => $this->jscode($this->_config['placement']),
            '{cols}' => $this->jscode($this->_config['cols']),
            //start|JakhongirKudratov|2020-10-10

//            '{search}' => $this->_config['hasPlace']? $this->_config['placeholder'] : '',

            //end|JakhongirKudratov|2020-10-10

            /* start|AzimjonToirov|10/20/2020 */
            '{search}' => $this->_config['hasPlace'] ? $this->value : '',
            /* end|AzimjonToirov|10/20/2020 */

            '{rows}' => $this->jscode($this->_config['rows']),
            '{align}' => $this->jscode($this->_config['align']),
            '{value}' => $this->modelCheck() ? $this->value : '',
        ]);

        $this->css = $this->_layout['style'];

    }


}
