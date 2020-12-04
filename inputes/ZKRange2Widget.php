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
use function Complex\theta;

class ZKRange2Widget extends ZWidget
{
    public $config = [];
    public $_config = [
        'start' => [50,70],
        'connect' => true,
        'format' => [
            'decimals' => 0,
        ],
        'inputs_show' => false,
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
           <div class="slider_div" id="{id}"></div>
HTML,
        'js' => <<<JS
        var slider = document.getElementById('{id}');

        noUiSlider.create(slider, {
            /*'*': '*',*/
            start: {start},
            'connect': true,
            tooltips: [{tooltips}],
            format: wNumb({format_save}),
        });
        
        slider.noUiSlider.on('update', function (values, handle) {
            var value = values[handle];
            $("#input-slider-{id}_"+handle).val(value);
        });
        
JS,
        'css' => <<<CSS
           .slider_div{
                margin-top: 40px;
           }
           input[id^="input-slider"] {
                padding: 5px;
           }
CSS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.css');

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.js');
    }

    public function codes()
    {
        if(isset($this->config['format']))
            $this->_config['format'] = array_merge($this->_config['format'], $this->_config['format']);
        else $this->_config['format'] = $this->_config['format'];
        $widget_configs = $this->GetWidgetConfigs();

        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
            '{name}' => $this->name,
        ]);

        $this->js = strtr($this->_layout['js'], [

            "'*': '*'" => $widget_configs,
            '{id}' => $this->id,
            "{start}" => ($this->modelCheck() && isset($this->value)) ?json_encode($this->value): json_encode($this->_config['start']),
            "{format}" => json_encode($this->_config['format']),
            "{format_save}" => '{decimals:'.$this->_config['format']['decimals'].'}',
        ]);

        $this->css = $this->_layout['css'];
    }

    private function GetWidgetConfigs()
    {
        $this->WidgetConfigGenerate();

        $json_widget_config = json_encode($this->config);
        $configs = substr($json_widget_config, 1, strlen($json_widget_config) - 2);
        return $configs;
    }

    private function WidgetConfigGenerate()
    {
        /*For generate n element*/
        $count = ($this->modelCheck() && isset($this->value)) ?count($this->value): count($this->_config['start']);

        for ($i = 0; $i < $count; $i++) {
            if ($this->_config['inputs_show']) {
                $this->_layout['js'] .= <<<JS
                    $("#input-slider-{id}_$i").change(function() {
                        var values = slider.noUiSlider.get();
                        values[$i] = this.value;
                        slider.noUiSlider.set(values);
                    });
JS;
                $this->_layout['main'] .= <<<HTML
                    <input type="text" name="{name}[]" id="input-slider-{id}_$i">
HTML;
            }
            else {
                $this->_layout['main'] .= <<<HTML
                    <input type="text" name="{name}[]" id="input-slider-{id}_$i" hidden>
HTML;
            }
        }

        $this->_layout['js'] = strtr($this->_layout['js'], [
            "{tooltips}" => implode(',', array_fill(0, $count, "wNumb({format})"))
        ]);
    }
}
