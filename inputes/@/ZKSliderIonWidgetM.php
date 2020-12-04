<?php
/**
 *
 * http://ionden.com/a/plugins/ion.rangeSlider/api.html
 * https://github.com/IonDen/ion.rangeSlider
 * https://github.com/asror-z
 * version 2.3.1
 */


namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZKSliderIonWidgetM extends ZWidget
{
    public $config = [];
    public $_config = [
        'skin' => self::skin['flat'],
        'type' => self::type['single'],
        'from' => null,
        'to' => null,
        'min' => 0,
        'max' => 1000,
        'inputs_show' => false,
        'title' => 'Цена в суммах',
        'prettify' => true,
    ];

    public const type = [
        'double' => 'double',
        'single' => 'single',
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

    public $event = [];
    public $_event = [
        'onfinish' => "function (data) {console.log('finish')}",
        'onchange' => "function (data) {console.log('change')}"
    ];


    public $layout = [];
    public $_layout = [
        'single' => <<<HTML
         <div class="sliderION">
         {title}
         </div> 
         <input type="text" id="{id}_slider" name="{name}[]" value="{value}" class="js-range-slider" {hidden}>
HTML,
        'double' => <<<HTML
            <div class="sliderION">
            {title}
            </div> 
            <input type="text" id="{id}_L" name="{name}[]" value="{value_L}" class='align-left' {hidden}>
            <input type="text" id="{id}_R" name="{name}[]" value="{value_R}" class='pull-right' {hidden}>
            <input type="text" id="{id}_slider" class="js-range-slider" value="">
HTML,
        'js' => <<<JS
        $("#{id}_slider").ionRangeSlider(
            {
                '*': '*',
                from: "{from}",
                to: "{to}",
                min: {min},
                max: {max},
                values: {value},
                onFinish: {onfinish},
                prettify: {prettify},
                onChange: function(event) {
                
                    $('#{id}_R').val(event.to)
                    $('#{id}_L').val(event.from)
                },
            });
      
        $("#{id}_slider").on('mouseleave',function() {
            console.log('1')  
            var slider_value = $(this).val();
            
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
       
        
        $("#{id}_L, #{id}").change(function() {
        console.log('2')
            var val = $(this).prop("value");
            var instance = $(".js-range-slider").data("ionRangeSlider");
            instance.update({
                from: val
            });
        });
        $("#{id}_R").change(function() {
        console.log('3')
            var val = $(this).prop("value");
            var instance = $(".js-range-slider").data("ionRangeSlider");
            instance.update({
                to: val
            });
        });
JS,

        'css' => <<<CSS
           .irs--big .irs-bar {
                background-color: #00c851;
                border: 1px solid #00c851;
                background: linear-gradient(to bottom, #ffffff 0%, #00c851 30%, #00c851 100%);
            }
            #{id}_L{
                padding: 5px;
                width: 34%;
            }
            
            #{id}_R{
                padding: 5px;
                width: 34%;
                text-align: right;
            }
            .sliderION{
            text-align: center;
            font-size: 16px;
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

        $valueFrom = ZArrayHelper::getValue($this->value, 0);
        if (!empty($this->_config['from']))
            $valueFrom = $this->_config['from'];

        $valueTo = ZArrayHelper::getValue($this->value, 1);
        if (!empty($this->_config['to']))
            $valueTo = $this->_config['to'];

        $this->htm = strtr($this->_layout[$this->_config['type']], [
            '{id}' => $this->id,
            '{title}' => $this->_config['title'],
            '{name}' => $this->name,
            '{hidden}' => ($this->_config['inputs_show']) ? '' : 'hidden',
            '{value}' => $valueFrom,
            '{value_L}' => $valueFrom,
            '{value_R}' => $valueTo,
        ]);




        $this->js = strtr($this->_layout['js'],
            [
                "'*': '*'" => $widget_configs,
                '{id}' => $this->id,
                '{from}' => $valueFrom,
                '{to}' => $valueTo,
                '{value}' => $valueFrom ,
                '{min}' => $this->_config['min'],
                '{max}' => $this->_config['max'],
                '{prettify}' => $this->_config['prettify'],
                '{onfinish}' => $this->eventCode('onfinish'),
                '{onchange}' => $this->eventCode('onchange'),
            ]);
        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->id
        ]);

    }

    private function GetWidgetConfigs()
    {
        $json_widget_config = json_encode($this->config);
        return substr($json_widget_config, 1, strlen($json_widget_config) - 2);
    }
}
