<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\kernels\ZWidget;
use kartik\widgets\AlertBlock;

/**
 * Class ZKAlertBlockWidget
 * @package widgets\dialogs
 * http://demos.krajee.com/widget-details/alert-block
 *
 * Ref :Ibrohimjon Kamoliddinov
 */
class ZKAlertBlockWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'isUseSessionFlash'=> true,
        'type'=> AlertBlock::TYPE_ALERT,
        'delay'=> 2000,
        'alert'=>'asdsadas',
        'title'=> 'asdasd',
        'body'=> '',

//        'iconType'=> 'fontawesome5',
    ];

    /*public $layout = [];
    public $_layout = [


    ];*/

    public function codes()
    {
        $this->options = [
            'type' => $this->_config['type'],
            'delay' => $this->_config['delay'],
            'useSessionFlash' => $this->_config['isUseSessionFlash'],
            'alertSettings' => ($this->_config['isUseSessionFlash']) ? [] : [
                'alert' => $this->_config['alert'],
                'settings' => [
                    'body' => $this->_config['body'],

                ]
            ],


            /**
             * closeButton
             * https://www.yiiframework.com/extension/yiisoft/yii2-bootstrap/doc/api/2.0/yii-bootstrap-alert#$closeButton-detail
             */
            'closeButton' => [
                'tag' => 'button',
                'label' => '×'
            ],
            'options' =>[
                'class' => 'alert-danger',
            ]
        ];
        $this->htm = AlertBlock::widget($this->options);
    }
}
