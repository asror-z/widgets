<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;

class ZjQuerySmartWizardWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        // 'bgColor' => ZAccLayWidget::bgColor['bg-primary-dark'],
        //'theme_default' => ZjQuerySmartTabWidget::themeSelector['Default'],
        //  'animationNone' => ZjQuerySmartTabWidget::Animations['None'],
        // 'class' => 'accordion',
    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZAccLayWidget/image/icon.png',
        'name' => Azl . 'AccLay',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZAccLayWidget/image/icon.png"/>',

    ];

    public const themeSelector = [
        'Default' => 'Default',
        'Classic' => 'Classic',
        'Dark' => 'Dark',
        'Brick' => 'Brick',
        'Bootstrap Tabs' => 'Bootstrap Tabs',
        'Bootstrap Pills' => 'Bootstrap Pills',
        'No Theme' => 'No Theme',
    ];

    public const Animations = [
        'None' => 'None',
        'Fade' => 'Fade',
        'Slide Horizontal' => 'Slide Horizontal',
        'Slide Vertical' => 'Slide Vertical',
        'Slide Swing' => 'Slide Swing',
    ];

    public $theme = [
        'Default',
        'Classic',
        'Dark',
        'Brick',
        'Bootstrap Tabs',
        'Bootstrap Pills',
        'No Theme',
    ];

    public $animation = [
        'None',
        'Fade',
        'Slide Horizontal',
        'Slide Vertical',
        'Slide Horizontal',
        'Slide Swing',
    ];
    public $layout = [];
    public $_layout = [

        'item' => <<<HTML
            
  <div class="container">
        <!-- External toolbar sample -->
        <div class="row d-flex align-items-center p-3 my-3 text-white-50">
            <div class="col-12 col-lg-6 col-sm-12">
              <label>Theme:</label>
              <select id="theme_selector" class="custom-select col-lg-6 col-sm-12">
                    <option value="default">default</option>
                    <option value="arrows">arrows</option>
                    <option value="circles">circles</option>
                    <option value="dots">dots</option>
              </select>
            </div>
            <div class="col-12 col-lg-6 col-sm-12">
              <label>External Buttons:</label>
              <div class="btn-group col-lg-6 col-sm-12" role="group">
                  <button class="btn btn-secondary" id="prev-btn" type="button">Go Previous</button>
                  <button class="btn btn-secondary" id="next-btn" type="button">Go Next</button>
                  <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
              </div>
            </div>
        </div>

        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Step 1<br /><small>This is step title</small></a></li>
                <li><a href="#step-2">Step 2<br /><small>This is step title</small></a></li>
                <li><a href="#step-3">Step 3<br /><small>This is step title</small></a></li>
                <li><a href="#step-4">Step 4<br /><small>This is step title</small></a></li>
            </ul>

            <div>
                <div id="step-1" class="">
                    <h3 class="border-bottom border-gray pb-2">Step 1 Content</h3>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div id="step-2" class="">
                    <h3 class="border-bottom border-gray pb-2">Step 2 Content</h3>
                    <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
                </div>
                <div id="step-3" class="">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <div id="step-4" class="">
                    <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3>
                    <div class="card">
                        <div class="card-header">My Details</div>
                        <div class="card-block p-0">
                          <table class="table">
                              <tbody>
                                  <tr> <th>Name:</th> <td>Tim Smith</td> </tr>
                                  <tr> <th>Email:</th> <td>example@example.com</td> </tr>
                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
HTML,


        'css' => <<<CSS
            body {
            padding-right: 5%;
            padding-left: 5%;
        }
          #step-1, #step-2, #step-3, #step-4{
           height: auto;
           }

CSS,

        'js' => <<<JS
                    
              $(document).ready(function(){

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

            $("#smartwizard").on("endReset", function() {
              $("#next-btn").removeClass('disabled');
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
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarButtonPosition: 'end',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    }
            });


            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                $("#next-btn").removeClass('disabled');
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
               
JS,
    ];

    public function asset()
    {
        //  $this->fileCss('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_circles.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_arrows.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard_theme_dots.min.css');

        // $this->fileJs('https://code.jquery.com/jquery-3.3.1.min.js');
        // $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js');
        //  $this->fileJs('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/js/jquery.smartWizard.min.js');
    }

    public function codes()
    {
        $this->htm = strtr(
            $this->_layout['item'], [
            // '{class}' => $this->_config['class'],
            // '{animationNone}' => $this->_config['animationNone'],
            // '{theme_default}' => $this->_config['theme_default'],


            // '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);
        //  $this->css = strtr($this->_layout['css'], [

        //  ]);
        $this->js = strtr($this->_layout['js'], [
            //'{class}' => $this->jscode($this->_config['class']),
        ]);


    }
}
