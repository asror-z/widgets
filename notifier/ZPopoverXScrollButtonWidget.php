<?php

namespace zetsoft\widgets\notifier;

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Button;
use zetsoft\models\auto\ChatMessage;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZMessageWidgetOLD1;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;


/**
 *
 * Class ZPopoverXWidget
 *
 * https://github.com/kartik-v/bootstrap-popover-x
 * https://plugins.krajee.com/popover-x/demo
 *
 * Created By:Joha
 */
class ZPopoverXScrollButtonWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'visible' => true,
        'placement' => ZPopoverXWidget::placement['auto'],
        'buttonIcon' => 'fas fa-' . FA::_EXTERNAL_LINK_ALT,
        'titleColor' => ZColor::color['primary-color'],
        'size' => ZPopoverXWidget::size['lg'],
        'titleHeader' => 'Title',
        'badge' => '10',
        'content' => '',
        'isBtn' => true,
        'grapes' => true,

    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
         <button id="{id}-btn" class="mt-5 btn btn-primary btn-lg" data-toggle="popover-x" data-target="#{id}" data-placement="right">Top</button>
<div id="{id}" class="popover popover-default" style="width: 800px">
    <div class="arrow"></div>
    <div class="popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Title</div>
    <div class="popover-content">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
    </div>
</div>

    
    
HTML,

        'popoverjs' => <<<JS
       $(document).ready(function() {
             $('#{id}-btn').popoverButton({
        target: '#{id}',
        trigger: 'hover focus',
    });
    $('#{id}').popoverX({
        closeOpenPopovers: true,
        autoPlaceSmallScreen: true,
        smallScreenWidth: 100, 
        show: false,
        
         
    });
    // or alternatively initialize popover on hover of `#btn1`
    
       
    
});     
           

JS,
        'css' => <<<CSS
            .refresh-button{
                font-size: 18px;
            }
            .close-button{
                font-size: 25px;
            }
            .modal-backdrop{
                position: fixed !important;
            }
            .scrollContent{
                max-height: 400px;
                /*max-width: 100px;*/
                overflow-y: auto;
            }
            
                               
CSS,


    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKSelect2Widget | $eventChange") ',

    ];


    /**
     *
     * Constants
     */
    public const placement = [
        'top' => 'top',
        'bottom' => 'bottom',
        'left' => 'left',
        'right' => 'right',
        'top top-left' => 'top top-left',
        'top top-right' => 'top top-right',
        'bottom bottom-right' => 'bottom bottom-right',
        'bottom bottom-left' => 'bottom bottom-left',
        'left left-top' => 'left left-top',
        'left left-bottom' => 'left left-bottom',
        'right right-top' => 'right right-top',
        'right right-bottom' => 'right right-bottom',
        'auto' => 'auto',
        'auto-right' => 'auto-right',
        'auto-top' => 'auto-top',
        'auto-bottom' => 'auto-bottom',
        'auto-left' => 'auto-left',
        'horizontal' => 'horizontal'
        /*'vertical' => 'vertical'*/
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
    ];


    public function asset()
    {
        $this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/css/bootstrap-popover-x.min.css');
        $this->fileJs('https://code.jquery.com/jquery-3.2.1.min.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
        $this->fileJs('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
    }

    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->id,
        ]);


        $this->js = strtr($this->_layout['popoverjs'], [
            '{id}' => $this->id,
            '{placement}' => $this->jscode($this->_config['placement'])
        ]);

        $this->css = strtr($this->_layout['css'], []);
    }


}
