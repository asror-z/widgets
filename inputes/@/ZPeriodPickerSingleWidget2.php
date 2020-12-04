<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\consts\ZPeriodPickerWidgetConst;
use yii\bootstrap\Html;
use zetsoft\system\kernels\ZWidget;
use kartik\popover\PopoverX;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Json;
use function DusanKasan\Knapsack\splitWith;

/**
 * Class    ZPeriodPickerWidget
 * @package zetsoft\widgets\inputes
 *
 * https://xdsoft.net/jqplugins/periodpicker/
 */
class ZPeriodPickerSingleWidget2 extends ZWidget implements ZPeriodPickerWidgetConst
{

    public static $grapes = [
        'enable' => true,
        'icon' => null,
        'image' => null,
        'height' => '500px',
        'width' => '700px',
        'dbType' => null,
        'modalWidth' => null,
        'title' => Azl . null,
        'descs' => Azl . null,
    ];


    public $config = [];
    public $_config = [
        'type' => self::type['multi_attr'],
        'attribute_start' => '',
        'attribute_end' => ''
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
<input id="{start_id}" name="{modelClass}[{attribute_start}]" type="text" value="{value_start}" />
<input id="{end_id}" name="{modelClass}[{attribute_end}]" type="text" value="{value_end}"/>
HTML,
        'json' => <<<HTML
<input id="{start_id}" name="{modelClass}[{attribute}][]" type="text" value="{value_start}" />
<input id="{end_id}" name="{modelClass}[{attribute}][]" type="text" value="{value_end}"/>
<!--
<input id="{main_input}" name="{modelClass}[{attribute}][]" type="hidden" value="{value}"/>-->

HTML,

        'js' => <<<JS
       jQuery('#{start_id}').periodpicker({
 end: '#{end_id}'
});
JS,
        /*'json_js' => <<<JS
      function setValue() {
           value_start = $('#{start_id}').val();
          value_end = $('#{end_id}').val();
          value = [
            value_start,
            value_end
          ];
          
          $('#{start_id}').val(value);
      }
      
      $('#{start_id}').change(function() {
           setValue();
      })
      $('#{end_id}').change(function() {
            setValue()
      })
      
JS,*/


    ];

    public function codes()
    {
        $attribute_start = $this->_config['attribute_start'];
        $attribute_end = $this->_config['attribute_end'];

        switch ($this->_config['type']) {

            case self::type['multi_attr']:
                $this->htm = strtr($this->_layout['multi_attr'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->model->className,
                    '{attribute_start}' => $attribute_start,
                    '{attribute_end}' => $attribute_end,
                    '{value_start}' => $this->model->$attribute_start,
                    '{value_end}' => $this->model->$attribute_end,
                ]);
                break;
            case self::type['json']:
          /*      $this->js .= strtr($this->_layout['json_js'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{main_input}' => 'main' . $this->id
                ]);*/

                $this->htm = strtr($this->_layout['json'], [
                    '{start_id}' => 'start' . $this->id,
                    '{end_id}' => 'end' . $this->id,
                    '{modelClass}' => $this->model->className,
                    '{value}' => $this->value,
                    '{attribute}' => $this->attribute,
                    '{main_input}' => 'main' . $this->id
                ]);
                break;
        }

        $this->js .= strtr($this->_layout['js'], [
            '{start_id}' => 'start' . $this->id,
            '{end_id}' => 'end' . $this->id,
        ]);
    }

}



