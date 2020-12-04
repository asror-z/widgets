<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inptest;

use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHRadioWidget
 * @package widgets\inputes
 *
 *
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#checkbox()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZCheckboxImageGroupWidget123 extends ZWidget
{

    public $data = [
         1 => [
               'label' => 'label1',
               'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
           ],
         2 => [
               'label' => 'label2',
               'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYh-gwkaik2hwrBRWcjqm-LHucQGKcqVGdE6B5pMuAjzz_zLGb',
           ]
    ];

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZCheckboxImageGroupWidget::type['MaterialCheckbox'],

    ];

    public const type = [
        'MaterialCheckbox' => 'MaterialCheckbox',
        'DefaultCheckbox' => 'DefaultCheckbox',
    ];

    public $layout = [];
    public $_layout = [
        'MaterialCheckbox' => <<<HTML
        <div class="form-check material-checkbox">
           <img class="checkable" src="{img}" id="{id}-img"/>
           <input type="radio" class="form-check-input" id="{id}-material" value="{value}" name="{name}[]">
       <label class="form-check-label" for="{id}-material">{label}</label>
        </div>
HTML,
        'DefaultCheckbox' => <<<HTML
        <div class="form-check">
           <input type="checkbox" class="custom-control-input" id="{id}-material" value="{value}" name="{name}[]">
       <label class="custom-control-label" for="{id}-material">{label}</label>
        </div>
HTML,

        'js' => <<<JS
       
$(document).ready(function() {
    
    const checkBox = $('#{id}-material');
    const values = {json};
    const checkBoxes = $('.material-checkbox').find('.form-check-input');
    
    checkBoxes.each(function(key, v) {
    
        let val = $(v).attr('value');
        if (values.includes(val))
            $(v).attr('checked', 'checked');
             
    });
    
    checkBox.on('change', function() {
      if (typeof this.checked)
          $(this).attr('value', 1);
      else
          $(this).attr('value', 'f');
      
    });
    
});

JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/awesome-bootstrap-checkbox@1.0.1/demo/build.css');
    }

    public function codes()
    {

        $json = json_encode($this->value);

        $content = '';

        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout[$this->_config['type']], [
                '{key}' => $key,
                '{id}' => $this->id++ . random_int(1, 9999999),
                '{value}' => $key,
                '{name}' => $this->name,
                '{label}' => $value['label'],
                '{img}' => $value['img']
            ]);

        }
        $this->htm = $content;

        $this->js .= strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{json}' => $json,
        ]);
    }
}
