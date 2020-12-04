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
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZIframeSpaWidget extends ZWidget
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
        'width' => '800px',
        'height' => '500px',
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
        'size' => ZIframeSpaWidget::sizeIframe['xl'],
        'getParams' => [],
        'changeSave' => 0,
    ];


    public $layout = [];
    public $_layout = [


        'click' => <<<JS

    function () {
      
        {funcName}()
    
        $('#swal2-title').html('{title}')
    
        var iframe = $('#dynaIframe')
        
        iframe.attr('src', '{url}');
        iframe.attr('width', '{width}');
        iframe.attr('height', '{height}');
        //iframe.addClass('{class}');
        
    }
    
JS,


        'isNewClick' => <<<JS
    
        function() {
          
            $.ajax({
                url: '{newUrl}',
                success: function() {
                    console.log('{modelClassName}')
                    $('#{modelClassName}_Grid_Reset').click()
                }
            })
            
        }
    
JS,
        'css' => <<<CSS
        .xs-iframe{
            width: 30vw;
            height: 20vh;
        }
        .sm-iframe{
            width: 45vw;
            height: 30vh;
        }
        .md-iframe{
            width: 60vw;
            height: 50vh;
        }
        .lg-iframe{
            width: 70vw;
            height: 65vh;
        }
        .xl-iframe{
            width: 90vw;
            height: 80vh;
        }
CSS,

        'emptyUrl' => '{url}?id={key}&spa={spa}&formId={formId}&chooseQuery={chooseQuery}&parentQuery={parentQuery}&changeSave={changeSave}',

        'url' => '{url}&id={key}&spa={spa}&formId={formId}&chooseQuery={chooseQuery}&parentQuery={parentQuery}&changeSave={changeSave}',

    ];

    public function codes()
    {

        $chooseQuery = null;
        if (!empty($this->_config['chooseQuery']))
            $chooseQuery = $this->_config['chooseQuery'];

        $parentQuery = null;
        if (!empty($this->_config['parentQuery']))
            $parentQuery = $this->_config['parentQuery'];

        $changeSave = 0;
        if ($this->_config['changeSave'])
            $changeSave = 1;

        $strtr = [
            '{url}' => $this->_config['url'],
            '{key}' => $this->_config['key'],
            '{spa}' => 1,
            '{formId}' => $this->_config['formId'],
            '{changeSave}' => $changeSave,
      /*      '{chooseQuery}' => json_encode($chooseQuery),
            '{parentQuery}' => json_encode($parentQuery),*/
        ];

        $url = strtr($this->_layout['emptyUrl'], $strtr);
        if (ZStringHelper::find($this->_config['url'], '?')) {
            $url = strtr($this->_layout['url'], $strtr);
        }

        $title = Az::l("Создание {$this->_config['defaultTitle']}");
        if (!empty($this->_config['title']))
            $title = $this->_config['title'];

        $click = strtr($this->_layout['click'], [
            '{url}' => $url,
            '{funcName}' => $this->jscode($this->_config['funcName']),
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{formId}' => $this->_config['formId'],
            '{modelName}' => $this->modelClassName,
            '{class}' => $this->_config['size'],
            '{title}' => $title,
        ]);


        if ($this->_config['isNewRecord'])
            $click = strtr($this->_layout['isNewClick'], [
                '{modelClassName}' => $this->modelClassName,
                '{newUrl}' => ZUrl::to([
                    '/api/core/dyna/record',
                    'modelClassName' => $this->modelClassName,
                    'newRecordValues' => $this->_config['newRecordValues']
                ])
            ]);

        switch ($this->_config['type']) {

            case 'update':

                $button = ZButtonWidget::widget([
                    'id' => $this->_config['buttonId'],
                    'config' => [
                        'text' => $this->_config['btnText'],
                        'btnSize' => ZColor::btnSize['btn-lg'],
                        'class' => "ZDynaBTN p-0 {$this->_config['btnClass']}",
                        'title' => Az::l('Изменить'),
                        'hasIcon' => $this->_config['hasIcon'],
                        'btnRounded' => false,
                        'btn' => false,
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                        'icon' => $this->_config['icon'],
                        'confirm' => 'Are you sure you want DELETE columns?',
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;

            case 'view':

                $button = ZButtonWidget::widget([
                    'config' => [
                        'text' => $this->_config['btnText'],
                        'btnSize' => ZButtonWidget::btnSize['btn-lg'],
                        'class' => "ZDynaBTN p-0 {$this->_config['btnClass']}",
                        'title' => Az::l('Просмотр'),
                        'btnRounded' => false,
                        'btn' => false,
                        'hasIcon' => $this->_config['hasIcon'],
                        'imgWidth' => '42px',
                        'imgHeight' => '42px',
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                        'icon' => $this->_config['icon'],
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;


            case 'other':

                $button = ZButtonWidget::widget([
                    'config' => [
                        'btn' => false,
                        'text' => $this->_config['btnText'],
                        /*'btnSize' => ZButtonWidget::btnSize['btn-lg'],*/
                        'btnType' => ZButtonWidget::btnType['link'],
                        'class' => "ZDynaBTN p-0 {$this->_config['btnClass']}",
                        'title' => Az::l('Просмотр'),
                        'btnRounded' => false,
                        'hasIcon' => $this->_config['hasIcon'],
                        'imgWidth' => '40px',
                        'imgHeight' => '40px',
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                        'icon' => $this->_config['icon'],
                    ],
                    'event' => [
                        'click' => $click,

                    ]
                ]);

                break;

            case 'return':

                $button = ZButtonWidget::widget([
                    'config' => [
                        'text' => $this->_config['btnText'],
                        //'url' => $createUrl,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'btnRounded' => false,

                        'title' => Az::l('Возврат'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],
                        'btn' => false,
                        'hasIcon' => true,
                        'icon' => 'fad fa-eye fp-25',
                        'class' => $this->_config['btnClass'],
                        'ic-push-url' => true,
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                    ],
                    'event' => [
                        'click' => $click,

                    ]

                ]);
                break;


            case 'choose':

                $button = ZButtonWidget::widget([
                    'config' => [
                        'text' => $this->_config['btnText'],
                        //'url' => $createUrl,
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnSize' => ZColor::btnSize['default'],
                        'btnRounded' => false,
                        'btnFloating' => false,

                        'title' => Az::l('Подобрать'),
                        'toggle' => ZButtonWidget::toggle['tooltip'],

                        'hasIcon' => true,
                        'icon' => 'fal fa-list-ul',
                        'class' => $this->_config['btnClass'],
                        'ic-push-url' => true,
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
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
                        'class' => "ZDynaBTN p-0 {$this->_config['btnClass']}",
                        'btn' => false,
                        'hasConfirm' => false,
                        'btnRounded' => false,
                        'imgWidth' => '40px',
                        'imgHeight' => '40px',
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                        'icon' => $this->_config['icon'],
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
                        'class' => $this->_config['btnClass'] . ' res-item',
                        'ic-push-url' => true,
                        'src' => $this->_config['src'],
                        'img' => $this->_config['img'],
                    ],
                    'event' => [
                        'click' => $click,
                    ]

                ]);

                break;

        }

        $this->htm = $button;

        $this->css = $this->_layout['css'];
    }

}
