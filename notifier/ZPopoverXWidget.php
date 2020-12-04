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
class ZPopoverXWidget extends ZWidget
{

    /**
     * @var string the **default** bootstrap contextual color type
     */
    const TYPE_DEFAULT = 'default';

    /**
     * @var string the **primary** bootstrap contextual color type
     */
    const TYPE_PRIMARY = 'primary';

    /**
     * @var string the **information** bootstrap contextual color type
     */
    const TYPE_INFO = 'info';

    /**
     * @var string the **danger** bootstrap contextual color type
     */
    const TYPE_DANGER = 'danger';

    /**
     * @var string the **warning** bootstrap contextual color type
     */
    const TYPE_WARNING = 'warning';

    /**
     * @var string the **success** bootstrap contextual color type
     */
    const TYPE_SUCCESS = 'success';

    /**
     * @var string **auto** align popover container and its pointing arrow
     */
    const ALIGN_AUTO = 'auto';

    /**
     * @var string **auto top** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_TOP = 'auto-top';

    /**
     * @var string **auto right** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_RIGHT = 'auto-right';

    /**
     * @var string **auto bottom** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_BOTTOM = 'auto-bottom';

    /**
     * @var string **auto left** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_LEFT = 'auto-left';

    /**
     * @var string **horizontal** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_HORIZONTAL = 'horizontal';

    /**
     * @var string **auto vertical** align popover container and its pointing arrow
     */
    const ALIGN_AUTO_VERTICAL = 'vertical';

    /**
     * @var string **right** align popover container and its pointing arrow
     */
    const ALIGN_RIGHT = 'right';

    /**
     * @var string **left** align popover container and its pointing arrow
     */
    const ALIGN_LEFT = 'left';

    /**
     * @var string **top** align popover container and its pointing arrow
     */
    const ALIGN_TOP = 'top';

    /**
     * @var string **bottom** align popover container and its pointing arrow
     */
    const ALIGN_BOTTOM = 'bottom';

    /**
     * @var string **top** and **top left** align popover container and its pointing arrow
     */
    const ALIGN_TOP_LEFT = 'top top-left';

    /**
     * @var string **bottom** and **bottom left** align popover container and its pointing arrow
     */
    const ALIGN_BOTTOM_LEFT = 'bottom bottom-left';

    /**
     * @var string **top** and **top right** align popover container and its pointing arrow
     */
    const ALIGN_TOP_RIGHT = 'top top-right';

    /**
     * @var string **bottom** and **bottom right** align popover container and its pointing arrow
     */
    const ALIGN_BOTTOM_RIGHT = 'bottom bottom-right';

    /**
     * @var string **left** and **left top** align popover container and its pointing arrow
     */
    const ALIGN_LEFT_TOP = 'left left-top';

    /**
     * @var string **right** and **right top** align popover container and its pointing arrow
     */
    const ALIGN_RIGHT_TOP = 'right right-top';

    /**
     * @var string **left** and **left bottom** align popover container and its pointing arrow
     */
    const ALIGN_LEFT_BOTTOM = 'left left-bottom';

    /**
     * @var string **right** and **right bottom** align popover container and its pointing arrow
     */
    const ALIGN_RIGHT_BOTTOM = 'right right-bottom';

    /**
     * @var string **large** size
     */
    const SIZE_LARGE = 'lg';

    /**
     * @var string **medium** size
     */
    const SIZE_MEDIUM = 'md';

    /**
     * @inheritdoc
     */
    public $pluginName = 'popoverX';

    /**
     * @var string the popover contextual type. Must be one of the [[TYPE]] constants Defaults to
     * `PopoverX::TYPE_DEFAULT` or `default`.
     */
    public $type = self::TYPE_DEFAULT;

    /**
     * @var string the popover placement. Must be one of the [[ALIGN]] constants Defaults to `PopoverX::ALIGN_RIGHT` or
     *     `right`.
     */
    public $placement = self::ALIGN_RIGHT;

    /**
     * @var string the size of the popover dialog. Must be [[PopoverX::SIZE_LARGE]] or [[PopoverX::SIZE_MEDIUM]]
     */
    public $size;

    /**
     * @var string the header content in the popover dialog.
     */
    public $header;

    /**
     * @var array the HTML attributes for the header. The following special options are supported:
     *
     * - tag: string, the HTML tag for rendering the header. Defaults to 'div'.
     *
     */
    public $headerOptions = [];

    /**
     * @var string the body content
     */
    public $content = '';

    /**
     * @var array the HTML attributes for the popover indicator arrow.
     */
    public $arrowOptions = [];

    /**
     * @var string the footer content in the popover dialog.
     */
    public $footer;

    /**
     * @var array the HTML attributes for the footer. The following special
     * options are supported:
     *
     * - tag: string, the HTML tag for rendering the footer. Defaults to 'div'.
     *
     */
    public $footerOptions = [];

    /**
     * @var array the options for rendering the close button tag. The close button is displayed in the header of the
     *     popover dialog. Clicking on the button will hide the popover dialog. If this is null, no close button will
     *     be rendered. The following special options are supported:
     *
     * - tag: string, the HTML tag for rendering the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag. Please refer to the [PopoverX
     *     plugin documentation](http://plugins.krajee.com/popover-x) and the [Modal plugin
     *     help](http://getbootstrap.com/javascript/#modals) for the supported HTML attributes.
     */
    public $closeButton = [];

