<?php

/**
 *
 *
 * Author:  Daho
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;
use function False\true;

class ZSmartWizardWidget extends ZWidget
{
    public $data = [

    ];

    public $config = [];
    public $_config = [
        'theme' => self::theme['arrows'],
        'title' => 'wq',
        'backButtonSupport' => true,
    ];

    public const theme = [
        'default' => 'default',
        'arrows' => 'arrows',
        'dots' => 'dots',
        'circles' => 'circles',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                 
                    <div id="{id}">
                        <ul>
                            {wizardHeader}
                        </ul>
                    
                        <div class="wizardBlog">
                            {wizardBody}
                        </div>
                    </div>

HTML,


        'js' => <<<JS
         $('#{id}').smartWizard({
            selected: 0,  // Initial selected step, 0 = first step 
            keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            autoAdjustHeight:true, // Automatically adjust content height
            cycleSteps: true, // Allows to cycle the navigation of steps
            backButtonSupport: true, // Enable the back button support
            useURLhash: true, // Enable selection of the step based on url hash
            showStepURLhash: true, //Show url hash based on step
            contentCache: true, //On or Off caching of step contents on ajax calls, if false content is fetched always from ajax url
           	 hiddenSteps: [], //an array of step numbers to be hidden
            lang: {  // Language variables
                next: 'Next', 
                previous: 'Previous'
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [
                $('<button type="submit"></button>').text('Finish')
                              .addClass('btn btn-info'),
                ]
                
            }, 
            ajaxSettings: {}, //Provide extra settings for step ajax content calls
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: false, // Activates all anchors clickable all times
                markDoneStep: true, // add done css
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },            
            contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
            disabledSteps: [],    // Array Steps disabled
            errorSteps: [],    // Highlight step with errors
            theme: '{theme}',
            transitionEffect: 'fade', // Effect on navigation, none/slide/fade
            transitionSpeed: '400'
      });
JS,
        'css' => <<<CSS


CSS,
        'body' => <<<HTML
<div id="{id}" class="pt-2 wizard-content">
    {content}
</div>
HTML,
        'header' => <<<HTML
<li><a href="#{id}">{title}<br />
      <small>{subtitle}</small></a></li>
HTML,


    ];

    public function asset()
    {
        /*$this->fileJs('/publish/yarner/smartwizard/dist/js/jquery.smartWizard.js');
        $this->fileCss('/publish/yarner/smartwizard/dist/css/smart_wizard.css');
        $this->fileCss('/publish/yarner/smartwizard/dist/css/smart_wizard_theme_arrows.css');
        $this->fileCss('/publish/yarner/smartwizard/dist/css/smart_wizard_theme_circles.css');
        $this->fileCss('/publish/yarner/smartwizard/dist/css/smart_wizard_theme_dots.css');*/
        $this->fileJs('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/js/jquery.smartWizard.js');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_arrows.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_circles.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_dots.css');
    }


    public function codes()
    {
        $header = '';
        $body = '';
        foreach ($this->data as $key => $value) {
            $header .= strtr($this->_layout['header'], [
                '{id}' => "step-{$key}",
                '{title}' => ZArrayHelper::getValue($value, 'title'),
                '{subtitle}' => ZArrayHelper::getValue($value, 'subtitle'),
            ]);

            $body .= strtr($this->_layout['body'], [
                '{id}' => "step-{$key}",
                '{content}' => ZArrayHelper::getValue($value, 'content')
            ]);


        }


        $this->htm = strtr($this->_layout['main'], [
            '{wizardHeader}' => $header,
            '{wizardBody}' => $body,
            '{id}' => $this->id,

            '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''
        ]);
        //vdd($this->htm);


        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{theme}' => $this->_config['theme'],

        ]);

        $this->css = strtr($this->_layout['css'], []);

    }


}
