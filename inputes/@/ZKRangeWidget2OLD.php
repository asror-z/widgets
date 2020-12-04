<?php
/**
 *
 * http://ionden.com/a/plugins/ion.rangeSlider/api.html
 * https://github.com/IonDen/ion.rangeSlider
 * https://github.com/asror-z
 * version 2.3.1
 */


namespace zetsoft\widgets\inputes;


use zetsoft\system\kernels\ZWidget;

class ZKRangeWidget2OLD extends ZWidget
{
    public $config = [];
    public $_config = [
        'skin' => self::skin['flat'],
        'type' => self::type['single'],
        'from' => 50,
        'to' => 100,
    ];

    public const type = [
        'single' => 'single',
        'double ' => 'double',
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
            <input type="text" id="{id}_slider" name="{name}[]" value="{value}" class="js-range-slider" hidden/>
HTML,
        'double' => <<<HTML
            <input type="text" id="{id}_L" name="{name}[]" value="{value_L}" class=''/>
            <input type="text" id="{id}_R" name="{name}[]" value="{value_R}"/>
            <input type="text" id="{id}_slider" value=""/>
HTML,
        'js' => <<<JS
        $("#{id}_slider").ionRangeSlider(
            {
                '*': '*',
                from: "{from}",
                to: "{to}",
            });


        $("#{id}_slider").change(function() {
            var slider_value = $(this).val();
            console.log($(this).val());
            let numbers=$(this).val().split(";")
            let classFrom=document.getElementsByClassName("irs-from");
            let classTo=document.getElementsByClassName("irs-from");
             if (classFrom[0].innerHTML==numbers[0]){
                
             }
            //If type single we write one id
            if(slider_value.search(";") == -1) {
                $("#{id}").val(slider_value)
            }
            //If type double we write double id
            else {
                var from = slider_value.substring(0, slider_value.search(";"));
                var to = slider_value.substring(slider_value.search(";") + 1);
                
                $("#{id}_L").val(from);
                $("#{id}_R").val(to);
            }
        });
JS,

        'css' => <<<CSS
           .irs--big .irs-bar {
    
        background-color: #00c851;
    border: 1px solid #00c851;
    background: linear-gradient(to bottom, #ffffff 0%, #00c851 30%, #00c851 100%);
    
   
}
CSS,


    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js');
    }

    public function codes()
    {
        $widget_configs = $this->GetWidgetConfigs();

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
                "'*': '*'" => $widget_configs,
                "{id}" => $this->id,
                "{from}" => ($this->modelCheck() && isset($this->value[0])) ? $this->value[0] : $this->_config['from'],
                "{to}" => ($this->modelCheck() && isset($this->value[1])) ? $this->value[1] : $this->_config['to'],
            ]);
         $this->css=strtr($this->_layout['css'],[]);
    }

    private function GetWidgetConfigs()
    {
        $json_widget_config = json_encode($this->config);
        $configs = substr($json_widget_config, 1, strlen($json_widget_config) - 2);
        return $configs;
    }
}
