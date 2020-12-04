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
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZModalWidgetShahzod;
use zetsoft\widgets\notifier\ZSweetAlert2Widget;
use zetsoft\widgets\notifier\ZSweetAlertWidget;

class ZDynaFilterWidget extends ZWidget
{

    public $columns;

    public $config = [];
    public $_config = [
        'btnClass' => '',
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

<div class="hint-block mb-4">{content}</em></div>

HTML,

        'filterData' => <<<HTML

     <input type="hidden" name="DynaFilterForm[type]" value="filter">
     <input type="hidden" name="DynaFilterForm[dynaId]" value="{dynaId}">
     <input type="hidden" name="DynaFilterForm[model]" value="{modelName}">
     <input type="hidden" name="DynaFilterForm[url]" value="{url}">

HTML,

        'item' => <<<HTML
     <li>{name} = {value}</li> 
HTML,


        'click' => <<<JS

    function(event) {
        $('#{id}-modal').modal('show')      
    }

JS,


        'js' => <<<JS
          
    function URLToArray(url) {
        var request = {};
        var arr = [];
        var pairs = url.substring(url.indexOf('?') + 1).split('&');
        for (var i = 0; i < pairs.length; i++) {
          var pair = pairs[i].split('=');
        
          //check we have an array here - add array numeric indexes so the key elem[] is not identical.
          if(endsWith(decodeURIComponent(pair[0]), '[]') ) {
              var arrName = decodeURIComponent(pair[0]).substring(0, decodeURIComponent(pair[0]).length - 2);
              if(!(arrName in arr)) {
                  arr.push(arrName);
                  arr[arrName] = [];
              }
        
              arr[arrName].push(decodeURIComponent(pair[1]));
              request[arrName] = arr[arrName];
          } else {
            request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
          }
        }
        return request;
    }
    
    function endsWith(str, suffix) {
        return str.indexOf(suffix, str.length - suffix.length) !== -1;
    }      
          
    $(document).on('click', '#filter-submit', function (event) {
   
        if ($('#dynafilterform-name').val() === '') {
            event.preventDefault();
            return null;
        }
   
        $('#{id}-modal').loader('show');
        
        $.ajax({
            method: 'POST',
            url: '{url}?' + $('#filter-form-dynagrid').serialize(),
            data: URLToArray(window.location.href),
            success: function(response) {
               $('#{id}-modal').loader('hide');
            }
        });
    
    })
    
    $(document).on('change','.radioButton-filter', function() {
        $('#dynafilterform-name').val($(this).text());
    });
    
   $(document).on('click', '#filter-reset', function (event) {
   
         $.ajax({
            method: 'GET',
            url: '/core/dynagrid/resetFilter.aspx',
            data: {
                dynaId: '{dynaId}',
                type: 'filter',
                name: $('#dynafilterform-name').val(),
                pageUrl: '{pageUrl}',
            }
        });         
    }) 


JS,


    ];


    private function getTitle($attribute)
    {

        $model = $this->model;

        return $model->columns[$attribute]->title;

    }

    public function codes()
    {

        $service = Az::$app->smart->dyna;

        $click = strtr($this->_layout['click'], [
            '{id}' => $this->id
        ]);

        $dynaId = Az::$app->forms->dynas->dynaId($this->modelClassName);

        $filterData = strtr($this->_layout['filterData'], [
            '{dynaId}' => $dynaId,
            '{modelName}' => $this->modelClassName,
            '{url}' => $this->urlParamStr . '.aspx',
        ]);

        $content = strtr($this->_layout['main'], [
            '{content}' => <<<TEXT
Установите имя, чтобы сохранить состояние вашего текущего фильтра сетки. Вы также можете выбрать сохраненный фильтр из списка ниже для редактирования или удаления. <em> ПРИМЕЧАНИЕ. При редактировании существующей записи имя фильтра и его настройки будут изменены.
TEXT,

        ]);


        ZModalWidgetRavshan::begin([
            'id' => $this->id,
            'config' => [
                'width' => ZModalWidgetRavshan::width['5x'],
                'isBtn' => false,
                'title' => Az::l('Настройки фильтра DynaGrid'),
                'submitId' => 'filter-submit',
                'resetId' => 'filter-reset',
                'submitText' => 'Сохранить',
                'resetText' => 'Удалить',
            ]
        ]);

        $active = new Ajaxer();
        $active->id = 'filter-form-dynagrid';

        $model = new DynaFilterForm();
        $form = $this->activeBegin($active);


        $data = [];
        $params = [];

        $filters = DynaFilter::find()
            ->where([
                'dynaId' => $dynaId,
                'type' => 'filter'
            ])
            ->all();

        if (!empty($filters))
            foreach ($filters as $filter) {
                $params[$filter->name] = $filter->data;
                $data[$filter->name] = $filter->name;
            }

        $model->configs->nameOn = ['name'];
        $model->configs->options = [
            'filters' => [
                'id' => $this->id,
                'data' => $data,
                'config' => [
                    'class' => 'radioButton-filter',
                ],
                'event' => [
                    'checked' => <<<JS
                            $('#dynafilterform-name').val($(this).val());
JS,

                ]
            ]
        ];
        $model->columns();
        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);

        echo $content;

        $model->configs->nameOn = ['filters'];
        $model->columns();
        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],
        ]);

        echo $filterData;

        $this->activeEnd();

        ZModalWidgetRavshan::end();

        $this->htm = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['button'],
                'btnSize' => ZColor::btnSize['default'],
                'btnRounded' => false,
                'btnFloating' => false,
                'title' => 'Фильтр',
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => true,
                'isPjax' => true,
                'icon' => 'fal fa-filter',
                'class' => $this->_config['btnClass'],
            ],
            'event' => [
                'click' => $click
            ]

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{params}' => json_encode($this->httpGet()),
            '{url}' => ZUrl::to(['/api/core/dyna/filter']),
            '{id}' => $this->id,
            '{dynaId}' => $dynaId,
            '{pageUrl}' => $this->urlParamStr . '.aspx',
        ]);

    }
}
