<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZIframeWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'theme' => ZDynaWidget::theme['panel-success'],
        'modalId' => 'dynaModal',
        'url' => '/core/edit/editable.aspx',
        'width' => '1400px',
        'height' => '800px',
        'type' => ZIframeSpaWidget::type['create'],
        'isSession' => false,
        'options' => [],
        'formId' => '',
        'chooseQuery' => null,
        'key' => '',
    ];


    public const type = [
        'create' => 'create',
        'choose' => 'choose',
        'view' => 'view',
        'update' => 'update',
        'detail' => 'detail',
    ];

    public $layout = [];
    public $_layout = [


        'editable' => <<<HTML
<span style="width:100%; cursor:pointer;color: royalblue!important;" id="editable-{id}" class="modal-trigger-button">
  {value}
</span>
HTML,

        'click' => <<<JS

    function () {
    
        
        dynaSweet()
    
        $('#swal2-title').html('{title}')
    
        var iframe = $('#dynaIframe')
        
        iframe.attr('src', '{url}');
        iframe.attr('width', '{width}');
        iframe.attr('height', '{height}');
    
        iframe.on('load', function() {
            
        })
        
    }
    
JS,


    ];

    public function codes()
    {

        $chooseQuery = null;
        if (!empty($this->_config['chooseQuery']))
            $chooseQuery = $this->_config['chooseQuery'];


        $parentQuery = null;
        if (!empty($this->_config['parentQuery']))
            $parentQuery = $this->_config['parentQuery'];

        $click = strtr($this->_layout['click'], [
            '{url}' => ZUrl::to([
                $this->_config['type'],
                'id' => $this->_config['key'],
                'spa' => 1,
                'formId' => $this->_config['formId'],
                'chooseQuery' => $chooseQuery,
                'parentQuery' => $parentQuery,
            ]),
            '{formId}' => $this->_config['formId'],
            '{modelName}' => $this->modelClassName,
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{title}' => $this->_config['title'],
        ]);


        switch ($this->_config['type']) {

            case 'update':

                $button = ZButtonWidget::widget([
                    'config' => [
                        'btnSize' => ZColor::btnSize['btn-lg'],
                        'class' => 'ZDynaBTN p-1',
                        'title' => Az::l('Изменить'),
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => $this->_config['icon'],
                        'confirm' => 'Are you sure you want DELETE columns?'
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;

            case 'view':


                $button = ZButtonWidget::widget([
                    'config' => [
                        'btnSize' => ZButtonWidget::btnSize['btn-lg'],
                        'class' => 'ZDynaBTN p-1',
                        'title' => Az::l('Просмотр'),
                        //'url' => $url,
                        'hasIcon' => true,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => $this->_config['icon'],
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;


            case 'choose':
            
                $button = ZButtonWidget::widget([
                    'config' => [
                        //'url' => $createUrl,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnSize' => ZColor::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,

                        'title' => Az::l('Подобрать'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],

                        'hasIcon' => true,
                        'icon' => 'fal fa-list-ul',
                        'class' => 'btn-outline-dark text-dark',
                        'ic-push-url' => true,
                    ],
                    'event' => [
                        'click' => $click,

                    ]

                ]);

                break;


            case 'detail':


                $button = ZButtonWidget::widget([
                    'config' => [
                        //'url' => $url,
                        'btnSize' => ZColor::btnSize['btn-lg'],
                        'title' => Az::l('Show Details'),
                        'hasIcon' => true,
                        'class' => 'ZDynaBTN p-1',
                        'icon' => $this->_config['icon'],
                        'btn' => false,
                        'hasConfirm' => false,
                        'btnRounded' => false,
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;

            default:

                $button = ZButtonWidget::widget([
                    'config' => [
                        //'url' => $createUrl,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnSize' => ZColor::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,

                        'title' => Az::l('Добавить'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],

                        'hasIcon' => true,
                        'icon' => 'fas fa-plus',
                        'class' => 'btn-outline-success text-success',
                        'ic-push-url' => true,
                    ],
                    'event' => [
                        'click' => $click,

                    ]

                ]);

                break;

        }

        $this->htm = $button;
    }

}
