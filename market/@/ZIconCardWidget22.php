<?php

/*
 * Created By: Xakimjon Ergashov
 * */

namespace zetsoft\widgets\market;


use PhpOffice\PhpWord\Reader\HTML;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use \Dash\Curry;

class ZIconCardWidget22 extends Zwidget
{
    public $config = [];
    public $_config = [
        'expand' => 'expand',
        'cardTitle' => 'IPhone',
        'textContent' => 'Samsung, IPhone, Samsung',
        'cardSubtitle' => 'Phone',
        'srcset'=>''
    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [
        'click' => ' console.log("ZCartReviewWidget | $eventClick") ',
        'dblclick' => ' console.log("ZCartReviewWidget | $eventDblclick") ',
        'mouseenter' => ' console.log("ZCartReviewWidget | $eventMouseEnter") ',
        'mouseleave' => ' console.log("ZCartReviewWidget | $eventMouseLeave") ',
        'keyup' => ' console.log("ZCartReviewWidget | $eventKeyup") ',
        'onload' => 'console.log("ZCartReviewWidget | $eventOnLoad")',
        'onclick' => 'console.log("ZCartReviewWidget | $eventOnClick")',
    ];

    /*
     * Constants
     * */

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'Card' => <<<HTML
    
                    <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-center mt-3">
                                  <div class="card">
                                      <div class="card-body">
                                         
                                         <div class="lazyload" data-expand="{expand}">
                                                <img data-srcset="{srcset} 2048w" class="lazyload"/>
                                         </div>
                                         
                                          <h5 class="card-title text-center">{cardTitle}</h5>
                                          <h6 class="card-subtitle text-center mb-2 text-muted">{cardSubtitle}</h6>
                                          <p class="card-text text-center">{textContent}</p>
                                      </div>
                                  </div>
                    
                              </div>
                              
                          </div>
                    </div>
                    
                            <br>
                            
              

HTML,




        'event' => <<<JS
             $('#{id}')
            .on('click', {click})
            .on('dblclick', {dblclick})
            .on('keyup', {keyup})
            .on('mouseenter', {mouseenter})
            .on('mouseleave', {mouseleave})
            .on('onload',{onload})
            .on('onclick',{onclick}); 
            
JS,


    ];

    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css');
        $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css');
        $this->fileJs('https://cdn.statically.io/gh/aFarkas/lazysizes/gh-pages/plugins/unveilhooks/ls.unveilhooks.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/lazysizes@5.2.1-rc1/lazysizes.min.js');

   
    }

    public function codes()
    {


        $this->htm = strtr($this->_layout['Card'], [
        '{icon}'=>$this->_config['icon'],
        '{cardTitle}'=>$this->_config['cardTitle'],
        '{textContent}'=>$this->_config['textContent'],
        '{cardSubtitle}'=> $this->_config['cardSubtitle'],

        ]);


        $this->js = strtr($this->_layout['event'], [
            '{id}' => $this->id,
            '{click}' => $this->eventCode('click'),
            '{keyup}' => $this->eventCode('keyup'),
            '{dblclick}' => $this->eventCode('dblclick'),
            '{mouseenter}' => $this->eventCode('mouseenter'),
            '{mouseleave}' => $this->eventCode('mouseleave'),
            //  '{options}' => $this->model->properties,
        ]);

    }

}

