<?php

namespace zetsoft\widgets\themes;

use phpDocumentor\Reflection\Types\Self_;
use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FAS;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZIcon;
use zetsoft\widgets\navigat\ZBreadCrumbWidget as ZBreadCrumbWidgetAlias;
use zetsoft\widgets\navigat\ZButtonWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * https://mdbootstrap.com/docs/jquery/components/cards/#!
 *
 * Created By: Daho
 *
 * archived by: AzimjonToirov
 */
class ZCardWidget2 extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZCardWidget::type['venCard'],
        'content' => null,
        'begin' => true,
        'height' => 150,
        'padding' => '10px',
        'hasImage' => false,
        'icon' => 'fa fa-chart-pie',
        'hasFooter' => false,
        'color' => '#FFF',
        'headerColor' => ZColor::color['green'],
        'footerColor' => ZColor::color['green'],
        'footerText' => null,
        'url' => '/image/200x200/4.jpg',
        'imageStatus' => ZCardWidget::imageStatus['regular'],
        'buttonUrl' => '#',
        'buttonText' => '#',
        'headerRight' => null,
        'classHeadColor' => 'bg-success',
        'classBorderColor' => 'border-success',
        'classBgColor' => 'light-blue',
        'class' => '',
        'hasTitle' => true,
    ];

    public $layout = [];
    public $_layout = [
        'slim' => <<<HTML
           <div class="pl-5">{content}</div>
HTML,
        'venCard' => <<<HTML
            <div class="card {class}" id="{id}" draggable="true"> 
                <div class="view overlay text-center">   
                    <div class="d-flex mb-3 card-header  {classBgColor} py-0 p-xl-1">
                        <div class="mr-auto p-2 white-text text-center">
                            {cardButton}  {title}
                        </div>  
                        <div class="pr-2 py-2 p-xr-1">
                            <li class="list-inline-item white-text pr-2">{minusButton}</li>
                            <li class="list-inline-item pr-2">{saveButton}</li>
                            <li class="list-inline-item pr-2">{settingButton}</li>
                            <li class="list-inline-item pr-2">{closeButton}</li>
                        </div>
                    </div>  
                </div>
                <div class="card-body" draggable="true">  
                    {content} 
                </div>
            </div>
HTML,
        'mdbCard' => <<<HTML
              <!-- Card -->
                <div class="card card-cascade {color} {imageStatus}" id="{id}">
                    {cardHeader}
                    {cardImage}
                  <!-- Card content -->
                  <div class="card-body card-body-cascade">
                 {content}
                  </div>
                 {cardFooter}
                </div>
        <!-- Card -->
HTML,
        'header' => <<<HTML
             <div class=" card-header {headerColor} white-text p-1 pl-3">
              {title}
            </div>
HTML,
        'image' => <<<HTML
             <!-- Card image -->
              <div class="view overlay view-cascade ">
                <img class="card-img-top" src="{url}" alt="sfd">
                
              </div>
HTML,
        'footer' => <<<HTML
    <div class="card-footer text-muted {footerColor} white-text  p-1 pl-3">
      {footerText}
    </div>
HTML,

        'dynCard' => <<<HTML
       <div class="card {classBorderColor}">
          <div class="view overlay">   
            <div class="card-header text-white {classHeadColor}  p-2">
                   <div class="" ><div class="summary p-0 text-primary"> 
                         {headerRight}</div>
                   </div> 
                   <div class="m-0 text-center">
                       {icon}<b class="{id}-title">{title}</b>
                   </div>            
            </div>
          </div>
        <div class="card-body" id="{id}-card-body">
          {content}        
        </div>
       </div>
HTML,
        'icon' => <<<HTML
            <i class="{icon} {id}-icon"></i> &nbsp;&nbsp;
HTML,

        'css' => <<<CSS

     .card-footer{
        padding-bottom: 0!important;
     }
     .kv-panel-after{
        padding-bottom: 0!important;
     }   
     .{id}-title {
        font-size: 20px;
        font-weight: 500;
     }  
     .{id}-icon {
        font-size: 20px;
     }          
     .card-body{
        padding: {padding} !important;
        min-height: {height}px;
     }

CSS,

    ];

    public const type = [
        'venCard' => 'venCard',
        'mdbCard' => 'mdbCard',
        'dynCard' => 'dynCard',
        'newsCard' => 'newsCard',
        'slim' => 'slim'
    ];

    public const imageStatus = [
        'regular' => 'regular',
        'narrower' => 'narrower',
        'wider' => 'wider',
    ];

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function asset()
    {
        parent::asset();
        $this->fileCss('/render/theme/ZCardWidget/theme/light.css');
    }

    public function codes()
    {

        $content = ob_get_clean() . $this->_config['content'];

        $cardButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'iconSize' => ZButtonWidget::iconSize['2x'],

                'btn' => false,
                'iconColor' => '#fff',
                'icon' => 'fa fa-' . FA::_CHART_BAR,
            ]
        ]);

        $saveButton = ZButtonWidget::widget([
            'config' => [

                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'iconSize' => ZButtonWidget::iconSize['1x'],

                'btn' => false,
                'iconColor' => '#fff',
                'icon' => 'fa fa-' . FA::_SYNC,
            ]
        ]);

        $minusButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'iconSize' => ZButtonWidget::iconSize['1x'],
                'btn' => false,
                'iconColor' => '#fff',
                'icon' => 'fa fa-' . FA::_MINUS,
            ]
        ]);

        $settingButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'iconSize' => ZButtonWidget::iconSize['1x'],
                'btn' => false,
                'iconColor' => '#fff',
                'icon' => 'fa fa-' . FA::_COGS,
            ]
        ]);

        $closeButton = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['none'],
                'btnSize' => ZButtonWidget::btnSize['btn-sm'],
                'btnRounded' => false,
                'btnFloating' => false,
                'iconSize' => ZButtonWidget::iconSize['1x'],
                'btn' => false,
                'iconColor' => '#fff',
                'icon' => 'fa fa-' . FA::_TIMES,
            ]
        ]);

        if (empty($this->_config['title']))
            $this->_config['title'] = $this->getView()->title;

        $cardHeader = (!empty($this->_config['title'])) ? strtr($this->_layout['header'], [
            '{headerColor}' => $this->_config['headerColor'],
            '{title}' => $this->_config['title'],
        ]) : '';

        $cardImage = ($this->_config['hasImage']) ? strtr($this->_layout['image'], [
            '{url}' => $this->_config['url'],
        ]) : '';

        $cardFooter = (!empty($this->_config['footerText'])) ? strtr($this->_layout['footer'], [
            '{footerColor}' => $this->_config['footerColor'],
            '{footerText}' => $this->_config['footerText'],
        ]) : '';

        $getIcon = strtr($this->_layout['icon'], [
            '{id}' => $this->id,
            '{icon}' => $this->_config['icon'],
        ]);

        $this->htm .= strtr($this->_layout[$this->_config['type']], [
            '{class}' => $this->_config['class'],
            '{content}' => $content,
            '{id}' => $this->id,
            '{title}' => $this->_config['title'],
            '{cardButton}' => $cardButton,
            '{saveButton}' => $saveButton,
            '{minusButton}' => $minusButton,
            '{settingButton}' => $settingButton,
            '{closeButton}' => $closeButton,
            '{cardHeader}' => $cardHeader,
            '{cardFooter}' => $cardFooter,
            '{cardImage}' => $cardImage,
            '{color}' => $this->_config['color'],
            '{headerRight}' => $this->_config['headerRight'],
            '{imageStatus}' => $this->_config['imageStatus'],
            '{buttonUrl}' => $this->_config['buttonUrl'],
            '{buttonText}' => $this->_config['buttonText'],
            '{url}' => $this->_config['url'],
            '{icon}' => $this->_config['hasIcon'] ? $getIcon : '',
            '{classHeadColor}' => $this->_config['classHeadColor'],
            '{classBorderColor}' => $this->_config['classBorderColor'],
            '{classBgColor}' => $this->_config['classBgColor'],
            '{dynaCardHeader}' => $this->_config['hasTitle'] ? strtr($this->_layout['dynaCardHeader'], [
                '{id}' => $this->id,
                '{headerColor}' => $this->_config['headerColor'],
                '{title}' => $this->_config['title'],
                '{icon}' => $this->_config['hasIcon'] ? $getIcon : '',
                '{classHeadColor}' => $this->_config['classHeadColor'],
                '{headerRight}' => $this->_config['headerRight'],
            ]) : '',
        ]);


        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->id,
            '{padding}' => $this->_config['padding'],
            '{height}' => $this->_config['height'],
        ]);

    }
}
