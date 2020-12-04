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
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZSettingBtnWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'theme' => ZDynaWidgetRav::theme['panel-default'],
        'btnClass' => '',
    ];

    public $layout = [];
    public $_layout = [
        'js' => <<<JS
            
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
                }

            })
        })

JS,


        'footer' => <<<HTML
        <button id="del-dyna-btn" data-toggle="tooltip" class="default btn  ovr-button    btn-danger  hint--top hint--default hint--medium hint--bounce hint--rounded btn btn-danger dynagrid-submit"> Удалить </button>
        
        <button id="sweet-dyna-btn" data-toggle="tooltip" class="default btn  ovr-button    btn-primary  hint--top hint--default hint--medium hint--bounce hint--rounded btn btn-primary dynagrid-submit"> Применить </button>
HTML,

    'css' => <<<CSS
        .jsPanel-title {
            margin: 10px!important;
            font-size: 30px!important;
        }

CSS,


        'formSubmit' => <<<HTML
    <form action="{action}" id="form-settings-{modelName}" method="post" target="form-settings">
       <input type="hidden" id="editable-configs-{modelName}" name="configs" value='{configs}'>
       <input type="hidden" id="editable-columns-{modelName}" name="columns" value='{columns}'>
       <input type="hidden" id="editable-cards-{modelName}" name="cards" value='{cards}'>
       <input type="hidden" id="editable-modelName-{modelName}" name="modelName" value='{modelName}'>
    </form>
HTML,




    ];


    public function codes()
    {
    

        $service = Az::$app->smart->dyna;

        $dynaId = Az::$app->forms->dynas->dynaId($this->modelClassName);

        $theme = $this->_config['theme'];
        $theme = str_replace('panel-', '', $theme);

        $footer = strtr($this->_layout['footer'], [

        ]);

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-settings',
            'config' => [
                'width' => '85%',
                'height' => '95%',
                'footer' => $footer,
                'title' => Az::l('Настройки DynaGrid'),
                'iframeSrc' => ZUrl::to([
                     '/core/dynagrid/content',
                     'dynaId' => $dynaId,
                     'url' => $this->urlArrayStr,
                     'model' => $this->modelClassName,
                     'theme' => $this->_config['theme'],
                ]),
                'iframeName' => 'form-settings',
                'funcName' => 'dynaSettings',
            ],
        ]);

        $this->htm = ZButtonWidget::widget([
            'config' => [
                //'title' => Az::l('Сохранить все изменения'),
                'hasIcon' => true,
                'isPjax' => true,
                'icon' => 'fal fa-cog',
                'class' => $theme . ' res-item ' . $this->_config['btnClass'],
                'btnRounded' => false,
                'pjax' => 0,
                'title' => Az::l('Настройка'),
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'btnType' => ZButtonWidget::btnType['button'],
                //'btnStyle' => ZButtonWidget::btnStyle['btn-outline-' . $theme],
            ],
            'event' => [
                'click' => <<<JS
        function() {
           window.dynaSettings();
           $('#form-settings-{$this->modelClassName}').submit()
        }
JS,
            ]
        ]);

        $this->htm .= strtr($this->_layout['formSubmit'], [
            '{modelName}' => $this->modelClassName,
            '{configs}' => json_encode($this->model->configs),
            '{action}' => ZUrl::to([
                '/core/dynagrid/content',
                'dynaId' => $dynaId,
                'url' => $this->urlArrayStr,
                'model' => $this->modelClassName,
                'theme' => $this->_config['theme'],
            ]),
            '{columns}' => json_encode($this->model->columns),
            '{cards}' => json_encode($this->model->cards),
        ]);

        $this->css = strtr($this->_layout['css'], []);
        $this->js = strtr($this->_layout['js'], [
            '{dynaId}' => $dynaId,
            '{modelName}' => $this->modelClassName,
        ]);

    }


}





