<?php

/**
 * Author:  Asror Zakirov
 * @license NurbekMakhmudov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\consts\ZPeriodPickerWidgetConst;

/**
 * Class    ZPeriodPickerWidget
 * @package zetsoft\widgets\inputes
 * https://xdsoft.net/jqplugins/periodpicker/
 */
class ZPeriodPickerWidgetXolmat extends ZWidget implements ZPeriodPickerWidgetConst
{
    public static $grapes = [

    ];

    public $config = [];
    public $_config = [
        'type' => self::type['multi_attr'],
        'attr_start' => '',
        'attr_end' => '',
        'value_start' => '',
        'value_end' => '',
    ];

    public const type = [
        'multi_attr' => 'multi_attr',
        'json' => 'json',
        'string' => 'string',
    ];

    public function asset()
    {
        $this->fileCss('/render/inputes/ZPeriodPickerWidget/assets/PeriodPicker/jquery.periodpicker.css');
        $this->fileJs('/render/inputes/ZPeriodPickerWidget/assets/PeriodPicker/jquery.periodpicker.full.min.js');
    }

    public $_layout = [

        'multi_attr' => <<<HTML
        <input id="{start_id}" name="{modelClass}[{attr_start}]" type="text" value="{value_start}"/>
        <input id="{end_id}" name="{modelClass}[{attr_end}]" type="text" value="{value_end}"/>        
HTML,
        'json' => <<<HTML
        <input id="{start_id}" type="text" value="{value_start}"/>
        <input id="{end_id}" type="text" value="{value_end}"/>        
        <input id="{main_input}" name="{modelClass}[{attr}][]" type="hidden" value="{value}"/>        
HTML,
        'string' => <<<HTML
        <input id="{start_id}" type="text" value="{value_start}"/>
        <input id="{end_id}" type="text" value="{value_end}"/>        
        <input id="{main_input}" name="{modelClass}[{attr}]" type="hidden" value="{value}"/>        
HTML,
        'js' => <<<JS
       
        jQuery('#{start_id}').periodpicker({
        
            end: '#{end_id}',
               onOkButtonClick: function () {
                    setValue();
                 },     
             });



        function setValue() {
                                
                                
              var start_date =  $('#{start_id}').val();                     
              var end_id = $('#{end_id}').val(); 
               console.log('start_date = ' + start_date);
               console.log('end_id = ' + end_id);
               
               
               
                   
                  
                    
                                    
                 var v = jQuery('#{start_id}').periodpicker('value');
                 console.log('v = ' + v);
                 
                 var blkstr = $.map(v, function(val,index) {
                 var str = index + ":" + val;
                    return str;
                 }).join(" | ");
                 
                 $("#main_input").val(blkstr);
                 console.log("blkstr =  " + blkstr);
        }  
        
JS,
        'stiring' => <<<JS
                
                
         jQuery('#{start_id}').periodpicker({
        
            end: '#{end_id}',
               onOkButtonClick: function () {
                    setValue();
                 },     
             });

  
                
                
JS,


    ];

    public function codes()
    {
        $attr_start = $this->_config['attr_start'];
        $attr_end = $this->_config['attr_end'];
        $value_start = $this->_config['value_start'];
        $value_end = $this->_config['value_end'];

        switch ($this->_config['type']) {

            case self::type['multi_attr']:
                $this->htm = strtr($this->_layout[$this->_config['type']], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attr_start}' => $attr_start,
                    '{attr_end}' => $attr_end,
                    '{value_start}' => $value_start,
                    '{value_end}' => $value_end,
                ]);
                break;

            case self::type['json']:
                $this->htm = strtr($this->_layout[$this->_config['type']], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attr_start}' => $attr_start,
                    '{attr_end}' => $attr_end,
                    '{value_start}' => $value_start,
                    '{value_end}' => $value_end,
                    '{value}' => $this->value,
                    '{attr}' => $this->attribute,
                    '{main_input}' => 'main' . $this->id
                ]);

                break;

            case self::type['string']:
               

                break;
        }


        $this->js = strtr($this->_layout['js'], [
            '{start_id}' => 'start' . $this->id,
            '{end_id}' => 'end' . $this->id,
        ]);

    }

}



