<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZBootstrapItemCheckboxGroupWidgetM extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
    'imgSize' => ZBootstrapItemCheckboxGroupWidgetM::size['4'],
    'ImgClass' => '',
    'InputClass' => '',
    'classContent' => '',
    'content' => '',
    'label' => '',
    'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
    'width' => '100px',
    'height' => '100px',
    'type' => ZBootstrapItemCheckboxGroupWidgetM::type['radio'],
    'title' => '',
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
    public $_event = [

        'checked' => "console.log('CHECKED');",
        'unchecked' => "console.log('UNCHECKED');"
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="col-md-{imgSize}">
        <div class="custom-control custom-checkbox image-checkbox {ImgClass} hint--top" aria-label="{hint}">
            <input type="{type}" class="custom-control-input {InputClass}" id="{id}" name="{name}[]" value="{value}" {checked}>
            <label class="custom-control-label" for="{id}">
                {src}
                {label}
            </label>
            <p for="{id}">{title}</p>
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
        .imgClass{
            width: {width};
            height: {height};
        }
CSS,

        'js' => <<<JS

JS,
    ];

    public function asset()
    {
       $this->fileCss('https://cdn.statically.io/gh/iqbalfn/bootstrap-image-checkbox/master/dist/css/bootstrap-image-checkbox.css');
    }

    public function codes()
    {


        $content = '';
        /** @var CheckboxItem $value */
        foreach ($this->data as $key => $value)
        {
            $checked = '';
            if ($this->value == $key)
                $checked = 'checked';

            if (is_array($this->value))
                foreach ($this->value as $keyThis => $val)
                    if ($val == $key)
                        $checked = 'checked';

            $content .= strtr($this->_layout['main'], [
                '{imgSize}' => $this->_config['imgSize'],
                '{label}' => $this->_config['title'],
                '{content}' => $this->_config['content'],
                '{ImgClass}' => $this->_config['ImgClass'],
                '{InputClass}' => $this->_config['InputClass'],
                '{classContent}' => $this->_config['classContent'],
                '{id}' => $this->id++,
                '{name}' => $this->name,
                '{checked}' => $checked,
                '{value}' => $key,
                '{src}' => $value->icon,
                '{hint}' => $value->text,
                '{title}' => $value->title,
                '{type}' => $this->_config['type'],
            ]);

        }

        $this->htm .= $content;

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id++,
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
        ]);
        $this->css = strtr($this->_layout['css'], [

        '{width}'=> $this->_config['width'],
        '{height}'=> $this->_config['height'],
        ]);
    }
}
