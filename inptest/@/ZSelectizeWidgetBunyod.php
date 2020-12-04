<?php

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * Author:  Bunyod Yoqubjonov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * https://github.com/selectize/selectize.js/
 */
class ZSelectizeWidgetBunyod extends ZWidget
{

    public $config = [];
    public $_config = [

    ];

    public $event = [];
    public $_event = [
        'click' => ' console.log("self | $eventClick") ',
        'dblclick' => ' console.log("self | $eventDblclick") ',
        'mouseenter' => ' console.log("self | $eventMouseEnter") ',
        'mouseleave' => ' console.log("self | $eventMouseLeave") ',
        'keyup' => ' console.log("self | $eventKeyup") ',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];

    public function asset()
    {

        $this->fileCss('https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/css/selectize.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.11.0/js/standalone/selectize.js');
    }

    public function codes()
    {
        $this->layout = [
            'main' => <<<HTML
        <div id="{id}-asset">
            <div class="form-group">
                <select id="{id}-selectize" style="display: none !important;" class="asset-default" placeholder="{placeholder}" id="{id}" class="form-control icp icp-auto {class}" name="{name}"
                       type="text" value="{value}">
                </select>   
               
            </div>     
        </div>

        <input type="hidden" id="hidden-selectize"  name="{name}" value="{value}"placeholder="{placeholder}">
        
HTML,

            'js' => <<<JS
        $('#{id}-selectize').selectize({    
        delimiter: ',',
        persist: true,
        create: false,
        createOnBlur: false,
        createFilter: null,
        highlight: true,
        maxItems: null,
        hideSelectedhideSelected: null,
        closeAfterSelect: false,
        loadThrottle: 300,
        scrollDuration: 60,
        loadingClass: 'loading',
        placeholder: undefined,
        preload: false,
        dropdownParent: null,
        addPrecedence: false,
        selectOnTab: false,
        diacritics: true,
        dataAttr: 'data-data',
        valueField: 'value',
        optgroupValueField: 'value',
        labelField: 'text',
        optgroupLabelField: 'label',
        optgroupField: 'optgroup',
        disabledField: 'disabled',
        sortField: 'order',
        searchField: ['text'],
        searchConjunction: 'and',
        lockOptgroupOrder: false,
        copyClassesToDropdown: true,
        multiple: false,  
        onChange: function (event){
        $('#hidden-selectize').val(e)
      
            /*console.log(e);*/
             }
         });
         
         $('#hidden-selectize').val($('#{id}-asset').val());
JS,
            'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
            
            /*var country = [];
            $('#{id}-selectize').on('change', function() {
                for (var i = 0; i < $('#{id}-selectize').val().length; i++){
                    var valueOption = $('#{id}-selectize').val()[i]; 
                    // console.log($('#{id}-selectize').val()[i]);
                    country.push(valueOption);
                }
                var uniqueItems = Array.from(new Set(country))
                /!*console.log(uniqueItems)*!/
                
                
                
                /!*$('#{id}-selectize').val().forEach(function(item) {
                    country.push(item);
                    console.log(country)
                })*!/
            });*/
            /*var uniqueItems = Array.from(new Set(country))*/
                /*console.log(uniqueItems)*/
                  
                 
JS,
            'option' =><<<HTML
             <option value="{item}">{item}</option>
HTML,

        ];

        $option = '';

        foreach ($this->data as $item) {
            $option .= strtr($this->layout['option'], [
                '{item}' => $item,

            ]);
        }

        $this->htm = strtr($this->layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{options}' => $option,
            '{name}' => $this->name,
            '{placeholder}' => $this->_config['placeholder'],

        ]);


        $this->js = strtr($this->layout['js'], [
            '{id}' => $this->id,
        ]);
        $this->js .= strtr($this->layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);

    }

}