    /**
     * @var array the options for rendering the toggle button tag. The toggle button is used to toggle the visibility
     *     of the popover dialog. If this property is null, no toggle button will be rendered. The following special
     *     options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag. Please refer to the [PopoverX
     *     plugin documentation](http://plugins.krajee.com/popover-x) and the [Modal plugin
     *     help](http://getbootstrap.com/javascript/#modals) for the supported HTML attributes.
     *
     */
    public $toggleButton;
    public $displayValue;

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'button' => 'btn',
        'width' => 'auto',
        'minWidth' => '200px',
        'maxWidth' => 'none',
        'height' => 'auto',
        'begin' => false,
        'scroll' => false,
        'smallScreenWidth' => true,
        'autoPlaceSmallScreen' => true,
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
    <div id="{id}">
        {popoverBtn}
    </div>
         
<div class="PopoverContent" {readonly}>         
    <div id="{id}-popover" class="popover popover-x popover-{size} popover-primary">
        <div class="arrow"></div>
        <div class="popover-header popover-title bg-primary text-white">
        <div class="popover-buttons">
        <button class="close mx-2 close-button text-white" data-dismiss="popover-x">x</button>
        <span class="close refresh-button">{button}</span>
        </div>
        {titleHeader}
        </div>
        <div id="scroll{id}" class="popover-body popover-content scrollContent">
            {content}
           <div class="float-right"> {buttons} </div>
        </div>
    </div>
</div>    
    
HTML,

        'popoverjs' => <<<JS
             $('#{id}').popoverButton({
                trigger: 'click', 
                target: '#{id}-popover',
                placement : '{placement}',
                show : false,
             });
            
            $('#{id}-popover').popoverX({
                closeOpenPopovers : true,
                autoPlaceSmallScreen : {autoPlaceSmallScreen},
                smallScreenWidth : {smallScreenWidth},
                keyboard : true,
                backdrop : null,
                remote :''
            });
                       $('#scroll').slimscroll({
           /* width: '',
            railVisible: true,
            allowPageScroll: true,
            touchScrollStep: 1000,
            height:'400px',*/
    });

JS,
        'css' => <<<CSS
            /*.refresh-button{
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
                overflow-y: auto;
            }*/
            
            #{id}-popover {
                width: {width} !important;
                min-width: {minWidth} !important;
                max-width: {maxWidth} !important;
                height: {height} !important;
            }
            #scroll{id}{
                overflow:{scroll} !important;
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
        'horizontal' => 'horizontal',
        'grapes' => false,
        /*'vertical' => 'vertical'*/
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm',
    ];


    public function asset()
    {
        /* $this->fileCss('/publish/yarner/bootstrap-popover-x/css/bootstrap-popover-x.min.css');
          $this->fileJs('/publish/yarner/bootstrap-popover-x/js/bootstrap-popover-x.min.js');
          $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');*/

        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/css/bootstrap-popover-x.min.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.js');
    }


    /*public function init()
    {
        parent::init();
        ob_start();
    }*/

    public function init()
    {
        parent::init();
        //ob_start();
    }


    public function codes()
    {

        /* $content = ob_get_clean();*/

        $buttonPopover = ZButtonWidget::widget([
            'id' => $this->id,
            'config' => [
                'btn' => false,
                'hasIcon' => true,
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'hasBadge' => false,
                'pjax' => 0,

                'badgeType' => ZButtonWidget::badgeType['badge-danger'],
                'icon' => $this->_config['buttonIcon'],
                'iconColor' => '#000000'
            ],
        ]);
        $button = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnRounded' => false,
                'text' => '',
                'method' => ZButtonWidget::method['post'],
                'pjax' => true,
                'title' => 'Обновление',
                'ttSize' => ZButtonWidget::ttSize['small'],
                'ttSide' => ZButtonWidget::ttSide['bottom'],
                'btn' => false,
                'iconColor' => '#000000',
                'icon' => 'fa fa-' . FA::_SYNC,
            ],
            'id' => 'messagePjax'
        ]);

        $this->_layout;
        //vdd($this->_config['content']);
        $content = $this->_config['content'];
        /*if ($this->_config['begin'])
            $content = ob_get_clean();*/

        if ($this->_config['isBtn'])
            $this->htm = strtr($this->_layout['main'], [
                '{popoverBtn}' => $this->_config['button'],
//            '{content}' => Az::$app->cores->date->dateTime(),
                '{content}' => $content,
                '{button}' => $button,
                '{titleHeader}' => $this->_config['titleHeader'],
                '{id}' => $this->id,
                '{size}' => $this->_config['size'],
                '{buttons}' => $this->footer

            ]);  //  vdd($this->htm);

        $this->js = strtr($this->_layout['popoverjs'], [
            '{id}' => $this->id,
            '{placement}' => $this->jscode($this->_config['placement']),
            '{smallScreenWidth}' => $this->jscode($this->_config['smallScreenWidth']),
            '{autoPlaceSmallScreen}' => $this->jscode($this->_config['autoPlaceSmallScreen'])
        ]);


        if($this->_config['scroll']){
            $this->_config['scroll'] = 'scroll';
        }else{
            $this->_config['scroll'] = 'hidden';
        }
        $this->css = strtr($this->_layout['css'], [
            '{width}' => $this->_config['width'],
            '{minWidth}' => $this->_config['minWidth'],
            '{maxWidth}' => $this->_config['maxWidth'],
            '{height}' => $this->_config['height'],
            '{scroll}' => $this->_config['scroll'],
            '{id}' => $this->id,
        ]);
        
    }


}
