<?php

namespace zetsoft\widgets\navigat;

use yii\bootstrap4\Button;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use kartik\widgets\Select2;
use zetsoft\system\kernels\ZWidget;
use kartik\tabs\TabsX;
use yii\web\JsExpression;

/**
 * Class ZKTabXWidget
 * @package common\blocker
 * http://demos.krajee.com/tabs-x
 */
class ZKTabXWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'items'=>'',
        'position' => self::position['left'],
        'align'=>self::align['right'],
        'height' => self::height['xl'],
        'theme' => ZKTabXWidget::themes['lightBlueTheme']
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZKTabXWidget/image/icon.png',
        'name' => Azl . 'TabX',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZKTabXWidget/image/icon.png"/>',

    ];

    public const position = [
        'above' => 'above',
        'below' => 'below',
        'right' => 'right',
        'left' => 'left'
    ];

    public const height = [
        'md' => 'md',
        'lg' => 'lg',
        'sm' => 'sm',
        'xl' => 'xl',
        'xs' => 'xs',
        'xm' => 'xm',
    ];

    public const align = [
        'center' => 'center',
        'right' => 'right',
        'left' => 'left',
    ];
    public const themes = [
        'bronzeTheme' => 'bronzeTheme',
        'blueTheme' => 'blueTheme',
        'whiteBlackTheme' => 'whiteBlackTheme',
        'blackWhiteTheme' => 'blackWhiteTheme',
        'lightBlueTheme' => 'lightBlueTheme',
    ];
    public $event = [];
    public $_event = [
         'click'=>'function (event) {console.log("tabsX:click event");}',
         'beforeSend'=>'function (event, jqXHR, settings) { console.log("tabsX:beforeSend event");}',
         'success'=>'function (event, data, status, jqXHR) { console.log("tabsX:beforeSend event");}',
         'error'=>'function (event, jqXHR, status, message) { console.log("tabsX:error event with message");}',
    ];

    public function asset()
    {
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js');
    }

    public function codes()
    {
        $this->options = [
            'items' => $this->_config['items'],
            'encodeLabels' => false,
            'containerOptions' => ['class' => 'pull-left'],
            'position' => $this->_config['position'],
            'align' => $this->_config['align'],
            'height' => $this->_config['height'],
            'bordered' => false,
            'sideways' => false,
            'fade' => true,
            'enableStickyTabs' => false,
            'options' => [
                'id' => $this->id,

                
            ],
            'stickyTabsOptions' => [
                'selectorAttribute' => 'data-target',
                'backToTop' => true
            ],
            'pluginOptions' => [
                'enableCache' => true,
                'cacheTimeout' => 300000,
                'maxTitleLength' => 9,
                'ajaxSettings' => false,
            ],
            'pluginEvents' => [
                'tabsX.click' => $this->eventCode('click'),
                'tabsX.beforeSend' => $this->eventCode('beforeSend'),
                'tabsX.success' =>new JsExpression( $this->_event['success']),
                'tabsX.error' => $this->eventCode('error'),
            ],
            'printable' => true,
            'printHeaderOptions' => ['class' => 'h3'],
            'printHeaderCrumbs' => true,
            'printCrumbSeparator' => '&raquo;'

        ];


        $this->htm = TabsX::widget($this->options);
    }
}
