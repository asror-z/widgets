<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use yii\console\ExitCode;
use yii\web\JsExpression;
use zetsoft\system\kernels\ZWidget;

class ZStickyElementsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'duration' => ZStickyElementsWidget::Duration['450'],
        'stickiness' => ZStickyElementsWidget::Stickiness['three'],
        'pointer' => ZStickyElementsWidget::Pointer['false'],
        'cssClass' => ZStickyElementsWidget::cssClass['item'],


    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

    ];

    #region Consts

    public const Duration = [
        '450' => 450,
    ];
    public const cssClass = [
        'item' => 'item',
        'no class' => '',
    ];
    public const Stickiness = [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'sex' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
        'ten' => 10,
    ];
    public const Pointer = [
        'true' => 'true',
        'false' => 'false'
    ];
    #endregion

    #region Arrays

    /*    public $navLi = [
            ['Tab 1', 'This is tab title', 1],
            ['Tab 2', 'This is tab title', 2],
            ['Tab 3', 'This is tab title', 3],
            ['Tab 4', 'This is tab title', 4],
            ['Tab 5', 'This is tab title', 5],
            ['Tab 6', 'This is tab title', 6],
        ];*/

#endregion

    public $label = [];
    public $_label = [
        'default' => Azl . 'По умолчанию',
    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                 
<div class="Container-parent">
    <div class="Container">
        <div class="Container-content">
            
            <div class="buttons">
                <button class="button button--secondary {item}" touch-action="none"
                        style="transform: translateX(0px) translateY(0px); will-change: transform;">Oh, my&nbsp;!
                </button>
                <button class="button button--primary {item}" touch-action="none"
                        style="transform: translateX(0px) translateY(0px); will-change: transform;">Sticky buttons
                </button>
            </div>
            
        </div>

    </div>
</div>

HTML,


        'css' => <<<CSS
                 
CSS,

        'js' => <<<JS
                   $(document).ready(function() {
            stickyElements('.item', {
                stickiness: {stickiness},
                duration: {duration},
                pointer: {pointer},
            });  
            })     
JS,


    ];

    public function asset()
    {
        $this->fileCss('/render/navigat/ZStickyElementsWidget/demo/assets/css.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/stickyelements@2.2.1/dist/stickyelements-animate.js');
    }

    public function codes()
    {

        $this->htm = strtr(
            $this->_layout['item'], [
            '{item}' => $this->_config['cssClass'],

        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{pointer}' => $this->_config['pointer'],
            '{duration}' => $this->_config['duration'],
            '{stickiness}' => $this->_config['stickiness'],
        ]);


    }


}
