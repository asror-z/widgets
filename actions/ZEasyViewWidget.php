<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Jahongir Qudratov
 * Refactored: Asror Zakirov
 */
class ZEasyViewWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'iconColor' => '#0d47a1',
      'size' => '25',
      'type' => ZEasyViewWidget::type['main']
  ];

  public const type = [
      'main' => 'main'

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

  public $layout = [];
  public $_layout = [


      'main' => <<<HTML
        
<div class="speciel_relative mobile ">
      <div class="forPadding">
    <div class="special_box dropdown ">
      
      
        <div class="icon_accessibility dataTooltip" data-toggle="dropdown" data-placement="bottom" title="Special features" aria-expanded="false">
            <a href="#" class="speciel_box mt-2">
                <!--<img src="/render/actions/ZEasyViewWidget/assets/eye.png" alt="">-->
               <!-- <span>Special features</span>--><i class="fas fa-eye specialEye m-b"></i>
            </a>
        </div>
        <div class="dropdown-menu dropdown-menu-right specialViewArea no-propagation  navbar-easy sample" style="padding: 1rem!important;">
            <!--<div class="triangle2"></div>-->

            <div class="appearance">
                        <p class="specialTitle">{view}</p>
        
                        <div class="d-flex justify-content-between">
                            <div class="squareAppearances">
                                <div class="squareBox spcNormal" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Common mode">A</div>
                            </div>
                            
                            <div class="squareAppearances">
                                <div class="squareBox spcWhiteAndBlack" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Black-and-white mode">A</div>
                            </div>
                            
                            <div class="squareAppearances">
                                <div class="squareBox spcDark" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dark mode">A</div>
                            </div>
                        </div>
              </div>

            <div class="appearance">
                            <p class="specialTitle"></p>
                            <div class="block ">
                                <div class="sliderText sampleColor">{incrase} <span class="range sampleColor">0</span>%</div>
                                <div id="fontSizer" class="defaultSlider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 0%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all easybtn" tabindex="0" ></span><div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="width: 0%;"></div></div>
                            </div>
            
                            <p class="specialTitle">{scale}</p>
                            <div class="block">
                                <div class="sliderZoom sampleColor">{incrase} <span class="range sampleColor">0</span>%</div>
                                <div id="zoomSizer" class="defaultSlider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 0%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all easybtn" tabindex="0"></span><div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="width: 0%;"></div></div>
                            </div>

            </div>

            <div class="clearfix"></div>
        </div>
      
      
</div>
    </div>
</div>
HTML,

      'css' => <<<CSS
    .specialEye{
font-size:{size}px;
color: {iconColor};
}
.speciel_relative{
 padding-left: 5px;
 padding-bottom: 5px;
};       

               
/*.easybtn {
    left: 2%!important;
}*/

CSS,
  ];


  /**
   *
   * Constants
   */


  public function asset()
  {
      
    $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
    $this->fileCss('/render/actions/ZEasyViewWidget/assets/SpecialViewstyle.css');

    $this->fileJs('https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.min.js');
    $this->fileJs('/render/actions/ZEasyViewWidget/assets/jquery.cookie.min.js');
    $this->fileJs('/render/actions/ZEasyViewWidget/assets/specialView.min.js');

  }


  public function codes()
  {
    //  $this->htm = \kartik\select2\Select2::widget($this->options);

    $view = Az::l('Посмотреть');
    /*$size = Az::l('Pазмер шрифта');*/
    $indexBy = Az::l('Индексировать по');
    $scale = Az::l('Масштаб');
    $increase = Az::l('Увеличить на');
    if ($this->_config['visible'])
      $this->htm = strtr($this->_layout[$this->_config['type']], [
          '{view}' => $view,
          '{indexBy}' => $indexBy,
          '{scale}' => $scale,
          '{incrase}' => $increase


      ]);

    $this->css = strtr($this->_layout['css'], [
        '{size}' => $this->_config['size'],

    ]);


  }

}
