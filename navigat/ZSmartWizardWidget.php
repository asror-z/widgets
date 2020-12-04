<?php

/**
 *
 *
 * Author:  Anvar Jabborov
 *
 *
 */

namespace zetsoft\widgets\navigat;

use zetsoft\system\kernels\ZWidget;

class ZSmartWizardWidget extends ZWidget
{
    public $config = [];
    public $_config = [

        'theme' => self::theme['arrows'],
        'animation' => self::animation['none'],
        'selectedStep' => self::selectedStep['one'],
        'justified' => self::justified['true'],
        'speed' => self::speed['400'],
        'toolbarPosition' => self::toolbarPosition['bottom'],
        'toolbarButtonPosition' => self::toolbarButtonPosition['right'],
        'buttonNextText' => self::buttonNextText['next'],
        'buttonPrevText' => self::buttonPrevText['previous'],
        'toolbarExtraButtons' => self::toolbarExtraButtons['none'],
        'method' => self::method['GET'],


    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',
    ];

    #region Consts

    public const theme = [
        'default' => 'default',
        'arrows' => 'arrows',
        'dots' => 'dots',
        'dark' => 'dark',
    ];
    public const animation = [
        'none' => 'none',
        'fade' => 'fade',
        'slide-horizontal' => 'slide-horizontal',
        'slide-vertical' => 'slide-vertical',
        'slide-swing' => 'slide-swing',
    ];
    public const selectedStep = [
        'one' => 0,
        'two' => 1,
        'three' => 2,
        'four' => 3,
        'five' => 4,
    ];
    public const justified = [
        'true' => 'true',
        'false' => 'false',
    ];
    public const speed = [
        '400' => '400',
    ];
    public const     toolbarPosition = [
        'bottom' => 'bottom',
        'none' => 'none',
        'top' => 'top',
        'both' => 'both',
    ];
    public const toolbarButtonPosition = [
        'right' => 'right',
        'left' => 'left',
        'center' => 'center',
    ];
    public const buttonNextText = [
        'next' => 'Next'
    ];
    public const buttonPrevText = [
        'previous' => 'Previous'
    ];
    public const toolbarExtraButtons = [
        'none' => '',
        'btnFinish' => 'btnFinish',
        'btnCancel' => 'btnCancel',
        'btnFinish and btnCancel' => 'btnFinish,btnCancel',
    ];
    public const method = [
        'GET' => 'GET',
        'POST' => 'POST',
    ];
    #endregion

    #region Arrays

    /* public $navLi = [
          ['Tab 1', 'This is tab title', 1],
          ['Tab 2', 'This is tab title', 2],
          ['Tab 3', 'This is tab title', 3],
          ['Tab 4', 'This is tab title', 4],
          ['Tab 5', 'This is tab title', 5],
          ['Tab 6', 'This is tab title', 6],
      ];
      public $tabContentDiv = [
          ['Tab 1 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1],
          ['Tab 2 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2],
          ['asd', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3],
          ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 4],
       ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5],
       ['Tab 4 Content', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
       Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 6],
      ];  */
#endregion

    public $label = [];
    public $_label = [
        'default' => Azl . 'По умолчанию',
    ];
    public $data = [];
    public $_data = [

    ];

