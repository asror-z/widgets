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

use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZStatisticsBtnWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'theme' => ZDynaWidget::theme['panel-default'],
        'btnClass' => '',
    ];

    public $layout = [];
    public $_layout = [
        'js' => <<<JS

            function () {
            
            
                 $(document).on('click', '#sweet-dyna-btn', function() {
                    window.location.reload()
                 })

                $(document).on("click", '#del-dyna-btn', function () {
                    $.ajax({
                        url: '/core/dynagrid/delete.aspx',
                        method: "GET",
                        data: {
                            modelName: '{modelName}',
                            dynaId: '{dynaId}'
                        },
                        success: function(data) {
                        
                            window.location.reload();
                            /*Swal.fire({
                                title: '{confirmTitle}',
                                text: '{confirmText}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '{btnTitle}',
                                cancelButtonText: '{cancelTitle}',
                            }).then((result) => {
                                  if (result.value) {
                                  } else {
                                    Swal.close()
                                  }
                            })*/
                            
                        }
    
                    })
                })
            }

JS,


    ];


    public function codes()
    {

        $service = Az::$app->smart->dyna;

        $dynaId = Az::$app->forms->dynas->dynaId($this->modelClassName);

        $theme = $this->_config['theme'];
        $theme = str_replace('panel-', '', $theme);



        echo ZSweetAlert2Widget::widget([

            'config' => [
                'grapes' => false,
                'funcName' => 'dynaStatistics',
                'width' => '1200px',
                'height' => '800px',
                'title' => Az::l('Статистика'),
                'allowOutsideClick' => false,
                'showCloseButton' => true,
                //'footer' => $footer,
                'url' => ZUrl::to([
                    '/core/dynagrid/statistics',
                    'dynaId' => $dynaId,
                    'url' => $this->urlParamStr,
                    'modelName' => $this->modelClassName,
                    'theme' => $this->_config['theme']
                ]),
                'padding' => '0',
            ],
            'event' => [
                'onOpen' => strtr($this->_layout['js'], [
                    '{modelName}' => $this->modelClassName,
                    '{dynaId}' => $dynaId,
                    '{cancelTitle}' => Az::l('Отмена'),
                    '{btnTitle}' => Az::l('Удалить'),
                    '{confirmTitle}' => Az::l('Подтверждение удаления'),
                    '{confirmText}' => Az::l("Вы хотите удалить настройки таблицы $this->modelClassName"),
                ]),

            ],
        ]);


        $this->htm = ZButtonWidget::widget([
            'config' => [
                //'title' => Az::l('Сохранить все изменения'),
                'hasIcon' => true,
                'isPjax' => true,
                'icon' => 'fal fa-chart-pie',
                'class' => $theme . ' ' . $this->_config['btnClass'],
                'btnRounded' => false,
                'pjax' => 0,
                'title' => Az::l('Статистика'),
                'toggle' => ZButtonWidget::toggle['tooltip'],

                //'btnStyle' => ZButtonWidget::btnStyle['btn-outline-' . $theme],
            ],
            'event' => [
                'click' => <<<JS
        function() {
           dynaStatistics();
        }
JS,
            ]
        ]);

    }


}





