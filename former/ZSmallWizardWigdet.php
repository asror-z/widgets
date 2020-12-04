<?php

namespace zetsoft\widgets\wizard;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\themes\ZCardWidget;

/**
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZSmallWizardWigdet extends ZWidget
{
  public $config = [];
  public $_config = [

      'arrowClass' => 'sw-main sw-theme-arrows',
      'defaultClass' => '',
      'circleClass' => 'sw-main sw-theme-circles',
      'dotesCless' => 'sw-main sw-theme-dots',
      'text' => '',
      'text2' => '',
      'text3' => '',
      'step1' => '',
      'step2' => '',
      'step3' => '',
      'step4' => '',
      'steptitle1' => '',
      'steptitle2' => '',
      'steptitle3' => '',
      'steptitle4' => '',


  ];

  /*        public $layout = [];
          public $_layout = [];*/

  public function init()
  {
    parent::init();
    $this->layout = [
        'default' => <<<HTML

<h1>Default</h1>

<div id="smartwizard">
    <ul>
        <li><a href="#step-1">{$this->_config['steptitle1']}<br /><small>{$this->_config['step1']}</small></a></li>
        <li><a href="#step-2">{$this->_config['steptitle2']}<br /><small>{$this->_config['step2']}</small></a></li>
        <li><a href="#step-3">{$this->_config['steptitle3']}<br /><small>{$this->_config['step3']}</small></a></li>
        <li><a href="#step-4">{$this->_config['steptitle4']}<br /><small>{$this->_config['step4']}</small></a></li>
    </ul>

    <div class="wizardBlog">
        <div id="step-1" class="">
            {$this->_config['text']}
        </div>
        <div id="step-2" class="">
           {$this->_config['text2']}
        </div>
        <div id="step-3" class="">{$this->_config['text3']}</div>
        <div id="step-4" class="">
          {$this->_config['text2']}
        </div>
    </div>
</div>
<link rel="stylesheet" href="/publish/yarner/smartwizard/dist/css/smart_wizard.css">
      
        
HTML,
        'arrows' => <<<HTML
             <h1>Arrows</h1>

<div id="smartwizard2" class="{$this->_config['arrowClass']}">
    <ul>
        <li><a href="#step-1">{$this->_config['steptitle2']}<br /><small>{$this->_config['step1']}</small></a></li>
        <li ><a href="#step-2">{$this->_config['steptitle2']}<br /><small>{$this->_config['step2']}</small></a></li>
        <li ><a href="#step-3">{$this->_config['steptitle3']}<br /><small>{$this->_config['step3']}</small></a></li>
        <li ><a href="#step-4">{$this->_config['steptitle4']}<br /><small>{$this->_config['step4']}</small></a></li>
    </ul>

    <div class="wizardBlog">
        <div id="step-1">
             {$this->_config['text']}
        </div>
        <div id="step-2">
              {$this->_config['text2']}
        </div>
        <div id="step-3">
              {$this->_config['text3']}
        </div>
        <div id="step-4">
            {$this->_config['text2']}
        </div>
    </div>
</div>

    <link rel="stylesheet" href="/publish/yarner/smartwizard/dist/css/smart_wizard_theme_arrows.css"> 
        
HTML,
        'circles' => <<<HTML
        <h1>Circles</h1>

<div id="smartwizard3" class="{$this->_config['circleClass']}">
   <ul >
        <li ><a href="#step-1" >{$this->_config['steptitle2']}<br /><small>{$this->_config['step1']}</small></a></li>
        <li ><a href="#step-2" >{$this->_config['steptitle2']}<br /><small>{$this->_config['step2']}</small></a></li>
        <li ><a href="#step-3" >{$this->_config['steptitle3']}<br /><small>{$this->_config['step3']}</small></a></li>
        <li ><a href="#step-4" >{$this->_config['steptitle4']}<br /><small>{$this->_config['step4']}</small></a></li>
    </ul>

    <div class="wizardBlog">
        <div id="step-1" >
             {$this->_config['text']}
        </div>
        <div id="step-2" >
              {$this->_config['text2']}
        </div>
        <div id="step-3" >
              {$this->_config['text3']}
        </div>
        <div id="step-4" >
            {$this->_config['text2']}
        </div>
    </div>
</div>

<link rel="stylesheet" href="/publish/yarner/smartwizard/dist/css/smart_wizard_theme_circles.css">

HTML,
        'dots' => <<<HTML
       <h1>dots</h1>

<div id="smartwizard4" class="{$this->_config['dotesCless']}">
    <ul >
        <li ><a href="#step-1" >{$this->_config['steptitle2']}<br /><small>{$this->_config['step1']}</small></a></li>
        <li><a href="#step-2" >{$this->_config['steptitle2']}<br /><small>{$this->_config['step2']}</small></a></li>
        <li><a href="#step-3" >{$this->_config['steptitle3']}<br /><small>{$this->_config['step3']}</small></a></li>
        <li><a href="#step-4" >{$this->_config['steptitle4']}<br /><small>{$this->_config['step4']}</small></a></li>
    </ul>

    <div class="wizardBlog">
        <div id="step-1">
             {$this->_config['text']}
        </div>
        <div id="step-2" >
              {$this->_config['text2']}
        </div>
        <div id="step-3" >
              {$this->_config['text3']}
        </div>
        <div id="step-4" >
                {$this->_config['text']}
        </div>
    </div>
</div>

<link rel="stylesheet" href="/publish/yarner/smartwizard/dist/css/smart_wizard_theme_dots.css">
     
HTML,
    ];
  }

  public function asset()
  {
    $this->fileJs('/publish/yarner/smartwizard/dist/js/jquery.smartWizard.js');
  }

  public function codes()
  {
    $this->htm = $this->layout['default'];
    $this->js = <<<JS
  $(document).ready(function(){

        $('#smartwizard').smartWizard();
        $('#smartwizard2').smartWizard();
        $('#smartwizard3').smartWizard();
        $('#smartwizard4').smartWizard();
     
       // Step show event
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
            //alert("You are on step "+stepNumber+" now");
            if(stepPosition === 'first'){
                $("#prev-btn").addClass('disabled');
            }else if(stepPosition === 'final'){
                $("#next-btn").addClass('disabled');
            }else{
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });

        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function(){ alert('Finish Clicked'); });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function(){ $('#smartwizard').smartWizard("reset"); });


        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect:'fade',
            showStepURLhash: true,
            toolbarSettings: {toolbarPosition: 'bottom'}
        });


        // External Button Events
        $("#reset-btn").on("click", function() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");
            return true;
        });

        $("#prev-btn").on("click", function() {
            // Navigate previous
            $('#smartwizard').smartWizard("prev");
            return true;
        });

        $("#next-btn").on("click", function() {
            // Navigate next
            $('#smartwizard').smartWizard("next");
            return true;
        });

        $("#theme_selector").on("change", function() {
            // Change theme
            $('#smartwizard').smartWizard("theme", $(this).val());
            return true;
        });

        // Set selected theme on page refresh
        $("#theme_selector").change();
       
    });
     
JS;
    $this->css = <<<CSS
.wizardBlog div{
min-height: 400px !important;
max-height: 800px !important;
}
 #step-1,#step-2,#step-3,#step-4{
 position:absolute;
 }
  
CSS;
  }

}