    public $event = [];
    public $_event = [
        'gotToStep_change' => '$("#got_to_step").on("change", function() {
                // Go to step
                var step_index = $(this).val() - 1;
                $(\'#smartwizard\').smartWizard("goToStep", step_index);
                return true;
            });',
        'resetbtn_click' => '$("#reset-btn").on("click", function() {
                // Reset wizard
                $(\'#smartwizard\').smartWizard("reset");
                return true;
            });',
        'prevbtn_click' => '$("#prev-btn").on("click", function() {
                // Navigate previous
                $(\'#smartwizard\').smartWizard("prev");
                return true;
            });',
        'nextbtn_click' => '$("#next-btn").on("click", function() {
                // Navigate next
                $(\'#smartwizard\').smartWizard("next");
                return true;
            });',

        'justified_click' => '$("#is_justified").on("click", function() {
                // Change Justify
                var options = {
                  justified: $(this).prop("checked")
                };

                $(\'#smartwizard\').smartWizard("setOptions", options);
                return true;
            });',

        'animation_change' => '$("#animation").on("change", function() {
                // Change theme
                var options = {
                  transition: {
                      animation: $(this).val()
                  },
                };
                $(\'#smartwizard\').smartWizard("setOptions", options);
                return true;
            });',

        'themeSelector_change' => '$("#theme_selector").on("change", function() {
                // Change theme
                var options = {
                  theme: $(this).val()
                };
                $(\'#smartwizard\').smartWizard("setOptions", options);
                return true;
            });',

        'showStep' => '$("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                $("#prev-btn").removeClass(\'disabled\');
                $("#next-btn").removeClass(\'disabled\');
                if(stepPosition === \'first\') {
                    $("#prev-btn").addClass(\'disabled\');
                } else if(stepPosition === \'last\') {
                    $("#next-btn").addClass(\'disabled\');
                } else {
                    $("#prev-btn").removeClass(\'disabled\');
                    $("#next-btn").removeClass(\'disabled\');
                }
            });',
    ];

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                
<!-- SmartTab html -->
<div id="smartwizard">
          
    <ul class="nav" >
        {nav_li}
    </ul>

    <div class="tab-content" >
        {tab_content_div}
    </div>       
                       
</div>

HTML,

        'navLi' => <<<HTML
  <li class="nav-item">
      <a class="nav-link" href="#step-{id}" data-repo="{repo}">
       <span> <strong > {tab_description} </strong> </span> 
      </a>
  </li>
HTML,

        'tabContentDiv' => <<<HTML
<div id="step-{id}" class="tab-pane" role="tabpanel" aria-labelledby="step-{id}">
     
</div>

HTML,

        'css' => <<<CSS
                     
CSS,

        'js' => <<<JS
                    
             $(document).ready(function(){

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Step show event
            {showStep}

            $("#smartwizard").on("stepContent", function(e, anchorObject, stepIndex, stepDirection) {

                var repo    = anchorObject.data('repo');   //console.log('repo:',repo);
                //var ajaxURL = "https://api.npms.io/v2/package/" + repo;
                var ajaxURL = repo;
                // Return a promise object
                return new Promise((resolve, reject) => {

                  // Ajax call to fetch your content
                  $.ajax({
                      method  : "{GET}",
                      url     : ajaxURL,
                      beforeSend: function( xhr ) {
                          // Show the loader
                          $('#smartwizard').smartWizard("loader", "show");
                      }
                  }).done(function( res ) {
                       //console.log(res);

                     //var html = 'Ajax data about ' ;
                     var html =  res.collected.metadata.name;

                      // Resolve the Promise with the tab content
                      resolve(html);

                      // Hide the loader
                      $('#smartwizard').smartWizard("loader", "hide");
                  }).fail(function(err) {

                      // Reject the Promise with error message to show as tab content
                      reject( "An error loading the resource" );

                      // Hide the loader
                      $('#smartwizard').smartWizard("loader", "hide");
                  });

                });
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: {first}, // Initial selected step, 0 = first step
              theme: '{default}', // theme for the wizard, related css need to include for other than default theme
              justified: {true}, // Nav menu justification. true/false
              autoAdjustHeight: false, // Automatically adjust content height
              cycleSteps: false, // Allows to cycle the navigation of steps
              backButtonSupport: true, // Enable the back button support
              enableURLhash: true, // Enable selection of the step based on url hash
              transition: {
                  animation: '{none}', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                  speed: '{400}', // Transion animation speed
                  easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
              },
              toolbarSettings: {
                  toolbarPosition: '{bottom}', // none, top, bottom, both
                  toolbarButtonPosition: '{right}', // left, right, center
                  showNextButton: true, // show/hide a Next button
                  showPreviousButton: true, // show/hide a Previous button
                  toolbarExtraButtons: [{Extrabuttons}] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
              },
              anchorSettings: {
                  anchorClickable: true, // Enable/Disable anchor navigation
                  enableAllAnchors: false, // Activates all anchors clickable all times
                  markDoneStep: true, // Add done css
                  markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                  removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
                  enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
              },
              keyboardSettings: {
                  keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                  keyLeft: [37], // Left key code
                  keyRight: [39] // Right key code
              },
              lang: { // Language variables for button
                  next: '{Next}',
                  previous: '{Previous}'
              },
              disabledSteps: [], // Array Steps disabled
              errorSteps: [], // Highlight step with errors
              hiddenSteps: [] // Hidden steps
            });

            {gotToStep_change}
            {resetbtn_click}
            {prevbtn_click}
            {nextbtn_click}
            {justified_click}
            {animation_change}
            {themeSelector_change}

        });  
         
JS,

    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@5.0.0/dist/css/smart_wizard_all.css');

        $this->fileJs('https://cdn.jsdelivr.net/npm/smartwizard@5.0.0/dist/js/jquery.smartWizard.min.js');
    }

    public function codes()
    {
        $navLi_code = '';
        $tabContentDiv_code = '';
        $i = 1;
        $items = $this->data;
        foreach ($items as $item) {
            $navLi_code .= strtr($this->_layout['navLi'], [
                '{repo}' => $item->url,
                '{tab_description}' => $item->title,
                '{id}' => $i,
            ]);
            $tabContentDiv_code .= strtr($this->_layout['tabContentDiv'], [
                '{id}' => $i,
            ]);
            $i++;
        }

        $this->htm = strtr(
            $this->_layout['item'], [
            '{nav_li}' => $navLi_code,
            '{tab_content_div}' => $tabContentDiv_code,
        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);


        $this->js = strtr($this->_layout['js'], [
            '{first}' => $this->_config['selectedStep'],
            '{default}' => $this->_config['theme'],
            '{true}' => $this->_config['justified'],
            '{none}' => $this->_config['animation'],
            '{400}' => $this->_config['speed'],
            '{bottom}' => $this->_config['toolbarPosition'],
            '{right}' => $this->_config['toolbarButtonPosition'],
            '{Next}' => $this->_config['buttonNextText'],
            '{Previous}' => $this->_config['buttonPrevText'],
            '{Extrabuttons}' => $this->_config['toolbarExtraButtons'],
            '{GET}' => $this->_config['method'],
            '{gotToStep_change}' => $this->eventCode('gotToStep_change'),
            '{resetbtn_click}' => $this->eventCode('resetbtn_click'),
            '{prevbtn_click}' => $this->eventCode('prevbtn_click'),
            '{nextbtn_click}' => $this->eventCode('nextbtn_click'),
            '{justified_click}' => $this->eventCode('justified_click'),
            '{animation_change}' => $this->eventCode('animation_change'),
            '{themeSelector_change}' => $this->eventCode('themeSelector_change'),
            '{showStep}' => $this->eventCode('showStep'),
        ]);

    }
}
