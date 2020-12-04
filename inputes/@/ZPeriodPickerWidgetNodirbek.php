<?php

/**
 * @author  NurbekMakhmudov
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

/**
 * Class    ZPeriodPickerWidget
 * @package zetsoft\widgets\inputes
 * https://xdsoft.net/jqplugins/periodpicker/
 * @author NurbekMakhmudov
 * @todo  PeriodPickerWidget  is in three modules
 */
class ZPeriodPickerWidgetNodirbek extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['multi_attr'],
        'delimiter' => '|',
        'attr_start' => '',
        'attr_end' => '',
        'value_start' => '',
        'value_end' => '',
        'value' => '',
        'string_value' => '',
        'showDatepickerInputs' =>'',


        'timepicker' => false,
        'lang' => self::lang['ru'],
        'isCompactMode' => false,
    ];

    public const type = [
        'multi_attr' => 'multi_attr',
        'json' => 'json',
        'string' => 'string',
    ];

    public const lang = [
        'ru' => 'ru',
        'en' => 'en',

    ];

    public function asset()
    {
        $this->fileCss('/render/inputes/ZPeriodPickerWidget/assets/5_46/jquery.periodpicker.min.css');
        $this->fileCss('/render/inputes/ZPeriodPickerWidget/assets/5_46/jquery.timepicker.min.css');

        $this->fileJs('/render/inputes/ZPeriodPickerWidget/assets/5_46/jquery.periodpicker.full.min.js');
        $this->fileJs('/render/inputes/ZPeriodPickerWidget/assets/5_46/jquery.timepicker.min.js');
    }

    public $_layout = [
        'multi_attr' => <<<HTML
        <input id="{start_id}" name="{modelClass}[{attr_start}]" type="text" value="{value_start}"/>
        <input id="{end_id}" name="{modelClass}[{attr_end}]" type="text" value="{value_end}"/>        
HTML,
        'multi_attr_js' => <<<JS
        if ('{isCompactMode}'){
             jQuery('#{start_id}').periodpicker({
             end: '#{end_id}',   
             timepicker: '{timepicker}',
             lang: '{lang}',  
             cells: [1, 1],
             withoutBottomPanel: true,
             yearsLine: false,
             title: false,
             closeButton: false,
             fullsizeButton: false
             });   
        
        }else {
             jQuery('#{start_id}').periodpicker({
              end: '#{end_id}',     
              lang: '{lang}',
              timepicker: '{timepicker}',           
                });   
        }
JS,


        'json' => <<<HTML
        <input id="{start_id}" type="text" value="{value_start}"/>
        <input id="{end_id}" type="text" value="{value_end}"/>        
        <input id="{main_input}" name="{modelClass}[{attr}][]" type="hidden" value="{value}"/>    
HTML,
        'json_js' => <<<JS
        if ('{isCompactMode}'){
        jQuery('#{start_id}').periodpicker({
        end: '#{end_id}',
        lang: '{lang}',
        cells: [1, 1],
        withoutBottomPanel: true,
        yearsLine: false,
        title: false,
        closeButton: false,
        fullsizeButton: false,
        timepicker: '{timepicker}',
            onAfterHide: function () {
              var start_id =  $('#{start_id}').val();                     
              var end_id = $('#{end_id}').val();
              value = [
                 start_id,
                 end_id  
              ];
              $("input").attr("value", value);  
            },     
        });
        
        }else {
        jQuery('#{start_id}').periodpicker({
        end: '#{end_id}',
        lang: '{lang}',
        timepicker: '{timepicker}',
        
        onOkButtonClick: function () {
          var start_id =  $('#{start_id}').val();                     
          var end_id = $('#{end_id}').val();
          value = [
             start_id,
             end_id  
          ];
          $("input").attr("value", value);
        },     
        });
        }
JS,


        'string' => <<<HTML
        <input id="{start_id}" type="text" value="{value_start}"/>
        <input id="{end_id}" type="text" value="{value_end}"/>   
        <input id="{string_input}" name="{modelClass}[{attr}]" type="hidden" value="{string_value}"/>        
HTML,
        'string_js' => <<<JS
        if ('{isCompactMode}'){
         jQuery('#{start_id}').periodpicker({
           lang: '{lang}',
           timepicker: '{timepicker}',
           end: '#{end_id}',
           cells: [1, 1],
           withoutBottomPanel: true,
           yearsLine: false,
           title: false,
           closeButton: false,
           fullsizeButton: false,
                onAfterHide: function () {
                 var start_id =  $('#{start_id}').val();                     
                 var end_id = $('#{end_id}').val();
                 $("input").attr("value", start_id + '{delimiter}' + end_id);
                 },
        });
    
        }else {
        jQuery('#{start_id}').periodpicker({
           lang: '{lang}',
           timepicker: '{timepicker}',
           end: '#{end_id}',
            onOkButtonClick: function () {
             var start_id =  $('#{start_id}').val();                     
             var end_id = $('#{end_id}').val();
             $("input").attr("value", start_id + '{delimiter}' + end_id);
            },     
        });
        
        }
JS,
    ];

    public function codes()
    {
        $delimiter = $this->_config['delimiter'];
        $attr_start = $this->_config['attr_start'];
        $attr_end = $this->_config['attr_end'];
        $value = $this->_config['value'];

        switch ($this->_config['type']) {

            case self::type['multi_attr']:
                $this->htm = strtr($this->_layout[$this->_config['type']], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attr_start}' => $attr_start,
                    '{attr_end}' => $attr_end,
                    '{value_start}' => $this->model->$attr_start,
                    '{value_end}' => $this->model->$attr_end,
                ]);

                $this->js = strtr($this->_layout['multi_attr_js'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{timepicker}' => $this->_config['timepicker'],
                    '{lang}' => $this->_config['lang'],
                    '{isCompactMode}' => $this->_config['isCompactMode'],
                ]);
                break;

            case self::type['json']:
                $this->htm = strtr($this->_layout[$this->_config['type']], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attr_start}' => $attr_start,
                    '{attr_end}' => $attr_end,
                    '{value_start}' => ZArrayHelper::getValue($this->value, 0),
                    '{value_end}' => ZArrayHelper::getValue($this->value, 1),
                    '{value}' => $value,
                    '{attr}' => $this->attribute,
                    '{main_input}' => 'main_input' . $this->id
                ]);

                $this->js = strtr($this->_layout['json_js'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{main_input}' => 'main_input' . $this->id,
                    '{timepicker}' => $this->_config['timepicker'],
                    '{lang}' => $this->_config['lang'],
                    '{isCompactMode}' => $this->_config['isCompactMode'],
                ]);
                break;

            case self::type['string']:
                $value = explode($delimiter, $this->value);
                $this->htm = strtr($this->_layout['string'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attr_start}' => $attr_start,
                    '{attr_end}' => $attr_end,
                    '{value_start}' => ZArrayHelper::getValue($value, 0),
                    '{value_end}' => ZArrayHelper::getValue($value, 1),
                    '{string_value}' => $this->value,
                    '{attr}' => $this->attribute,
                    '{string_input}' => 'string_input' . $this->id
                ]);

                $this->js = strtr($this->_layout['string_js'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{main_input}' => 'main_input' . $this->id,
                    '{delimiter}' => '' . $delimiter,
                    '{string_input}' => 'string_input' . $this->id,
                    '{timepicker}' => $this->_config['timepicker'],
                    '{lang}' => $this->_config['lang'],
                    '{isCompactMode}' => $this->_config['isCompactMode'],
                ]);
                break;
        }

    }

}



