<?php


namespace zetsoft\widgets\incores;


use zetsoft\system\kernels\ZWidget;

class ZkFirstWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'skin' => self::skin['flat'],
        'type' => self::type['single'],
        'min' => 0,
        'max' => 100,
        'from' => 50,
        'to' => 100,
        'step' => 1,
        'prefix' => '',
        'value' => ''
    ];

    public const type = [
        'single' => 'single',
        'double ' => 'double ',
    ];

    /*Style*/
    public const skin = [
        'flat' => 'flat',
        'big' => 'big',
        'modern' => 'modern',
        'sharp' => 'sharp',
        'round' => 'round',
        'square' => 'square',
    ];

    public $layout = [];
    public $_layout = [
        'single' => <<<HTML
            <input type="text" id="{id}_slider" name="{name}[]" value="{value}" class="js-range-slider"/>
HTML,
        'double' => <<<HTML
            <input type="text" id="{id}_slider" name="slider_to_{id}" value=""/>
            <select id="{id}" name="{name}[]" class="irs-hidden-input" multiple>
              <option id="{id}_L" value="{value_L}" selected></option>
              <option id="{id}_R" value="{value_R}" selected></option>
            </select>
HTML,
        'js' => <<<JS
        $("#{id}_slider").ionRangeSlider(
            {
                type: "{type}",
                skin: "{skin}",
                min: "{min}",
                max: "{max}",
                from: "{from}",
                to: "{to}",
                step: "{step}",
                prefix: "{prefix}",
            });


        $("#{id}_slider").change(function() {
            var slider_value = $(this).val();
            //If type single we write one id
            if(slider_value.search(";") == -1) {
                $("#{id}").val(slider_value)
            }
            //If type double we write double id
            else {
                var from = slider_value.substring(0, slider_value.search(";"));
                var to = slider_value.substring(slider_value.search(";") + 1);
                // alert($("#{id}_L").val); 
                $("#{id}_L").val(from);
                $("#{id}_R").val(to);

            }
        });
     
JS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{name}' => $this->name,
            '{value}' => ($this->modelCheck() && isset($this->value[0])) ? $this->value[0] : $this->_config['from'],

            /*IF type double*/
            '{value_L}' => ($this->modelCheck() && isset($this->value[0])) ? $this->value[0] : $this->_config['from'],
            '{value_R}' => ($this->modelCheck() && isset($this->value[1])) ? $this->value[1] : $this->_config['to'],
        ]);
        $this->js = strtr($this->_layout['js'],
            [
                "{id}" => $this->id,
                "{type}" => $this->_config['type'],
                "{skin}" => $this->_config['skin'],
                "{min}" => $this->_config['min'],
                "{max}" => $this->_config['max'],
                "{from}" => ($this->modelCheck() && isset($this->value[0])) ? $this->value[0] : $this->_config['from'],
                "{to}" => ($this->modelCheck() && isset($this->value[1])) ? $this->value[1] : $this->_config['to'],
                "{step}" => $this->_config['step'],
                "{prefix}" => $this->_config['prefix'],
            ]);
    }
}
