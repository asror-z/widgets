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
 *
 * https://github.com/usablica/intro.js
 * https://introjs.com/
 *
 *
 * Created By: Jahongir Qudratov
 *
 */
class ZIntroJsWidget extends ZWidget
{

    /**
     * Configuration
     * 
     */
    public $config = [];
    public $_config = [
        'maxCount' => 30,
        'disabled' => false,
        'contentBefore' => '',
        'position' => ZIntroJsWidget::position['auto'],
        'theme' => ZIntroJsWidget::theme['modern'],
        'doneLabel' => "Done",
        'nextLabel' => 'Next',
        'prevLabel' => 'Back',
        'skipLabel' => 'Skip',
        'exitOnEsc' => true,
        'exitOnOverlayClick' => true,
        'showStepNumbers' => true,
        'keyboardNavigation' => true,
        'showButtons' => true,
        'showDoneLabel' => true,
        'showBullets' => true,
        'showProgress' => true,
        'scrollToElement' => true,
        'scrollTo' => true,
        'disableInteraction' => true,
        'scrollPadding' => true,
        'overlayOpacity' => 0.5,
        'hidePrev' => true,
        'hideNext' => true,
        'tooltipPosition' => 'right',
        'tooltipClass' => '',
        'highlightClass' => '',
        'hintPosition' => 'top-middle',
        'hintButtonLabel' => 'Got it',
        'hintAnimation' => true,
        'buttonClass' => 'introjs-button'
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
    public const theme = [
        'classic' => 'introjs-classic',
        'royal' => 'introjs-royal',
        'nassim' => 'introjs-nassim',
        'nazanin' => 'introjs-nazanin',
        'dark' => 'introjs-dark',
        'modern' => 'introjs-modern'
    ];

    public const position = [
        'auto' => 'auto',
        'top' => 'top',
        'left' => 'left',
        'right' => 'right',
        'bottom' => 'bottom',
        'bottom-left-aligned' => 'bottom-left-aligned',
        'ottom-middle-aligned' => 'ottom-middle-aligned',
        'bottom-right-aligned' => 'bottom-right-aligned'
    ];



    public function asset()
    {
       //$this->fileCss('/publish/yarner/intro.js/minified/introjs.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/introjs@0.2.2/lib/index.min.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/intro.js@2.9.3/themes/introjs-modern.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/intro.js@2.9.3/intro.js');
    }

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
        <div class="container-narrow">

            <div class="jumbotron">
                <h1 data-hint="This is a tooltip!">Hints</h1>
                <p class="lead">Add hints using <code>data-hint</code> attribute.</p>
                <a id="show_intro" href="javascript:void(0)" onclick="javascript:introJs().addHints();">Add hints</a>
            </div>
            <hr>

            <div class="jumbotron">
                <h1 id="step1">IntroJS</h1>
                <p id="step4" class="lead">In this example we are going to define steps with JSON configuration.</p>
                <a id="show_intro" class="new_intro"  href="javascript:void(0)">Show me how</a>
            </div>
            <hr>

            <div class="row-fluid marketing">
                <div id="step2" class="span6">
                    <h4>Section One</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
        
                    <h4>Section Two</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
        
                    <h4>Section Three</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
                </div>
            
                    <div id="step3" class="span6">
                        <h4>Section Four</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
            
            
                        <h4>Section Five</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
            
                        <h4>Section Six</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis augue a neque cursus ac blandit orci faucibus. Phasellus nec metus purus.</p>
                    </div>
                </div>
            
            <hr>
            
           </div>
HTML,

         'css' => <<<CSS
        body{padding-top:20px;
            font-family:raleway,sans-serif;
            padding-bottom:40px;
        }
        .container-narrow{
            margin:0 auto;
            max-width:700px;
        }
        .container-narrow>hr{
            margin:30px 0;
        }
        .jumbotron{
            margin:60px 0;
            text-align:center;
        }
        .jumbotron h1{
            font-size:72px;
            line-height:1;
        }
        .jumbotron .btn{
            font-size:21px;
            padding:14px 24px;
        }
        .marketing{
            margin:60px 0;
        }
        .marketing p+h4{
            margin-top:28px;
        }
    CSS,

    ];

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);


        $this->js = <<<JS
     document.querySelector('.new_intro').addEventListener("click",function() {
        startIntro();
     });
    
    function startIntro(){
        var intro = introJs();
        intro.setOptions({
            steps: [
                {
                    intro: "Hello world!"
                },
                {
                    element: document.querySelector('#step1'),
                    intro: "This is a tooltip."
                },
                {
                    element: document.querySelectorAll('#step2')[0],
                    intro: "Ok, wasn't that fun?",
                    position: 'right'
                },
                {
                    element: '#step3',
                    intro: 'More features, more fun.',
                    position: 'left'
                },
                {
                    element: '#step4',
                    intro: "Another step.",
                    position: 'bottom'
                },
                {
                    element: '#step5',
                    intro: 'Get it, use it.'
                }
            ],
            'position': '{$this->_config['position']}', // top | left | right | bottom | bottom-left-aligned | bottom | ottom-middle-aligned | bottom-right-aligned
            'doneLabel': '{$this->_config['doneLabel']}',
            'nextLabel': '{$this->_config['nextLabel']}',
            'prevLabel': '{$this->_config['prevLabel']}',
            'skipLabel': '{$this->_config['skipLabel']}',
            'exitOnEsc': !!{$this->_config['exitOnEsc']}, //false
            'exitOnOverlayClick': !!{$this->_config['exitOnOverlayClick']}, //false
            'showStepNumbers': !!{$this->_config['showStepNumbers']}, //false
            'keyboardNavigation': {$this->_config['keyboardNavigation']}, //false
            'showButtons': {$this->_config['showButtons']}, //false
            'showDoneLabel' : {$this->_config['showDoneLabel']},
            'showBullets' : {$this->_config['showBullets']}, //false
            'showProgress' : {$this->_config['showDoneLabel']}, //false
            'scrollToElement' : {$this->_config['scrollToElement']}, //false
            'scrollTo' : {$this->_config['scrollTo']}, //false
            'disableInteraction' : {$this->_config['disableInteraction']}, //false
            'scrollPadding' : {$this->_config['scrollPadding']}, // false
            'overlayOpacity' : {$this->_config['overlayOpacity']}, // between 0 and 1
            'hidePrev' : {$this->_config['hidePrev']}, //false
            'hideNext' : {$this->_config['hideNext']}, //false
            'tooltipPosition' : '{$this->_config['tooltipPosition']}',
            'tooltipClass': '{$this->_config['tooltipClass']}',
            'highlightClass': '{$this->_config['highlightClass']}',
            'hintPosition': '{$this->_config['hintPosition']}',
            'hintButtonLabel': '{$this->_config['hintButtonLabel']}',
            'hintAnimation': {$this->_config['hintAnimation']},
            'buttonClass': '{$this->_config['buttonClass']}'
        });
        intro.start();
    }
JS;

        $this->htm = strtr($this->_layout['main'], []);
        $this->css = strtr($this->_layout['css'], []);



    }

}
