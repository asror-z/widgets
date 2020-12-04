<?php


namespace zetsoft\widgets\notifier;


use http\Message\Body;
use kartik\widgets\Alert;
use zetsoft\system\kernels\ZWidget;

/**
 * Class ZKAlertWidget
 * @package widgets\dialogs
 * http://demos.krajee.com/widget-details/alert
 */
class ZKAlertWidget extends ZWidget
{

    /**
     * @var $type
     * Alert::TYPE_INFO
     * Alert::TYPE_DANGER
     * Alert::TYPE_SUCCESS
     * Alert::TYPE_WARNING
     * Alert::TYPE_PRIMARY
     * Alert::TYPE_DEFAULT
     */

    public $config = [];
    public $_config = [
        'type' => Alert::TYPE_DEFAULT,
        'iconType' => 'icon',
        'class' => '',
        'body' => '',
        'title' => '',
        'icon' => '',
        'delay' => 0,
        'isShowSeparator' => true,
        'items' => '',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZKAlertWidget/image/icon.png',
        'name' => Azl . 'KAlert',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZKAlertWidget/image/icon.png"/>',

    ];

    public const type = [
        'info' => 'info',
        'danger' => 'danger',
        'success' => 'success',
        'warning' => 'warning',
    ];


    public function codes()
    {
        $this->options = [
            'body' => $this->_config['body'],
            'type' => $this->_config['type'],
            'iconType' => $this->_config['iconType'],
            'icon' => $this->_config['icon'],
            'iconOptions' => [],
            'title' => $this->_config['title'],
            'titleOptions' => [
                'tag' => 'span',
                'class' => 'kv-alert-title'
            ],
            'showSeparator' => $this->_config['isShowSeparator'],
            'delay' => $this->_config['delay'],
            'options' => [
                 'class' => 'alert-info'
            ],
        ];

        $this->htm = Alert::widget($this->options);
    }


}
