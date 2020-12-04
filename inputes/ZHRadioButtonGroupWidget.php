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

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZHRadioButtonGroupWidget
 * @package widgets\inputes
 * https://getbootstrap.com/docs/4.3/components/button-group/
 *
 */
class ZHRadioButtonGroupWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'role' => 'group',
        'btnStyle' => 'btnStyle',
        'readonly' => true,
        'classActive' => 'RadioBtnGroupActive',
        'class' => '',
        'btnColor' => '#f3f3f3',
        'btnActiveColor' => '#fff',
        'hasPlace' => true,
        'parentClass' => '',

    ];

    public $active = [];
    public $_active = [
        'change' => true,
    ];

    public $event = [];
    public $_event = [
        'change' => <<<JS

        // console.log(event.target.value)
        console.log(this.value)
JS,

    ];


    public $layout = [];
    public $_layout = [


        'main' => <<<HTML
                  <div class="form-control border-0 d-flex h-auto">
                     <div class="row activeRadio-{id}">
                     <!--<div class="col-md-12 mr-2 fz-16">
                     {place}

                     </div>-->
                     <div class="col-md-12 mt-1">
                        {radio}
                     </div>
                     </div>
                     
                        {getIcon} 
                  </div>   
                  
HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix fa-2x {icon}"></i>&ensp;&ensp;
HTML,


        'css' => <<<CSS
.white-skin .RadioBtnGroupActive:not([disabled]):not(.disabled).active{
        background-color: {btnActive} !important;
      }
      .btnStyle {
        background-color: {btnStyle};
      }
CSS,

        //start: MurodovMirbosit 08.10.2020

        'js' => <<<JS
                                                              
        var radio = $('.activeRadio-{id}').find('.radioButton-{id}');

        radio.on('change', {change});
        
JS,

        //end
    ];


    public function codes()
    {

        $this->options = [
            'role' => $this->_config['role'],
            'options' => [
                'value' => $this->value,
            ],
            'class' => $this->_config['parentClass'],
            'value' => $this->value,
            'itemOptions' => [
                'class' => 'radioButton-' . $this->id,
                //'id' => $this->id,
                'labelOptions' => [
                    'class' => 'btn ' . $this->_config['classActive'] . ' ' . $this->_config['class'] . ' ' . $this->_config['btnStyle'],

                ]
            ],
        ];

        if (empty($this->model)) {
            $radio = ZHTML::radioButtonGroup(
                $this->name,
                null,
                $this->data,
                $this->options,
            );
        } else {
            $radio = ZHTML::activeRadioButtonGroup(
                $this->model,
                $this->attribute,
                $this->data,
                $this->options
            );
        }

        $getIcon = '';
        if ($this->_config['hasIcon']) {
            $getIcon = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        }

        $iconCode = strtr($this->_layout['icon'], [

        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{getIcon}' => $getIcon,
            '{radio}' => $radio,
            '{id}' => $this->id,
            '{icon}' => $this->_config['hasIcon'] ? $iconCode : '',
            '{class}' => $this->_config['class'],
        ]);


        $this->css = strtr($this->_layout['css'], [
            '{btnStyle}' => $this->_config['btnColor'],
            '{btnActive}' => $this->_config['btnActiveColor'],
        ]);

        //start: MurodovMirbosit 08.10.2020
        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{change}' => $this->eventCode('change'),
        ]);
        //end

    }
}
