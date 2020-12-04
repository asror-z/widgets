<?php

/**
 * @author MurodovMirbosit
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;

class ZBootstrapImgCheckboxWidgetM extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
    'imgSize' => ZBootstrapImgCheckboxWidgetM::size['4'],
    'ImgClass' => '',
    'InputClass' => '',
    'classContent' => '',
    'content' => '',
    'label' => 'ZBimgCheckboxM',
    'src' => '/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg',
    'width' => '100px',
    'height' => '100px',
    'checkStyle' => self::checkStyle['custom'],
    'type' => ZBootstrapImgCheckboxWidgetM::type['checkbox'],
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];
    
    public const checkStyle = [
        'custom' => 'custom-checkbox',
        'border' => 'border'
    ];

    public $event = [];


    
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

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="col-md-{imgSize}">
        <div class="custom-control {checkStyle} image-checkbox {ImgClass}">
            <input name="{name}" value="0" type="hidden" id="{id}-hidden">
            <input type="{type}" class=" {InputClass}" id="{id}" name="{name}" value="{value}" {checked}>
            <label class="custom-control-label" for="{id}">
                <img src="{src}" alt="#" class="img-fluid imgClass">
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
           border: 1px solid red;
        }

        .custom-control.image-checkbox label:after, .custom-control.image-checkbox label:before {
            transition: opacity .3s ease;
            opacity: 0;
            left: .25rem;
            border:1px solid red;
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
       .custom-control.image-checkbox label:after{
        border: 1px solid red!important;
        }
CSS,

        'js' => <<<JS

        var checkBox = $('#{id}');

      checkBox.on('change', function() {
     
          if (this.checked)
              $(this).attr('value', 1);
          else
              $(this).attr('value', null);
    
      });

      checkBox.on('change', {change});
JS,
    ];

    public function asset()
    {
       $this->fileCss('https://cdn.statically.io/gh/iqbalfn/bootstrap-image-checkbox/master/dist/css/bootstrap-image-checkbox.css');
    }

    public function codes()
    {
        $checked = '';
        if ($this->value == 1)
            $checked = 'checked';

        $this->htm .= strtr($this->_layout['main'], [
            '{imgSize}' => $this->_config['imgSize'],
            '{label}' => $this->_config['label'],
            '{content}' => $this->_config['content'],
            '{ImgClass}' => $this->_config['ImgClass'],
            '{checked}' => $checked,
            '{InputClass}' => $this->_config['InputClass'],
            '{classContent}' => $this->_config['classContent'],
            '{src}' => $this->_config['src'],
            '{id}' => $this->id,
            '{value}' => $this->value,
            '{name}' => $this->name,
            '{checkStyle}' => $this->_config['checkStyle'],
            '{type}' => $this->_config['type'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{change}' => $this->eventCode('change'),
        ]);
        $this->css = strtr($this->_layout['css'], [

        '{width}'=> $this->_config['width'],
        '{height}'=> $this->_config['height'],
        ]);
    }
}
