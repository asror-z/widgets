<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZDropDownWidget;
use zetsoft\widgets\inputes\ZHRadioButtonGroupWidget;

class ZLogisticsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'buttons' => [
            'orderDoc',
            'banderol',
            'no-complect',
            'status',
        ]
    ];
    public $event = [];
    public $_event = [

    ];


    public $layout = [];
    public $_layout = [


    ];

    public function codes()
    {

        $buttons = [

            'banderol' => ZBanderolWidget::widget([
                'id' => 'btn-banderol',
                'config' => [
                    'attr' => 'status_logistics',
                    'value' => 'shipment_ready',
                    'url' => ZUrl::to([
                        '/api/shop/cart/banderol',
                        'type' => 'multiBanderol',
                        'attribute' => 'status_logistics',
                        'modelClassName' => $this->model->className,
                        'value' => 'shipment_ready',
                    ]),
                    'requiredClassName' => 'ShopOrder',
                    'modelClassName' => 'ShopOrder',
                    'btnOptions' => [
                        'config' => [
                            'btn' => false,

                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Бандероль'),
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
               function() {
                //window.location.reload()
                //alert('sadas');
               }
JS
                ]
            ]),

            'no-complect' => ZPdfWidget::widget([
                'config' => [
                    'url' => ZUrl::to([
                        '/api/core/dyna/no-complect',
                        'modelClassName' => $this->model->className
                    ]),
                    'modelClassName' => $this->model->className,
                    'attr' => 'status_logistics',
                    'value' => 'notset',
                    'btnOptions' => [
                        'config' => [
                            'btn' => false,

                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Не комплект'),
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
               function () {
                //window.location.reload()                                  
               }
JS,
                ]
            ]),

            'orderDoc' => ZPdfWidget::widget([
                'config' => [

                    'url' => ZUrl::to([
                        '/core/word/actOb',
                        'type' => 'multiContract',
                    ]),
                    'modelClassName' => 'ShopOrder',

                    'btnOptions' => [
                        'config' => [
                            'btn' => false,

                            'btnType' => ZButtonWidget::btnType['link'],
                            'btnSize' => ZExportBtnWidget::btnSize['btn-mini'],
                            'btnRounded' => false,
                            'text' => Az::l('Договор заказа')
                        ]
                    ]
                ],
                'event' => [
                    'ajaxComplete' => <<<JS
                                    function () {
                                    //location.reload()
                                   }
JS
                ]
            ]),

            'status' => ZDynaDialogWidget::widget([
                'model' => $this->model,
                'config' => [
                    'content' => ZHRadioButtonGroupWidget::widget([
                        'name' => 'dialog_value',
                        'data' => [
                            'change' => Az::l('Обмен'),
                            'free' => Az::l('Бесплатный курс'),
                            'error' => Az::l('Заказ по ошибке'),
                            'cancel' => Az::l('Отказ'),
                        ],
                        'config' => [
                            'parentClass' => 'd-flex flex-wrap',
                            'class' => 'w-100',
                        ]
                    ]),
                    'text' => Az::l('Скопировать по статусу')
                ]
            ])
        ];


        $data = [];

        foreach ($this->_config['buttons'] as $button) {

             $item = new TabItem();
             $item->title = ZArrayHelper::getValue($buttons, $button);
             $data[] = $item;

        }

        echo ZDropDownWidget::widget([
            'data' => $data,
            'config' => [
                'title' => Az::l('Печать'),
                'class' => 'btn btn-mini',
                'link' => false
            ]
        ]);
/*
        $buttons = '';
        if (!empty($this->_config['buttons'])) {
            foreach ($this->_config['buttons'] as $button) {
                $buttons .= strtr($this->_layout[$button], [
                    '{button}' => $button
                ]);
            }
        }*/


    }
}
