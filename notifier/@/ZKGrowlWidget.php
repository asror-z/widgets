<?php


namespace zetsoft\widgets\notifier;


/**
 *
 * Author:  Asror Zakirov
 *
 * http://demos.krajee.com/widget-details/growl
 */


use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use kartik\growl\Growl;
use yii\helpers\ArrayHelper;


class ZKGrowlWidget_old extends ZWidget
{

    public $config = [];
    public $_config = [
        'linkUrl' => '',
        'title' => 'Succesfuly! ',
        'delay' => 500,
        'type' => ZKGrowlWidget::type['success'],
        'body' => 'You successfully finished this procces!'
    ];

    public const type = [
        'info' => 'info',
        'danger' => 'danger',
        'success' => 'success',
        'warning' => 'warning',
    ];


    /**
     *
     * @var bool
     * Print Session
     */


    /**
     *
     * Function  show
     */
    public function codes()
    {
        $this->options = [
            'type' => $this->_config['type'],
            'icon' => $this->_config['icon'],
            'title' => $this->_config['title'],
            'linkUrl' => $this->_config['linkUrl'],
            'body' => $this->_config['body'],

            'linkTarget' => '_blank',
            'showSeparator' => true,
            'progressBarOptions' => [
                'role' => 'progressbar',
                'aria-valuenow' => '0',
                'aria-valuemin' => '0',
                'aria-valuemax' => '100',
                'style' => '100',
            ],
            'delay' => $this->_config['delay'],
            'closeButton' => [],
            'useAnimation' => true,
            'iconOptions' => [],
            'titleOptions' => [],
            'bodyOptions' => [],
            'progressContainerOptions' => [],
            'linkOptions' => [

            ],


            /**
             *
             * http://bootstrap-notify.remabledesigns.com/#documentation
             */
            'pluginOptions' => [
                'showProgressbar' => true,
                'timer' => 300,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ],
                'element' => 'body',
                'position' => null,
                'allow_dismiss' => true,
                'newest_on_top' => true,
                'offset' => 20,
                'spacing' => 10,
                'z_index' => 1031,
                'mouse_over' => null,
                'animate' => [
                    'enter' => Az::$app->utility->mains->animation(),
                    'exit' => Az::$app->utility->mains->animation()
                ],
                'onShow' => null,
                'onShown' => null,
                'onClose' => null,
                'onClosed' => null,
                'icon_type' => 'class'   // image | class
            ]
        ];


        $this->htm = Growl::widget($this->options);
    }


}
