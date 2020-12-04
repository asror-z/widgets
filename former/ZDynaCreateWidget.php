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

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\FormDb;
use zetsoft\former\dyna\DynaFilterForm;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\dyna\DynaFilter;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalShahzod;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZModalWidgetShahzod;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZDynaCreateWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'url' => '',
        'path' => '',
        'icon' => 'fas fa-user',
        'isPjax' => false,
        'theme' => 'success',
        'type' => ZDynaCreateWidget::type['create'],
    ];


    public const type = [
        'create' => 'create',
        'update' => 'update',
        'view' => 'view',
        'detail' => 'detail',
    ];


    public $layout = [];
    public $_layout = [

        'click' => <<<JS
        function(event) {
        
            var modelId = $(this).closest('.tr-dynawidget').data('key');
                
            var url = '{url}?id=' + modelId;
            if ({create}) {
                url = '{url}';
            }
                
            
            $.ajax({
                url: url,
                success: function(response) {
                    $('#{modelName}-body-modal').html(response)
                    $('#{modelName}-modal').modal('show')
                }
            });
         
            
        }
JS,


        'js' => <<<JS

        
            
JS,


    ];


    private function getTitle($attribute)
    {

        $model = $this->model;

        return $model->columns[$attribute]->title;

    }

    public function codes()
    {

        $url = $this->_config['url'];
        
        $isCreate = $this->jscode(false);
        if ($this->_config['type'] === 'create')
            $isCreate = $this->jscode(true);



        $click = strtr($this->_layout['click'], [
            '{modelName}' => $this->modelClassName,
            '{url}' => $url,
            '{create}' => $isCreate,
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
                        'icon' => 'fa fa-' . FA::_EDIT,
                        'confirm' => 'Are you sure you want DELETE columns?'
                    ],
                    'event' => [
                        'click' => $click
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
                        'icon' => 'fa fa-' . FA::_EYE,
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
                        'icon' => 'fa fa-' . FA::_INFO_CIRCLE,
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


        $title = $this->_config['title'] . ' ' . $this->modelClassName;
        
        ZModalWidgetRavshan::begin([
            'id' => $this->id,
            'config' => [
                'width' => ZModalWidgetRavshan::width['12x'],
                'title' => $title,
                'size' => ZModalWidgetRavshan::size['xl'],
                'isFooter' => false,
                'isBtn' => false,
                'icon' => $this->_config['icon'],
            ]
        ]);

        ZModalWidgetRavshan::end();


        $this->htm = $button;

    }

}
