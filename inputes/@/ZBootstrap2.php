<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZBootstrap2 extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
        'imgSize' => ZBootstrap2::size['12'],
        'ImgClass' => '',
        'InputClass' => '',
        'classContent' => '',
        'content' => '',
        'label' => '',
        'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
        'WHClass' => 'w-20 h-20',
        'type' => ZBootstrap2::type['radio'],
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const size = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
        '11' => '11',
        '12' => '12',
    ];

    public $event = [];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div class="col-{imgSize} {class} py-2" >
        <div class="custom-control  custom-checkbox image-checkbox ImgClass bootstrap-change" id="check-{id}">
            <input type="{type}" class="{InputClass} <!--custom-control-input-->"  id="{id}" name="{name}[]" value="{value}" {checked}>
            <label class="custom-control-label {WHClass} image thumbnail" for="{id}">
                {src}
                {label}
            </label>
        </div>
        
    </div>   
      
HTML,

        'css' => <<<CSS
   .borderIn{
        border: 2px solid #00c851;
    }
    .thumbnail:hover{
        border: 2px solid #00c851;
        opacity: 0.5;

    }
      
CSS,

        'js' => <<<JS
        $('.bootstrap-change').on('change', {change});
        
        var checked = $("*[checked]");    
            console.log(checked);
            var checkedLabel = $(checked).next('.custom-control-label');
            $(checkedLabel).addClass('borderIn')
      
      $('.custom-checkbox > label').on("click", function () {
        var a = $(this).parentsUntil('.highlight-addon'); 
        a.find('label').removeClass('borderIn');
        $(this).addClass('borderIn');
    })
      
    
    
JS,
    ];

    public function asset()
    {
        $this->fileCss('https://cdn.statically.io/gh/iqbalfn/bootstrap-image-checkbox/master/dist/css/bootstrap-image-checkbox.css');
    }

    public function codes()
    {


        $content = '';
        foreach ($this->data as $key => $value) {
            $checked = '';
            if (is_array($this->value))
                foreach ($this->value as $val) {
                    if ($val == $key)
                        $checked = 'checked="checked"';
                }

            $content .= strtr($this->_layout['main'], [
                '{imgSize}' => $this->_config['imgSize'],
                '{label}' => $this->_config['label'],
                '{content}' => $this->_config['content'],
                '{class}' => $this->_config['class'],
                '{ImgClass}' => $this->_config['ImgClass'],
                '{InputClass}' => $this->_config['InputClass'],
                '{classContent}' => $this->_config['classContent'],
                '{id}' => $this->id++ . random_int(1, 9999999),
                '{name}' => $this->name,
                '{checked}' => $checked,
                '{value}' => $key,
                '{src}' => $value,
                '{type}' => $this->_config['type'],
                '{WHClass}' => $this->_config['WHClass']
            ]);

        }

        $this->htm .= $content;

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id++ . random_int(1, 9999999),
            '{change}' => $this->eventCode('change'),
        ]);
        $this->css .= strtr($this->_layout['css'], [
        ]);
    }
}
