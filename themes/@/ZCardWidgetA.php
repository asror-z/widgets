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
 */
class ZCardWidgetA extends ZWidget
{


    public $config = [];
    public $_config = [
        'type' => ZCardWidget::type['venCard'],
        'content' => null,
        'height' => 150,
        'padding' => '10px',
        'hasImage' => false,
        'icon' => 'fa fa-chart-pie',
        'hasFooter' => false,
        'color' => ZColor::color['white'],
        'headerColor' => ZColor::color['green'],
        'footerColor' => ZColor::color['green'],
        'footerText' => null,
        'url' => '/image/200x200/4.jpg',
        'imageStatus' => ZCardWidget::imageStatus['regular'],
        'buttonUrl' => '#',
        'buttonText' => '#',
        'headerRight' => null,
    ];
    public $layout = [];
    public $_layout = [
        'venCard' => <<<HTML
               <div class="card" id="{id}" draggable="true"> 
                  <div class="view overlay text-center">   
                            <div class="d-flex mb-3 card-header light-blue lighten-1 py-0 p-xl-1">
                                <div class="mr-auto p-2 white-text text-center">
                              {cardButton}  {title}
                                </div>  
                        <div class="pr-2 py-2 p-xr-1">
                             <li class="list-inline-item white-text pr-2">
                              {minusButton}</li>
                              
                              <li class="list-inline-item pr-2">
                              {saveButton}</li>
                              
                              <li class="list-inline-item pr-2">{settingButton}</li>
                              
                              <li class="list-inline-item pr-2">
                                  {closeButton}
                              </li>
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
        /*            'newsCard' => <<<HTML
             <div class="card p-3 my-2 {color}">
                <div class="row">

                    <div class="col-md-3 text-center">

                        <img src="{url}">
                    </div>
                    <div class="col-md-9">

                        <div class="card-body">
                            <h5 class="card-title">{title}</h5>
                            <p class="card-text">{content}</p>
                            <a href="{buttonUrl}" class="btn btn-primary float-right">{buttonText}</a>
                        </div>
                    </div>
                </div>
            </div>
        HTML,*/
        'dynCard' => <<<HTML
       <div class="card border-primary">
          <div class="view overlay">   
            <div class="card-header text-white bg-primary p-2">
                   <div class="float-right m-0 p-0" style="margin-top: -4px!important;"><div class="summary mb-4 p-0 text-primary"> 
                         {headerRight}</div>
                  </div> 
                   <div class="m-0">
                       {icon}<b class="{id}-title">{title}</b>
                   </div>            
           </div>
</div>
      <div class="card-body">
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
    ];

    public const imageStatus = [
        'regular' => 'regular',
        'narrower' => 'narrower',
        'wider' => 'wider',
    ];



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

        if(empty($this->_config['title']))
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
            
        ]);


        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->id,
            '{padding}' => $this->_config['padding'],
            '{height}' => $this->_config['height'],
        ]);

    }
}
