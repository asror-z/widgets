<?php

/**
 * @author MurodovMirbosit Dumster
 */

namespace zetsoft\widgets\inputes;

use zetsoft\dbitem\App\eyuf\CheckboxItem;
use zetsoft\system\kernels\ZWidget;

class ZBootstrapBorderRadioGroupWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
    'imgSize' => ZBootstrapBorderRadioGroupWidget::size['4'],
    'ImgClass' => '',
    'InputClass' => '',
    'classContent' => '',
    'content' => '',
    'label' => '',
    'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
    'width' => '150px',
    'height' => '150px',
    'borderType' => ZBootstrapBorderRadioGroupWidget::borderType['border-success'],
    'borderWidth' => ZBootstrapBorderRadioGroupWidget::borderWidth['border-2'],
    ];


    public const borderType = [
        'border-success' => 'border-success',
        'border-primary' => 'border-primary',
        'border-secondary' => 'border-secondary',
        'border-danger' => 'border-danger',
        'border-warning' => 'border-warning',
        'border-info' => 'border-info',
        'border-light' => 'border-light',
        'border-dark' => 'border-dark',
        'border-white' => 'border-white',

    ];

    public const borderWidth = [
        'border-1' => 'border-1',
        'border-2' => 'border-2',
        'border-3' => 'border-3',
        'border-4' => 'border-4',
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
    <div class="<!--col-md- -->{imgSize} m-auto">
        <div class="custom-control image-checkbox {ImgClass} hint--top" aria-label="{hint}">
            <input type="radio" class="<!--custom-control-input--> {InputClass}" id="{id}" name="{name}[]" value="{value}" {checked}>
            <label id="label-{id}" class="custom-control-label p-1" for="{id}">
                {items}
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
        
        .border-2{
            border-width: 1px !important;
        }
        
        .border-2{
            border-width: 2px !important;
        }
        
        .border-3{
            border-width: 3px !important;
        }
        
        .border-4{
            border-width: 4px !important;
        }

        /*.form-group-image-checkbox.is-invalid .invalid-feedback {
            display: block;
        }*/
        .imgClass{
            width: {width}!important;
            height: {height}!important;
        }
CSS,

        'js' => <<<JS
                   
            var checked = $("*[checked]");    
            console.log(checked);
            var checkedLabel = $(checked).next('.custom-control-label');
            $(checkedLabel).addClass('border {borderType} {borderWidth}')
  
            $('.image-checkbox > label').on("click", function() {
                console.log('click');
                $("label").removeClass("border");
                $(this).addClass('border {borderType} {borderWidth}');
                
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
                '{content}' => $this->_config['content'],
                '{ImgClass}' => $this->_config['ImgClass'],
                '{InputClass}' => $this->_config['InputClass'],
                '{classContent}' => $this->_config['classContent'],
                '{id}' => $this->id++ . random_int(1, 999999999),
                '{name}' => $this->name,
                '{checked}' => $checked,
                '{value}' => $key,
                '{items}' => $value,
                '{hint}' => $value,
            ]);

        }

        $this->htm .= $content;

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id++ . random_int(1, 999999999),
            '{change}' => $this->eventCode('change'),
            '{unchecked}' => $this->eventCode('unchecked'),
            '{checked}' => $this->eventCode('checked'),
            '{borderType}' => $this->_config['borderType'],
            '{borderWidth}' => $this->_config['borderWidth'],   
        ]);
        $this->css = strtr($this->_layout['css'], [

        '{width}'=> $this->_config['width'],
        '{height}'=> $this->_config['height'],
        ]);
    }
}
