<?php

namespace zetsoft\widgets\inputes;


use zetsoft\system\kernels\ZWidget;

/**
 * Author:  MurodovMirbosit
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * https://github.com/selectize/selectize.js/
 */
class ZSelectizeWidget extends ZWidget
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

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <select id="{id}" style="display:none!important" placeholder="{placeholder}" class="form-control {class}" name="{name}[]">
                      {options}
            </select>   
        
HTML,

        'js' => <<<JS
        $('#{id}').selectize({    
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
         
JS,
        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave});
            
            /*var country = [];
            $('#{id}').on('change', function() {
                for (var i = 0; i < $('#{id}').val().length; i++){
                    var valueOption = $('#{id}').val()[i]; 
                    // console.log($('#{id}').val()[i]);
                    country.push(valueOption);
                }
                var uniqueItems = Array.from(new Set(country))
                /!*console.log(uniqueItems)*!/
                
                
                
                /!*$('#{id}').val().forEach(function(item) {
                    country.push(item);
                    console.log(country)
                })*!/
            });*/
            /*var uniqueItems = Array.from(new Set(country))*/
                /*console.log(uniqueItems)*/
                  
                 
JS,
        'option' =>
            <<<HTML
             <option value="{item}">{item}</option>
HTML,

    ];

    public function codes()
    {


        $option = '';

        foreach ($this->data as $item) {
            $option .= strtr($this->_layout['option'], [
                '{item}' => $item,

            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{options}' => $option,
            '{name}' => $this->name,
            '{placeholder}' => $this->_config['placeholder'],

        ]);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
        ]);
        $this->js .= strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
        ]);

    }

}
