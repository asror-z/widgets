<?php

namespace zetsoft\widgets\notifier;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZBootstrapPopoverWidget
 * https://getbootstrap.com/docs/4.0/components/popovers/
 * https://gist.github.com/tamilps2/8897198
 *
 * Created By: Tursunaliyev Abdulloh
 */
class ZBootstrapPopoverWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'type' => ZBootstrapPopoverWidget::type['tooglePopover'],
        'placement' => 'bottom',

    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/notifier/ZBootstrapPopoverWidget/image/icon.png',
        'name' => Azl . 'BootstrapPopover',
        'title' => Azl . '<b>safasfsa</b><img src="/render/notifier/ZBootstrapPopoverWidget/image/icon.png"/>',

    ];

    /**
     *
     * Plugin Events
     *
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */
    public const type = [
        'tooglePopover' => 'tooglePopover',
        'TLRBpopover' => 'TLRBpopover',
        'dismissible' => 'dismissible',
        'disabled' => 'disabled'
    ];


    public function asset()
    {
    }

    public function init()
    {
        parent::init();
        ob_start();
    }


    public $layout = [];
    public $_layout = [
        'tooglePopover' => <<<HTML
                <button type="button" class="btn btn-lg btn-danger example-popover"  ' data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
        HTML,
        'TLRBpopover' => <<<HTML
                <button type="button" class="btn btn-secondary example-popover" data-container="body" data-toggle="popover" data-placement="{placement}" data-content="{content}">
                Popover on top new
                </button>
        HTML,
        'dismissible' => <<<HTML
            <a tabindex="0" class="btn btn-lg btn-danger popover-dismiss" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a>
HTML,
        'disabled' => <<<HTML
            <span class="d-inline-block example-popover" data-toggle="popover" data-content="Disabled popover">
            <button class="btn btn-primary"  style="pointer-events: none;" type="button" disabled>Disabled button</button>
            </span>
HTML,
        'js' => <<<JS
        
        $('.example-popover').popover({
            container: 'body',
            trigger: 'focus'
        });
        $('.popover-dismiss').popover({
            trigger: 'focus'
        });
        
    
         
  JS,
    ];

    public function codes()
    {


        $content = ob_get_clean();


        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{placement}' => $this->_config['placement'],
            '{content}' => $content,
            

        ]);

        $this->js .= strtr($this->_layout['js'], [
            '{placement}' => $this->_config['placement'],
            '{content}' => $content,
        ]);

    }

}
