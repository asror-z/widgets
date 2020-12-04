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


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZWidget;


/**
 * Class ZHTextareaWidget
 * @package widgets\inputes
 * https://www.yiiframework.com/doc/api/2.0/yii-helpers-basehtml#textarea()-detail
 * https://www.w3schools.com/bootstrap4/bootstrap_forms_inputs.asp
 */
class ZHTextareaWidget extends ZWidget
{


    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'rows' => 1,
        'type' => ZHTextareaWidget::type['text'],

        /*'placeholder' => '{placeholder}'*/
    ];


    public const type = [
        'button' => 'button',
        'checkbox' => 'checkbox',
        'color' => 'color',
        'date' => 'date',
        'datetime-local' => 'datetime-local',
        'email' => 'email',
        'file' => 'file',
        'hidden' => 'hidden',
        'image' => 'image',
        'month' => 'month',
        'number' => 'number',
        'password' => 'password',
        'radio' => 'radio',
        'range' => 'range',
        'reset' => 'reset',
        'search' => 'search',
        'submit' => 'submit',
        'tel' => 'tel',
        'text' => 'text',
        'time' => 'time',
        'url' => 'url',
        'week' => 'week'
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <div class="md-form m-0" id="{inputId}">
                       {icon}{text}
                </div>         
HTML,

        'icon' => <<<HTML
          <i class="icon-prefix prefix {icon} mt-3"></i>
HTML,




    ];


    public function codes()
    {

        $iconCode = '';
        if ($this->_config['hasIcon']) {
            $iconCode = strtr($this->_layout['icon'], [
                '{icon}' => $this->_config['icon']
            ]);
        }

        $getPlace = '';
        if ($this->_config['hasPlace']) {
            $getPlace = $this->_config['placeholder'];

        }


        $this->options = [
            'class' => 'md-textarea form-control' . '' . $this->_config['class'],
            'rows' => $this->_config['rows'],
            'id' => $this->id,
            'value' => $this->value,
            'placeholder' => $getPlace,
            'disabled' => $this->_config['readonly'],

        ];


        if (empty($this->model))
            $text = ZHTML::textarea(
                $this->name,
                $this->value,
                $this->options
            );

        else
            $text = ZHTML::activeTextarea(
                $this->model,
                $this->attribute,
                $this->options
            );


        $this->htm = strtr($this->_layout['main'], [
            '{icon}' => $iconCode,
            '{text}' => $text,
            '{place}' => $getPlace,
            '{inputId}' => $this->id . '_div',
        ]);

    }


}
