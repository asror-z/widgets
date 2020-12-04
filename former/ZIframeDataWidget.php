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

use zetsoft\models\shop\ShopOrder;
use zetsoft\service\menu\Json;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;

class ZIframeDataWidget extends ZWidget
{

    public const type = [
        'create' => 'create',
        'choose' => 'choose',
        'other' => 'other',
        'view' => 'view',
        'update' => 'update',
        'detail' => 'detail',
        'return' => 'return',
    ];

    public const sizeIframe = [
        'xs' => 'xs-iframe',
        'sm' => 'sm-iframe',
        'md' => 'md-iframe',
        'lg' => 'lg-iframe',
        'xl' => 'xl-iframe',
    ];

    public $columns;
    public $config = [];
    public $_config = [
        'theme' => ZDynaWidget::theme['panel-success'],
        'modalId' => 'dynaModal',
        'url' => '',
        'hasIcon' => false,
        'grapes' => false,
        'width' => '1400px',
        'height' => '800px',
        'type' => ZIframeSpaWidget::type['create'],
        'isSession' => false,
        'options' => [],
        'formId' => '',
        'chooseQuery' => null,
        'key' => '',
        'title' => '',
        'defaultTitle' => '',
        'btnText' => '',
        'urlParam' => false,
        'btnClass' => '',
        'isNewRecord' => false,
        'newRecordValues' => [],
        'funcName' => 'dynaSweet',
        'buttonId' => '',
        'src' => '',
        'img' => '',
        'btnOptions' => [],
        'data' => [],
        'size' => ZIframeSpaWidget::sizeIframe['xl'],
        'getParams' => [],
        'changeSave' => 0,
    ];


    public $layout = [];
    public $_layout = [

        'form' => <<<HMTL

    <form action="{action}" id="form-data-panel-{id}" method="post" target="form-panel-{id}">
       <input type="hidden" id="modelClassName-data-{modelClassName}" name="modelClassName" value='{modelClassName}'> 
       {inputes}
    </form>

HMTL,

        'inputes' => <<<HTML
       <input type="hidden" id="{key}-data-{modelClassName}" name="{key}" value='{value}'>
HTML,


        'click' => <<<JS

    function () {
        window.{funcName}()
    }
    
JS,

        'emptyUrl' => '{url}?spa={spa}',

        'url' => '{url}&spa={spa}',

        'css' => <<<CSS
    .swal2-container {
        z-index: 999999!important;
    }
CSS,


    ];

    public function codes()
    {

        $strtr = [
            '{spa}' => 1,
        ];

        $url = strtr($this->_layout['emptyUrl'], $strtr);
        if (ZStringHelper::find($this->_config['url'], '?')) {
            $url = strtr($this->_layout['url'], $strtr);
        }

        echo ZJspanelWidgetRavshan::widget([
            'model' => $this->model,
            'id' => 'jsPanel-data-' . $this->id,
            'config' => [
                'title' => $this->_config['title'],
                'iframeSrc' => $url,
                'iframeId' => $this->_config['funcName'],
                'funcName' => $this->_config['funcName'],
                'iframeName' => 'form-panel-' . $this->id,
            ],

        ]);

        $click = strtr($this->_layout['click'], [
            '{funcName}' => $this->jscode($this->_config['funcName']),
            '{modelName}' => $this->modelClassName,
            '{id}' => $this->id,
        ]);

        $btnOptions = ZArrayHelper::merge($this->_config['btnOptions'], [
            'event' => [
                'click' => $click
            ]
        ]);

        $inputes = '';
        foreach ($this->_config['data'] as $key => $item) {

            $value = $this->processValue($item);

            if (empty($value))
                continue;

            $inputes .= strtr($this->_layout['inputes'], [
                '{key}' => $key,
                '{value}' => $value,
                '{modelClassName}' => $this->modelClassName,
            ]);
        }

        $this->htm = ZButtonWidget::widget($btnOptions);

        $this->htm .= strtr($this->_layout['form'], [
            '{modelClassName}' => $this->modelClassName,
            '{id}' => $this->id,
            '{action}' => $this->_config['url'],
            '{inputes}' => $inputes,
        ]);

        $this->css = strtr($this->_layout['css'], []);
        
    }


    private function processValue($item) {

        if (empty($item))
            return null;

        $return = $item;
        if (is_array($item))
            $return = \yii\helpers\Json::encode($item);

        return $return;

    }

}
