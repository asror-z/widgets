<?php

/**
 *  @source: https://github.com/qiuyaofan/datepicker 
 *  @author: Odilov Shukurullo
 */
namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;
use yii\web\View;

class ZQDatepickerWidget extends ZWidget
{

    /**
     * Configuration for input(s)
     */
    public $config = [];
    public $_config = [

      'format' => ZQDatepickerWidget::Formats['datetime'],
      'size' => ZQDatepickerWidget::Sizes['date-time'],
      'icon' => "c-datepicker-range__icon kxiconfont icon-clock",
      'placeholder' => "Select...",
      'startPlaceholder' => "Start...",
      'endPlaceholder' => "End...",
      'language' => 'en',
      'isRange' => false,
      'hasShortcut' => false,
      'shortcutOptions' => [],
      'min' => '',
      'max' => '',
      'between' => '',
    ];

    /**
     * Constants
     */
    public const Formats = [

      'datetime' => "YYYY-MM-DD HH:mm:ss",
      'date' => "YYYY-MM-DD",
      'time' => "HH:mm:ss",
      'month' => "YYYY-MM",
      'year' => "YYYY",

    ];

    public const Sizes = [
        'date-time' => "",
        'only-time' => 'only-time',
        'only-date' => 'only-date',
    ];

    /**
     * Get label for Input
    */
    public function getInputLabel()
    {
        if ($this->_config['label'] != "") {
          return $this->_config['label'];
        }
        elseif ($this->modelCheck()) {
          return $this->model->getAttributeLabel($this->attribute);
        }
        else return "";
    }

    /**
     * Get JS config
    */

    public function getJsConfig()
    {
      $jsConfig = [];
      $jsConfig['format'] = $this->_config['format'];
      $jsConfig['language'] = $this->_config['language'];
      $jsConfig['isRange'] = $this->_config['isRange'];
      $jsConfig['hasShortcut'] = $this->_config['hasShortcut'];
      $jsConfig['shortcutOptions'] = $this->_config['shortcutOptions'];
      $jsConfig['max'] = $this->_config['max'];
      $jsConfig['min'] = $this->_config['min'];
      $jsConfig['between'] = $this->_config['between'];
      return json_encode($jsConfig);
    }
    

    public $layout = [];
    public $_layout = [

            'single' => <<<HTML
            
                 <div class="row">
                   <div class="col-sm-12"   >
                     <label for="{id}" class="control-label" >{label}</label><br>
                     <div class="c-datepicker-date-editor c-datepicker-single-editor" id="div-{id}">
                       <i class="{icon}"></i>
                       <input type="text" autocomplete="off" name="{name}" placeholder="{placeholder}" class="c-datepicker-data-input {size}" value="{value}" id="{id}">
                     </div>
                     </div>
                 </div>
HTML,

          'range' => <<<HTML
          
            <div class="row">
              <div class="col-sm-12"   >
                 <label for="{id}" class="control-label" >{label}</label><br>
                 <div class="c-datepicker-date-editor" id="div-{id}">
                   <i class="{icon}"></i>
                    <input placeholder="{startPlaceholder}" name="{name}[start]" class="c-datepicker-data-input {size}" value="{startValue}">
                    <span class="c-datepicker-range-separator">-</span>
                    <input placeholder="{endPlaceholder}" name="{name}[end]" class="c-datepicker-data-input {size}" value="{endValue}">
                 </div>
              </div>
            </div>

HTML,

    'js' => <<<JS

          $('#div-{id}').datePicker({json});

      
JS,
  ];

    public function asset()
    {

       $this->fileCss("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/css/datepicker.css");
       $this->fileCss("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/css/iconfont.css");

       $this->fileJs("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/js/plugins/jquery.js", View::POS_END);
       $this->fileJs("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/js/plugins/moment.min.js", View::POS_END);
       $this->fileJs("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/js/datepicker.all.js", View::POS_END);
       $this->fileJs("https://cdn.statically.io/gh/qiuyaofan/datepicker/af09df99/js/datepicker.en.js", View::POS_END);

    }

    public function codes()
    {

        $template = isset($this->_config['isRange']) && $this->_config['isRange'] === true ? $this->_layout['range'] : $this->_layout['single'];

        $value =  $this->modelCheck() ? $this->value : '';
        $startValue = "";
        $endValue = "";

        $type = $this->model->columns['jsonb_1']->dbType;

        if ($type == 'json' && $value != "") {
          $startValue = isset($value['start']) ? $value['start'] : "";
          $endValue = isset($value['end']) ? $value['end'] : "";
          $value = isset($value['end']) ? $value['end'] : $value;
        }

        $this->htm = strtr($template, [
                '{size}' => $this->_config['size'],
                '{icon}' => $this->_config['icon'],
                '{placeholder}' => $this->_config['placeholder'],
                '{startPlaceholder}' => $this->_config['startPlaceholder'],
                '{endPlaceholder}' => $this->_config['endPlaceholder'],
                '{label}' => $this->inputLabel,
                '{id}' => $this->id,
                '{name}' => $this->modelCheck() ? $this->name : '',
                '{value}' => $value,
                '{startValue}' => $startValue,
                '{endValue}' => $endValue,
            ]
        );

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{json}' => $this->jsConfig,
        ]);
    }
}
