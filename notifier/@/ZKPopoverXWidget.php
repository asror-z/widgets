<?php

namespace zetsoft\widgets\notifier;


use PhpOffice\PhpWord\Reader\HTML;
use zetsoft\system\kernels\ZWidget;
use kartik\popover\PopoverX;
use yii\web\JsExpression;

/**
 * Class ZKPopoverXWidget
 * @package widgets\dialogs
 * http://demos.krajee.com/popover-x
 */
class ZKPopoverXWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'content'=> '',
        'header'=> '',
        //'footer'=> '',
        'toggleClass'=> "fas-2x",
        'toggleLabel'=> "show",
        'toggleTag'=> 'button',
        'type'=> PopoverX::TYPE_DEFAULT,
        'placement'=> PopoverX::ALIGN_AUTO,
        'size'=> PopoverX::SIZE_MEDIUM,
        'grapes'=>true,
    ];
    public $event = [];
    public $_event = [
        'click'=>'function() { console.log("ZKPopoverX | $eventClick") }',
        'mouseenter'=> ' console.log("ZKPopoverX | $eventMouseenter") ',
        'mouseleave'=>  'function() { console.log("ZKPopoverX | $eventMouseleave") }',
        'focusin' => ' console.log("ZKPopoverX | $eventFocusin") ',
        'focusout'  => ' console.log("ZKPopoverX | $eventFocusout") '
    ];

    public function init()
    {
        parent::init();
        $this->option();
        ob_start();
        PopoverX::begin($this->options);
    }

    public function asset()
    {

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');

    }
    /**
     * Plugin Events
     * http://plugins.krajee.com/popover-x#events
     */

    public function codes()
    {

        $this->options = [
            'bsVersion' => $this->bsVersion,
            'type' => $this->_config['type'],
            'placement' => $this->_config['placement'],
            'size' => $this->_config['size'],
            'header' => $this->_config['header'],
            'headerOptions' => ['tag' => 'div'],
            'content' => $this->_config['content'],
            'arrowOptions' => [],
           // 'footer' => $this->_config['footer'],
            'footerOptions' => ['tag' => 'div'],
            'closeButton' => ['tag' => 'button', 'label' => '&times;'],
            'toggleButton' => [
                'tag' => $this->_config['toggleTag'],
                'class' => $this->_config['toggleClass'],
                'label' => $this->_config['toggleLabel'],
            ],
            'options' => [
                'config'=>'{config}',
                'widget'=>"{widget}",
            ],
            /**
             * Plugin Options
             * http://plugins.krajee.com/popover-x#options
             */
            /*'pluginOptions' => [
                'closeOpenPopovers' => true,
                'autoPlaceSmallScreen' => true,
                'smallScreenWidth' => 640,
                'keyboard' => true,
                'show' => false,
                'placement' => 'auto',
                'backdrop' => null,
            ],*/
            'pluginEvents' => [
                'click.popoverX' => $this->eventCode('click'),
                'mouseenter.popoverX' => $this->eventCode('mouseenter'),
                'mouseleave.popoverX' => $this->eventCode('mouseleave'),
                'focusin.popoverX' => $this->eventCode('focusin'),
                'focusout.popoverX ' => $this->eventCode('focusout'),
            ]
        ];


        PopoverX::end();
        $this->htm = ob_get_clean();
        $this->js=<<<HTML
HTML;

    }
}
