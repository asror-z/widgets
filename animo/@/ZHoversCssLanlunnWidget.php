<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZHoversCssLanlunnWidget
 * https://ianlunn.github.io/Hover/
 *
 * Created By: Musoxon Abdulhamidov
 * Refactored: Musoxon Abdulhamidov
 */

class ZHoversCssLanlunnWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'types2dTrans' =>ZHoversCssLanlunnWidget::types2dTran['hvr-grow'],
        'typesBackTrans' =>ZHoversCssLanlunnWidget::typesBackTran['hvr-fade'],
        'typesIconsTrans' =>ZHoversCssLanlunnWidget::typesIconsTran['hvr-icon-back'],
        'typesIcons' =>ZHoversCssLanlunnWidget::typesIcon['fa fa-chevron-circle-right'],
        'typesBorderTrans' =>ZHoversCssLanlunnWidget::typesBorderTran['hvr-border-fade'],
        'typesShadowTrans' =>ZHoversCssLanlunnWidget::typesShadowTran['hvr-shadow'],
        'typesBubbles' =>ZHoversCssLanlunnWidget::typesBubble['hvr-bubble-top'],
        'typesCurls' =>ZHoversCssLanlunnWidget::typesCurl['hvr-curl-top-left'],
    ];

    public const types2dTran = [
        'hvr-grow'=>'hvr-grow',
        'hvr-shrink'  => 'hvr-shrink' ,
        'hvr-pulse'  => 'hvr-pulse' ,
        'hvr-pulse-grow'  => 'hvr-pulse-grow' ,
        'hvr-pulse-shrink'  => 'hvr-pulse-shrink' ,
        'hvr-push'  => 'hvr-push' ,
        'hvr-pop'  => 'hvr-pop' ,
        'hvr-bounce-in'  => 'hvr-bounce-in' ,
        'hvr-bounce-out'  => 'hvr-bounce-out' ,
        'hvr-rotate'  => 'hvr-rotate' ,
        'hvr-grow-rotate'  => 'hvr-grow-rotate' ,
        'hvr-float'  => 'hvr-float' ,
        'hvr-sink'  => 'hvr-sink' ,
        'hvr-bob'  => 'hvr-bob' ,
        'hvr-hang'  => 'hvr-hang' ,
        'hvr-skew'  => 'hvr-skew' ,
        'hvr-skew-forward'  => 'hvr-skew-forward' ,
        'hvr-skew-backward'  => 'hvr-skew-backward' ,
        'hvr-wobble-horizontal'  => 'hvr-wobble-horizontal' ,
        'hvr-wobble-vertical'  => 'hvr-wobble-vertical' ,
        'hvr-wobble-to-bottom-right'  => 'hvr-wobble-to-bottom-right' ,
        'hvr-wobble-to-top-right'  => 'hvr-wobble-to-top-right' ,
        'hvr-wobble-top'  => 'hvr-wobble-top' ,
        'hvr-wobble-bottom'  => 'hvr-wobble-bottom' ,
        'hvr-wobble-skew'  => 'hvr-wobble-skew' ,
        'hvr-buzz'  => 'hvr-buzz' ,
        'hvr-buzz-out'  => 'hvr-buzz-out' ,
        'hvr-forward'  => 'hvr-forward' ,
        'hvr-backward'  => 'hvr-backward' ,
    ];
    public const typesBackTran = [
        'hvr-fade' => 'hvr-fade' ,
        'hvr-back-pulse' => 'hvr-back-pulse' ,
        'hvr-sweep-to-right' => 'hvr-sweep-to-right' ,
        'hvr-sweep-to-left' => 'hvr-sweep-to-left' ,
        'hvr-sweep-to-bottom' => 'hvr-sweep-to-bottom' ,
        'hvr-sweep-to-top' => 'hvr-sweep-to-top' ,
        'hvr-bounce-to-right' => 'hvr-bounce-to-right' ,
        'hvr-bounce-to-left' => 'hvr-bounce-to-left' ,
        'hvr-bounce-to-bottom' => 'hvr-bounce-to-bottom' ,
        'hvr-bounce-to-top' => 'hvr-bounce-to-top' ,
        'hvr-radial-out' => 'hvr-radial-out' ,
        'hvr-radial-in' => 'hvr-radial-in' ,
        'hvr-rectangle-in' => 'hvr-rectangle-in' ,
        'hvr-rectangle-out' => 'hvr-rectangle-out' ,
        'hvr-shutter-in-horizontal' => 'hvr-shutter-in-horizontal' ,
        'hvr-shutter-out-horizontal' => 'hvr-shutter-out-horizontal' ,
        'hvr-shutter-in-vertical' => 'hvr-shutter-in-vertical' ,
        'hvr-shutter-out-vertical' => 'hvr-shutter-out-vertical' ,

    ];
    public const typesIconsTran = [
        'hvr-icon-back' => 'hvr-icon-back' ,
        'hvr-icon-forward' => 'hvr-icon-forward' ,
        'hvr-icon-down' => 'hvr-icon-down' ,
        'hvr-icon-u' => 'hvr-icon-u' ,
        'hvr-icon-spin' => 'hvr-icon-spin' ,
        'hvr-icon-drop' => 'hvr-icon-drop' ,
        'hvr-icon-fade' => 'hvr-icon-fade' ,
        'hvr-icon-float-away' => 'hvr-icon-float-away' ,
        'hvr-icon-sink-away' => 'hvr-icon-sink-away' ,
        'hvr-icon-grow' => 'hvr-icon-grow' ,
        'hvr-icon-shrink' => 'hvr-icon-shrink' ,
        'hvr-icon-pulse' => 'hvr-icon-pulse' ,
        'hvr-icon-pulse-grow' => 'hvr-icon-pulse-grow' ,
        'hvr-icon-pulse-shrink' => 'hvr-icon-pulse-shrink' ,
        'hvr-icon-push' => 'hvr-icon-push' ,
        'hvr-icon-pop' => 'hvr-icon-pop' ,
        'hvr-icon-bounce' => 'hvr-icon-bounce' ,
        'hvr-icon-rotate' => 'hvr-icon-rotate' ,
        'hvr-icon-grow-rotate' => 'hvr-icon-grow-rotate' ,
        'hvr-icon-float' => 'hvr-icon-float' ,
        'hvr-icon-sin' => 'hvr-icon-sin' ,
        'hvr-icon-bob' => 'hvr-icon-bob' ,
        'hvr-icon-hang' => 'hvr-icon-hang' ,
        'hvr-icon-wobble-horizontal' => 'hvr-icon-wobble-horizontal' ,
        'hvr-icon-wobble-vertical' => 'hvr-icon-wobble-vertical' ,
        'hvr-icon-buzz' => 'hvr-icon-buzz' ,
    ];
    public const typesIcon = [
        'fa fa-chevron-circle-left' => 'fa fa-chevron-circle-left ' ,
        'fa fa-chevron-circle-right' => 'fa fa-chevron-circle-right ' ,
        'fas fa-arrow-circle-down' => 'fas fa-arrow-circle-down ' ,
        'fas fa-arrow-circle-up' => 'fas fa-arrow-circle-up ' ,
        'fas fa-sync-alt' => 'fas fa-sync-alt ' ,
        'fa fa-tint' => 'fa fa-tint ' ,
        'fa fa-check' => 'fa fa-check ' ,
        'fa fa-plus-circle' => 'fa fa-plus-circle ' ,
        'fa fa-minus-circle' => 'fa fa-minus-circle ' ,
        'fas fa-smile' => 'fas fa-smile ' ,
        'far fa-frown' => 'far fa-frown ' ,
        'fa fa-home' => 'fa fa-home ' ,
        'fa fa-home' => 'fa fa-home ' ,
        'fa fa-home' => 'fa fa-home ' ,
        'far fa-star' => 'far fa-star ' ,
        'fas fa-star' => 'fas fa-star ' ,
        'far fa-thumbs-up' => 'far fa-thumbs-up ' ,
        'fa fa-paperclip' => 'fa fa-paperclip' ,
        'fa fa-phone' => 'fa fa-phone ' ,
        'fas fa-arrow-circle-up' => 'fas fa-arrow-circle-up' ,
        'fas fa-arrow-circle-down' => 'fas fa-arrow-circle-down ' ,
        'fa fa-chevron-up' => 'fa fa-chevron-up ' ,
        'fa fa-chevron-down' => 'fa fa-chevron-down ' ,
        'fa fa-arrow-right' => 'fa fa-arrow-right ' ,
        'fa fa-arrow-up' => 'fa fa-arrow-up ' ,
        'far fa-clock' => 'far fa-clock ' ,
        'fa fa-lock' => 'fa fa-lock ' ,

    ];
    public const typesBorderTran = [
        'hvr-border-fade' => 'hvr-border-fade' ,
        'hvr-hollow' => 'hvr-hollow' ,
        'hvr-trim' => 'hvr-trim' ,
        'hvr-ripple-out' => 'hvr-ripple-out' ,
        'hvr-ripple-in' => 'hvr-ripple-in' ,
        'hvr-outline-out' => 'hvr-outline-out' ,
        'hvr-outline-in' => 'hvr-outline-in' ,
        'hvr-round-corners' => 'hvr-round-corners' ,
        'hvr-underline-from-left' => 'hvr-underline-from-left' ,
        'hvr-underline-from-center' => 'hvr-underline-from-center' ,
        'hvr-underline-from-right' => 'hvr-underline-from-right' ,
        'hvr-reveal' => 'hvr-reveal' ,
        'hvr-underline-reveal' => 'hvr-underline-reveal' ,
        'hvr-overline-reveal' => 'hvr-overline-reveal' ,
        'hvr-overline-from-left' => 'hvr-overline-from-left' ,
        'hvr-overline-from-center' => 'hvr-overline-from-center' ,
        'hvr-overline-from-right' => 'hvr-overline-from-right' ,
    ];
    public const typesShadowTran = [
        'hvr-shadow' => 'hvr-shadow' ,
        'hvr-grow-shadow' => 'hvr-grow-shadow' ,
        'hvr-float-shadow' => 'hvr-float-shadow' ,
        'hvr-glow' => 'hvr-glow' ,
        'hvr-shadow-radial' => 'hvr-shadow-radial' ,
        'hvr-box-shadow-outset' => 'hvr-box-shadow-outset' ,
        'hvr-box-shadow-inset' => 'hvr-box-shadow-inset' ,
    ];
    public const typesBubble = [
        'hvr-bubble-top' => 'hvr-bubble-top' ,
        'hvr-bubble-right' => 'hvr-bubble-right' ,
        'hvr-bubble-bottom' => 'hvr-bubble-bottom' ,
        'hvr-bubble-left' => 'hvr-bubble-left' ,
        'hvr-bubble-float-top' => 'hvr-bubble-float-top' ,
        'hvr-bubble-float-right' => 'hvr-bubble-float-right' ,
        'hvr-bubble-float-bottom' => 'hvr-bubble-float-bottom' ,
    ];
    public const typesCurl =[
        'hvr-curl-top-left' => 'hvr-curl-top-left' ,
        'hvr-curl-top-right' => 'hvr-curl-top-right' ,
        'hvr-curl-bottom-right' => 'hvr-curl-bottom-right' ,
        'hvr-curl-bottom-left' => 'hvr-curl-bottom-left' ,
    ];


    public function asset()
    {
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css');
        $this->fileCss('/vendor/fortawesome/font-awesome/css/all.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css');
        $this->fileJs('/vendor/fortawesome/font-awesome/js/ALL.js');
    }

    public function codes()
    {
        $this->htm = <<<HTML
        <div class="{$this->_config['types2dTrans']}"></div>
        <div class="{$this->_config['typesBackTrans']}"></div>
        <div class="{$this->_config['typesIconsTrans']}"></div>
        <div> <i class="{$this->_config['typesIcons']}"></i> </div>
        <div class="{$this->_config['typesBorderTrans']}"></div>
        <div class="{$this->_config['typesShadowTrans']}"></div>
        <div class="{$this->_config['typesBubbles']}"></div>

    <div class="flex-container">
    <h2>2D Transitions   <i class="fa fa-chevron-circle-right"></i></h2>

    <a href="#" class="hvr-grow">Grow</a>
    <a href="#" class="hvr-shrink">Shrink</a>
    <a href="#" class="hvr-pulse">Pulse</a>
    <a href="#" class="hvr-pulse-grow">Pulse Grow</a>
    <a href="#" class="hvr-pulse-shrink">Pulse Shrink</a>
    <a href="#" class="hvr-push">Push</a>
    <a href="#" class="hvr-pop">Pop</a>
    <a href="#" class="hvr-bounce-in">Bounce In</a>
    <a href="#" class="hvr-bounce-out">Bounce Out</a>
    <a href="#" class="hvr-rotate">Rotate</a>
    <a href="#" class="hvr-grow-rotate">Grow Rotate</a>
    <a href="#" class="hvr-float">Float</a>
    <a href="#" class="hvr-sink">Sink</a>
    <a href="#" class="hvr-bob">Bob</a>
    <a href="#" class="hvr-hang">Hang</a>
    <a href="#" class="hvr-skew">Skew</a>
    <a href="#" class="hvr-skew-forward">Skew Forward</a>
    <a href="#" class="hvr-skew-backward">Skew Backward</a>
    <a href="#" class="hvr-wobble-horizontal">Wobble Horizontal</a>
    <a href="#" class="hvr-wobble-vertical">Wobble Vertical</a>
    <a href="#" class="hvr-wobble-to-bottom-right">Wobble To Bottom Right</a>
    <a href="#" class="hvr-wobble-to-top-right">Wobble To Top Right</a>
    <a href="#" class="hvr-wobble-top">Wobble Top</a>
    <a href="#" class="hvr-wobble-bottom">Wobble Bottom</a>
    <a href="#" class="hvr-wobble-skew">Wobble Skew</a>
    <a href="#" class="hvr-buzz">Buzz</a>
    <a href="#" class="hvr-buzz-out">Buzz Out</a>
    <a href="#" class="hvr-forward">Forward</a>
    <a href="#" class="hvr-backward">Backward</a>
</div>

    <div class="flex-container">
        <h2>Background Transitions  <i class="fa fa-chevron-circle-right"></i></h2>

        <a href="#" class="hvr-fade">Fade</a>
        <a href="#" class="hvr-back-pulse">Back Pulse</a>
        <a href="#" class="hvr-sweep-to-right">Sweep To Right</a>
        <a href="#" class="hvr-sweep-to-left">Sweep To Left</a>
        <a href="#" class="hvr-sweep-to-bottom">Sweep To Bottom</a>
        <a href="#" class="hvr-sweep-to-top">Sweep To Top</a>
        <a href="#" class="hvr-bounce-to-right">Bounce To Right</a>
        <a href="#" class="hvr-bounce-to-left">Bounce To Left</a>
        <a href="#" class="hvr-bounce-to-bottom">Bounce To Bottom</a>
        <a href="#" class="hvr-bounce-to-top">Bounce To Top</a>
        <a href="#" class="hvr-radial-out">Radial Out</a>
        <a href="#" class="hvr-radial-in">Radial In</a>
        <a href="#" class="hvr-rectangle-in">Rectangle In</a>
        <a href="#" class="hvr-rectangle-out">Rectangle Out</a>
        <a href="#" class="hvr-shutter-in-horizontal">Shutter In Horizontal</a>
        <a href="#" class="hvr-shutter-out-horizontal">Shutter Out Horizontal</a>
        <a href="#" class="hvr-shutter-in-vertical">Shutter In Vertical</a>
        <a href="#" class="hvr-shutter-out-vertical">Shutter Out Vertical</a>

    </div>

    <div class="flex-container" id="icons">
        <h2>Icons  <i class="fa fa-chevron-circle-right"></i></h2>


        <a href="#" class="hvr-icon-back">
            <i class="fa fa-chevron-circle-left hvr-icon"></i> Icon Back
        </a>
        <a href="#" class="hvr-icon-forward">
            Icon Forward
            <i class="fa fa-chevron-circle-right hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-down">
            Icon Down <i class="fas fa-arrow-circle-down hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-up">
            Icon Up <i class="fas fa-arrow-circle-up hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-spin">
            Icon Spin <i class="fas fa-sync-alt hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-drop">
            Icon Drop <i class="fa fa-tint hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-fade">
            Icon Fade <i class="fa fa-check hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-float-away">
            Icon Float Away <i class="fa fa-plus-circle hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-sink-away">
            Icon Sink Away <i class="fa fa-minus-circle hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-grow">
            Icon Grow <i class="fas fa-smile hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-shrink">
            Icon Shrink <i class="far fa-frown hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-pulse">
            Icon Pulse <i class="fa fa-home hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-pulse-grow">
            Icon Pulse Grow <i class="fa fa-home hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-pulse-shrink">
            Icon Pulse Shrink <i class="fa fa-home hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-push">
            Icon Push <i class="far fa-star hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-pop">
            Icon Pop <i class="fas fa-star hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-bounce">
            Icon Bounce <i class="far fa-thumbs-up hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-rotate">
            Icon Rotate <i class="fa fa-paperclip hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-grow-rotate">
            Icon Grow Rotate <i class="fa fa-phone hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-float">
            Icon Float <i class="fas fa-arrow-circle-up hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-sink">
            Icon Sink <i class="fas fa-arrow-circle-down hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-bob">
            Icon Bob <i class="fa fa-chevron-up hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-hang">
            Icon Hang <i class="fa fa-chevron-down hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-wobble-horizontal">
            Icon Wobble Horizontal <i class="fa fa-arrow-right hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-wobble-vertical">
            Icon Wobble Vertical <i class="fa fa-arrow-up hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-buzz">
            Icon Buzz <i class="far fa-clock hvr-icon"></i>
        </a>
        <a href="#" class="hvr-icon-buzz-out">
            Icon Buzz Out <i class="fa fa-lock hvr-icon"></i>
        </a>
    </div>

    <div class="flex-container">
        <h2>Border Transitions  <i class="fa fa-chevron-circle-right"></i></h2>
        <a href="#" class="hvr-border-fade">Border Fade</a>
        <a href="#" class="hvr-hollow">Hollow</a>
        <a href="#" class="hvr-trim">Trim</a>
        <a href="#" class="hvr-ripple-out">Ripple Out</a>
        <a href="#" class="hvr-ripple-in">Ripple In</a>
        <a href="#" class="hvr-outline-out">Outline Out</a>
        <a href="#" class="hvr-outline-in">Outline In</a>
        <a href="#" class="hvr-round-corners">Round Corners</a>
        <a href="#" class="hvr-underline-from-left">Underline From Left</a>
        <a href="#" class="hvr-underline-from-center">Underline From Center</a>
        <a href="#" class="hvr-underline-from-right">Underline From Right</a>
        <a href="#" class="hvr-reveal">Reveal</a>
        <a href="#" class="hvr-underline-reveal">Underline Reveal</a>
        <a href="#" class="hvr-overline-reveal">Overline Reveal</a>
        <a href="#" class="hvr-overline-from-left">Overline From Left</a>
        <a href="#" class="hvr-overline-from-center">Overline From Center</a>
        <a href="#" class="hvr-overline-from-right">Overline From Right</a>
    </div>
    
    <div class="flex-container">
        <h2>Shadow and Glow Transitions  <i class="fa fa-chevron-circle-right"></i></h2>

        <a href="#" class="hvr-shadow">Shadow</a>
        <a href="#" class="hvr-grow-shadow">Grow Shadow</a>
        <a href="#" class="hvr-float-shadow">Float Shadow</a>
        <a href="#" class="hvr-glow">Glow</a>
        <a href="#" class="hvr-shadow-radial">Shadow Radial</a>
        <a href="#" class="hvr-box-shadow-outset">Box Shadow Outset</a>
        <a href="#" class="hvr-box-shadow-inset">Box Shadow Inset</a>

    </div>
    
    <div class="flex-container">
        <h2>Speech Bubbles  <i class="fa fa-chevron-circle-right"></i></h2>

        <a href="#" class="hvr-bubble-top">Bubble Top</a>
        <a href="#" class="hvr-bubble-right">Bubble Right</a>
        <a href="#" class="hvr-bubble-bottom">Bubble Bottom</a>
        <a href="#" class="hvr-bubble-left">Bubble Left</a>
        <a href="#" class="hvr-bubble-float-top">Bubble Float Top</a>
        <a href="#" class="hvr-bubble-float-right">Bubble Float Right</a>
        <a href="#" class="hvr-bubble-float-bottom">Bubble Float Bottom</a>

    </div>
    
    <div class="flex-container">
        <h2>Curls  <i class="fa fa-chevron-circle-right"></i></h2>

        <a href="#" class="hvr-curl-top-left">Curl Top Left</a>
        <a href="#" class="hvr-curl-top-right">Curl Top Right</a>
        <a href="#" class="hvr-curl-bottom-right">Curl Bottom Right</a>
        <a href="#" class="hvr-curl-bottom-left">Curl Bottom Left</a>
    </div>

HTML;

        $this->css = <<<CSS
    * { box-sizing: border-box; }

        .hvr-grow {
            display: inline-block;
            vertical-align: middle;
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            transition-duration: 0.3s;
            transition-property: transform;
        }

        .hvr-grow:hover,
        .hvr-grow:focus,
        .hvr-grow:active {
            transform: scale(1.1);
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 100px;

        }

        .flex-container > a {
            background-color:  #8dcaf1;
            width: 130px;
            margin: 10px;
            text-align: center;
            line-height: 20px;
            font-size: 18px;
            padding: 20px;
            text-decoration: none;
            border-radius: 10px;
        }
CSS;


    }

}
