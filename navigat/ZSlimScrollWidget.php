<?php

/*
 * Created By: AzimjonToirov
 *
 * github: https://github.com/rochal/jQuery-slimScroll
 * official-site: http://rocha.la/jQuery-slimScroll
 *
 * */

namespace zetsoft\widgets\navigat;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZSlimScrollWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' => 'loremloremloremloremloremloremloremloremloremloremloremloremloremloremlorem
                     loremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremlor
                     emloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloreml
                     oremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremloremlor
                     emloremloremloremloremloremloremloremloremloremloremloremlorem',
        'funtionName' => 'scrollTo',
        'scrollTo' => '10px',
        'width' => '200px',
        'height' => '280px',
        'color' => '#000',
        'position' => self::position['right'],
        'start' => self::start['bottom'],
        'opacity' => .5,
        'alwaysVisible' => true,
        'class' => ''
    ];

    /*
     * Constants
     * */
    public const position = [
        'right' => 'right',
        'left' => 'left',
    ];
    public const start = [
        'top' => 'top',
        'bottom' => 'bottom',
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [
        'onScroll' => 'function(e, pos){
            console.log(pos)
        }'
    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <div id="{id}">
            {content}
        </div>
HTML,

        'js' => /** @lang JavaScript */
            <<<JS
        $('#{id}').slimscroll({
            width : '{width}',
            // height in pixels of the visible scroll area
            height : '{height}',
            // width in pixels of the scrollbar and rail
            size : '5px',
            // scrollbar color, accepts any hex/color value
            color: '{color}',
            // scrollbar position - left/right
            position : '{position}',
            // distance in pixels between the side edge and the scrollbar
            distance : '1px',
            // default scroll position on load - top / bottom / $('selector')
            start : '{start}',
            // sets scrollbar opacity
            opacity : {opacity},
            // enables always-on mode for the scrollbar
            alwaysVisible : {alwaysVisible},
            // check if we should hide the scrollbar when user is hovering over
            disableFadeOut : false,
            // sets visibility of the rail
            railVisible : false,
            // sets rail color
            railColor : '#0e0e0e',
            // sets rail opacity
            railOpacity : .2,
            // whether  we should use jQuery UI Draggable to enable bar dragging
            railDraggable : true,
            // defautlt CSS class of the slimscroll rail
            railClass : 'slimScrollRail',
            // defautlt CSS class of the slimscroll bar
            barClass : 'slimScrollBar',
            // defautlt CSS class of the slimscroll wrapper
            wrapperClass : 'slimScrollDiv {wrapperClass}',
            // check if mousewheel should scroll the window if we reach top/bottom
            allowPageScroll : false,
            // scroll amount applied to each mouse wheel step
            wheelStep : 5,
            // scroll amount applied when user is using gestures
            touchScrollStep : 1000,
            // sets border radius
            borderRadius: '20px',
            // sets border radius of the rail
            railBorderRadius : '7px',
        })
        .bind('slimscroll', {onScroll});
        
        //Jumps to the specified scroll value
        function {funtionName}() {
            $('#{id}').slimScroll({ scrollTo: '{scrollTo}' })
        }
JS,
    ];

    public function init()
    {
        parent::init();
        if ($this->_config['begin'])
            ob_start();
    }

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
    }

    public function codes()
    {
        if ($this->_config['begin'])
            $this->htm = strtr($this->_layout['main'], [
                '{id}' => $this->id,
                '{content}' => ob_get_clean(),
                '{class}' => $this->_config['class']
            ]);
        else
            $this->htm = strtr($this->_layout['main'], [
                '{id}' => $this->id,
                '{content}' => $this->_config['content'],
                '{class}' => $this->_config['class']
            ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{onScroll}' => $this->eventCode('onScroll'),
            '{funtionName}' => $this->_config['funtionName'],
            '{scrollTo}' => $this->_config['scrollTo'],
            '{width}' => $this->_config['width'],
            '{height}' => $this->_config['height'],
            '{color}' => $this->_config['color'],
            '{position}' => $this->_config['position'],
            '{start}' => $this->_config['start'],
            '{opacity}' => $this->_config['opacity'],
            '{alwaysVisible}' => $this->jscode($this->_config['alwaysVisible']),
            '{wrapperClass}' => $this->_config['class']
        ]);
    }
}
