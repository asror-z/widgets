<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Refactored By: Elnur Suyunov
 *
 * Date:    21.05.2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;


use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\consts\ZButtonConst;

/**
 * ZRadioButtonGroup
 * @package widgets\inputes
 * https://getbootstrap.com/docs/4.3/components/button-group/
 */
class ZRadioButtonGroup extends ZWidget
{

    public $config = [];
    public $_config = [
        'role' => 'group',
        'color' => self::type['btn-primary'],

        'data' => [
            '1111',
            '2222',
            '3333',
            '4444'
        ],

    ];

    public const type = [
        'btn-primary' => 'btn-primary',
        'btn-success' => 'btn-success',
        'btn-warning' => 'btn-warning',
    ];
    public $layout=[];
    public $_layout=[
        'main' => <<<HTML
        <div class="form-control clear-control mb-5 d-flex" ' >
                    
                 <div style="width: 100%;">
                     {content}
                  &ensp; <span>{getIcon}</span> &ensp;
                    <span>{placeholder}</span>
</div>
</div>

HTML,
        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon}"></i>
HTML,

        'css' => <<<CSS
        .clear-control{
            padding: 0 !important; 
            border: 0;
        }
CSS,

    ];

    public function codes()
    {

        $this->options = [
            'role' => $this->_config['role'],
            'options' => [
                'value' => $this->value,
            ],
            'value' => $this->value,
            'itemOptions' => [
                'labelOptions' => [
                    'class' => 'btn ' . $this->_config['color'].' '.$this->_config['class'],

                ]
            ],
        ];



        $getIcon = '';
        if ($this->_config['hasIcon']) {
            $getIcon = $this->htm .= strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon'],
            ]);
        } 


        if (empty($this->model)) {
            $content = ZHTML::radioButtonGroup(
                $this->name,
                $this->data,
                $this->options,
                $this->value
            );
        } else {
            $content = ZHTML::activeRadioButtonGroup(
                $this->model,
                $this->attribute,
                $this->data,
                $this->options
                
            );
        }

        $this->htm = strtr($this->_layout['main'], [
            '{placeholder}' => $this->_config['hasPlace'] ? $this->_config['placeholder'] : '',
            '{content}' => $content,
            '{modelClass}' => $this->modelClassName,
            '{id}' => $this->id,
            '{attribute}' => $this->attribute,
            
            //'{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
            '{getIcon}' => $getIcon

        ]);

        $this->css = strtr($this->_layout['css'],[
            '{color}' => $this->_config['color']
        ]);
        


    }


}
