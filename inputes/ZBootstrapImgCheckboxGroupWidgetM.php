<?php

/**
 * @author MurodovMirbosit XakimjonErgashev
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZBootstrapImgCheckboxGroupWidgetM extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
    'imgSize' => ZBootstrapImgCheckboxGroupWidgetM::size['12'],
    'ImgClass' => '',
    'InputClass' => '',
    'classContent' => '',
    'content' => '',
    'label' => '',
    'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
    'WHClass' => 'w-20 h-20',
    'type' => ZBootstrapImgCheckboxGroupWidgetM::type['checkbox'],
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
        <div class="col-{imgSize} {class} py-2">
        <div class="custom-control custom-checkbox image-checkbox ImgClass bootstrap-change">
            <input type="{type}" class="custom-control-input {InputClass}" id="{id}" name="{name}[]" value="{value}" {checked}>
            <div class="content {classContent}">{content}</div>
            <label class="custom-control-label" for="{id}">
                <div class="{WHClass}">{src}</div>
                {label}
            </label>
        </div>
    </div>   
HTML,

        'css' => <<<CSS
     .custom-control.image-checkbox {
            position: relative;
            padding-left: 0;
        }

        .custom-control.image-checkbox .custom-control-input:checked ~ .custom-control-label:after, .custom-control.image-checkbox .custom-control-input:checked ~ .custom-control-label:before {
            opacity: 1;
        }

        .custom-control.image-checkbox label {
            cursor: pointer;
        }

        .custom-control.image-checkbox label:before {
            border-color: #007bff;
            background-color: #007bff;
        }

        .custom-control.image-checkbox label:after, .custom-control.image-checkbox label:before {
            transition: opacity .3s ease;
            opacity: 0;
            left: .25rem;
        }

        .custom-control.image-checkbox label:focus, .custom-control.image-checkbox label:hover {
            opacity: .8;
        }

        .custom-control.image-checkbox label img {
            border-radius: 2.5px;
        }

        .form-group-image-checkbox.is-invalid .invalid-feedback {
            display: block;
        }
      
CSS,

        'js' => <<<JS
$('.bootstrap-change').on('change', {change});
JS,
    ];

    public function asset()
    {
       $this->fileCss('https://cdn.statically.io/gh/iqbalfn/bootstrap-image-checkbox/master/dist/css/bootstrap-image-checkbox.css');
    }

    public function codes()
    {


        $content = '';
        foreach ($this->data as $key => $value)
        {
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
