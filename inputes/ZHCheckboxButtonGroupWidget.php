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

use zetsoft\system\assets\ZColor;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use yii\bootstrap4\BootstrapPluginAsset;

/**
 * Class ZHСheckboxButtonGroupWidget
 * @package widgets/inputes
 * https://getbootstrap.com/docs/4.3/components/button-group
 *  Refactory:Ergashev Zoxidjon
 */
class ZHCheckboxButtonGroupWidget extends ZWidget
{


    /**
     *
     * todo:   https://mdbootstrap.com/snippets/jquery/mdbootstrap/820820
     * todo:   https://mdbootstrap.com/snippets/jquery/mdbootstrap/820820
     * todo:   https://mdbootstrap.com/snippets/jquery/mdbootstrap/820820
     */

    /*public $data = [
      'Item1',
      'Item1',
      'Item1',
      'Item1',
      'Item1',
    ];*/

    public $config = [];
    public $_config = [
        'btnStyle' => ZHCheckboxButtonGroupWidget::btnStyle['btn-primary'],
        'classActive' => 'CheckboxBtnGroupActive',
        'color' => 'default', //active BgColor default none

    ];

    public $branch = [];
    public $_branch = [
        'widget' => [
            'btnStyle',
            'classActive',
            'color',
        ],
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => 'fa fa-save',
        'image' => '/render/inputes/ZHCheckboxButtonGroupWidget/image/icon.png',
        'name' => Azl . 'CheckboxButtonGroup',
        'title' => Azl . '<b>safasfsa</b>',

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <div class="form-control border-0 d-flex CheckBoxBGroupHeight" >
                       {getIcon} &ensp;&ensp;
                     <div>
                        {radio}
                     </div> 
                        {place}
                </div>
HTML,
        'icon' => <<<HTML
        <i class="icon-prefix prefix fa-2x {icon}"></i>
HTML,
        'place' => <<<HTML
        <div class="ml-3 mt-2">{placeholder}</div>
HTML,
        'css' => <<<CSS
      .CheckBoxBGroupHeight{
        height: auto;
      }
      .white-skin .CheckboxBtnGroupActive:not([disabled]):not(.disabled).active{
        background-color: #0b51c5!important;
      }
CSS,
        'js' => <<<JS
         const valueOfChechbox = document.getElementsByName('CoreInput[jsonb_4][]');
         var btnSuccess = document.getElementsByClassName('btn-success');
         $('.btn-success').on('click', function (event) {
               console.log(valueOfChechbox)
         })
         
JS,
    ];

    public function codes()
    {
        $this->options = [
            'role' => 'group',
            'options' => [
                'id' => $this->id,

            ],
            'value' => $this->value,
            'itemOptions' => [
                'labelOptions' => [
                    'class' => 'btn ' . $this->_config['classActive'] . ' ' . $this->_config['class'] . ' ' . $this->_config['btnStyle'],
                ]
            ]
        ];
        if (empty($this->model)) {
            $radio = ZHTML::checkboxButtonGroup(
                $this->name,
                $this->data,
                $this->options
            );
        } else {
            $radio = ZHTML::activeCheckboxButtonGroup(
                $this->model,
                $this->attribute,
                $this->data,
                $this->options
            );
        }

        $getIcon = strtr($this->_layout['icon'], [
            '{icon}' => $this->_config['icon'],
        ]);
        $getPlace = strtr($this->_layout['place'], [
            '{placeholder}' => $this->_config['placeholder'],
        ]);

        $this->htm = strtr($this->_layout['main'], [
            '{radio}' => $radio,
            '{getIcon}' => $this->_config['hasIcon'] ? $getIcon : '',
            '{place}' => $this->_config['hasPlace'] ? $getPlace : '',
        ]);

        $this->css = strtr($this->_layout['css'], [
            "{color}" => $this->_config['color']
        ]);

        $this->js = strtr($this->_layout['js'], [

        ]);
    }
}
