<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZGAccordionWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'class' => 'accordion',
        'width' => '100',
        'up' => 'fa fa-angle-right',
        'down' => 'fa fa-angle-down',

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZCollapsesWidget/image/icon.png',
        'name' => Azl . 'Collapses',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZCollapsesWidget/image/icon.png"/>',

    ];

    public function asset()
    {
        $this->fileJs('/render/asrorz/js/jquery.slimscroll.min.js');
    }

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                <div class="{class}">
                    <div class="w-{width}  accordion md-accordion" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true">
                     <div class="card border-0">
                      <div class="d-flex justify-content-between" role="tab">
                         
                         
                       <a class="align-items-center w-100" role="button"  data-toggle="collapse"  href="#accordion-{id}" aria-expanded="true" aria-controls="collapseOne">
                            <div class="row align-items-center card-header p-2 w-100">
                                <div class="col-md-10">
                                    <h5 class="text-green-main">
                                         {title}
                                    </h5>
                                </div>
                                <div class="col-md-2 pr-0 text-right">
                                    <i class="fas fa-angle-right text-green-main"></i>
                                </div>
                            </div>      
                        </a>
                        
                </div>                
                       
                       <div id="accordion-{id}" class="collapse pl-0" role="tabpanel" aria-labelledby="accordion-{id}">
                    <div class="card-body p-0" id="accPanelBody">
                        {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->
        </div>
                </div>
                    
HTML,


        'js' => <<<JS
$(document).ready(function() {
        $('.card').prev('.card-header').addClass('active');
            $('#accordion, #bs-collapse')
            $('.card-header').click(function() {
                
                $(this).find('i').toggleClass('{up}');
               
                $(this).find('i').toggleClass('{down}');
        });
});
         

    
      
          
           
JS,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{width}' => $this->_config['width'],
            '{id}' => $this->id,
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
            '{id}' => $this->id,
            '{up}' => $this->_config['up'],
            '{down}' => $this->_config['down'],
        ]);


    }
}

