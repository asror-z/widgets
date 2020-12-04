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
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalShahzod;
use zetsoft\widgets\notifier\ZModalWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZModalWidgetShahzod;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZDynaRelationWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'title' => '',
        'isBtn' => false,
        'hasMany' => []
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
        
            $('#{id}-modal').modal('show')
            
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
        $model = $this->model;

        $returns = '';

        foreach ($this->_config['hasMany'] as $className => $relation) {

            $relatedTable = ZArrayHelper::getValue(array_keys($relation), 0);

            $relatedColumn = ZArrayHelper::getValue(array_values($relation), 0);

            $url = $className . '[' . $relatedTable . ']';

            $url = ['/cruds/' . ZInflector::dash($className) . '/index', $url => $model->{$relatedColumn}];

            //  vdd($url);

            $class = $this->bootFull($className);

            if (!class_exists($class))
                continue;

            /** @var Models $item */

            $item = new $class();

            $title = $item->configs->title;


            /**
             *
             * Icon
             */


            $icon = Az::$app->utility->mains->icon();

            $returns .= ZButtonWidget::widget([
                'config' => [
                    'btnSize' => ZColor::btnSize['btn-manual'],
                    'text' => $title,
                    'url' => ZUrl::to($url),
                    'icon' => $icon . ' mr-2 fp-20',
                    'pjax' => 0,
                    'btnRounded' => false,
                    'class' => 'ZDynaBTN w-25 mb-2',
                    'btn' => true,
                    'target' => ZButtonWidget::target['_self'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'blank' => true,
                    'hasIcon' => true,

                ],
                'event' => [
                    'click' => 'function (event){e.preventDefault()}'
                ]

            ]);

        }


        ZSweetAlert2Widget::begin([
            'id' => $this->id,
            'config' => [
                'begin' => true,
                'funcName' => 'relation',
                /*'width' => ZModalWidgetRavshan::width['10x'],
                'title' => $title,

                'isFooter' => false,
                'isBtn' => false,
                'icon' => $this->_config['icon'],
                'modalBodyClass' => 'd-flex flex-wrap',*/
            ]
        ]);


        echo $returns;

        ZSweetAlert2Widget::end();
        /*
                $click = strtr($this->_layout['click'], [
                    //'{id}' => $this->id

                ]);*/


        $this->htm = ZButtonWidget::widget([

            'config' => [
                'class' => 'rv-editable-link kv-editable-value',
                'hasIcon' => true,
                'icon' => 'fal fa-link mr-2 fa-lg',
                'grapes' => false,
                'content' => $returns,
                'titleHeader' => $this->_config['title'],
                'buttonIcon' => 'fal fa-' . FA::_COMMENT_ALT,
                'isBtn' => $this->_config['isBtn'],
                'width' => '1000px',
                'btn' => false,
                'btnType' => ZButtonWidget::btnType['link'],
                'btnRounded' => false,
                'btnFloating' => false,
            ],
            'event' => [
                'click' => 'relation'
            ]
        ]);


    }

}
