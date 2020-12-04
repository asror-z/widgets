<?php

/**
 * @author NurbekMakhmudov
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZDateRangePickerWidgetNurbek
 * @package zetsoft\widgets\inputes
 * http://www.daterangepicker.com/
 * @todo  DateRangePickerWidget  is in three modules
 */
class ZDateRangePickerWidgetNurbek extends ZWidget
{
    public $config = [];
    public $_config = [
        'type' => self::type['multi_attr'],
        'delimiter' => '|',
        'value_start' => '',
        'value_end' => '',
        'value' => '',
        'string_value' => '',
        'string_input' => '',
        'attributeStart' => '',
        'attributeEnd' => '',
        'attr' => '',
        'start_id' => '',
        'end_id' => '',
    ];

    public const type = [
        'multi_attr' => 'multi_attr',
        'json' => 'json',
        'string' => 'string',
    ];

    public function asset()
    {
        $this->fileCss('https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.js');
    }

    public $_layout = [
        'multi_attr' => <<<HTML
            <div class="col-md-4 col-md-offset-2 demo">
                <h4>Date Range Picker</h4>                
                <input id="{start_id}"  name="{modelClass}[{attributeStart}]" type="text" value="{value_start}" class="form-control">
                <input id="{end_id}" name="{modelClass}[{attributeEnd}]" type="hidden" value="{value_end}" class="form-control"/>        
            </div>
HTML,
        'multi_attr_js' => <<<JS
                $('#{start_id}').daterangepicker();
                $('#{start_id}').on('apply.daterangepicker', function(ev, picker) {
                  
                  $('#{start_id}').val(picker.startDate.format('YYYY-MM-DD'));
                  $('#{end_id}').val(picker.endDate.format('YYYY-MM-DD'));
                  
                });

            /*    $(document).ready(function () {
                var options = {};
                options.autoApply = true;
                
                $('#{start_id}').daterangepicker(options,
                    function (start, end, label) {
                     $('#{start_id}').val(start.format('YYYY-MM-DD'));
                     $('#{end_id}').val(end.format('YYYY-MM-DD'));
                    }).click();
            });
            */
JS,


        'json' => <<<HTML
            <div class="col-md-4 col-md-offset-2 demo">
                <h4>Date Range Picker</h4>                
                <input id="{start_id}"  name="{modelClass}[{attributeStart}]" type="text" value="{value_start}" class="form-control">        
                <input id="{end_id}"  name="{modelClass}[{attributeEnd}]" type="text" value="{value_end}" hidden class="form-control">        
                <input id="{main_input}" name="{modelClass}[{attr}][]" type="hidden" value="{value}" hidden/>
            </div>
HTML,
        'json_js' => <<<JS
        $(document).ready(function () {
                var options = {};
                options.autoApply = false;
                
                $('#{start_id}').daterangepicker(options,
                    function (start, end, label) {
                      value = [
                         start.format('YYYY-MM-DD'),
                         end.format('YYYY-MM-DD'),
                      ];
                      $('#{main_input}').attr("value", value);
                    }).click();
            });
JS,


        'string' => <<<HTML
            <div class="col-md-4 col-md-offset-2 demo">
                <h4>Date Range Picker</h4>                
                <input id="{start_id}"  name="{modelClass}[{attributeStart}]" type="text" value="{value_start}" class="form-control">        
                <input id="{end_id}"  name="{modelClass}[{attributeEnd}]" type="hidden" value="{value_end}"  class="form-control">        
                <input id="{string_input}" name="{modelClass}[{attr}]" type="hidden" value="{string_value}"/>        
            </div>
HTML,
        'string_js' => <<<JS
            $(document).ready(function () {
                            var options = {};
                            options.autoApply = false;
                            
                            $('#{start_id}').daterangepicker(options,
                                function (start, end, label) {
                                  $('#{string_input}').attr("value", start.format('YYYY-MM-DD') + '{delimiter}' + end.format('YYYY-MM-DD'));
                                }).click();
                        });
JS,
    ];

    public function codes()
    {
        $delimiter = $this->_config['delimiter'];
        $attributeStart = $this->_config['attributeStart'];
        $attributeEnd = $this->_config['attributeEnd'];
        $value = $this->_config['value'];

        switch ($this->_config['type']) {

            case self::type['multi_attr']:
                $this->htm = strtr($this->_layout['multi_attr'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attributeStart}' => $attributeStart,
                    '{attributeEnd}' => $attributeEnd,
                    '{value_start}' => $this->model->$attributeStart,
                    '{value_end}' => $this->model->$attributeEnd,
                ]);

                $this->js = strtr($this->_layout['multi_attr_js'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                ]);
                break;

            case self::type['json']:
                $this->htm = strtr($this->_layout[$this->_config['type']], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attributeStart}' => $attributeStart,
                    '{attributeEnd}' => $attributeEnd,
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
                ]);
                break;

            case self::type['string']:
                $value = explode($delimiter, $this->value);
                $this->htm = strtr($this->_layout['string'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->modelClassName,
                    '{attributeStart}' => $attributeStart,
                    '{attributeEnd}' => $attributeEnd,
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
                ]);
                break;
        }

    }

}



