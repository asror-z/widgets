<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZGAccordionWidgetAziz extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'class' => 'accordion',
        'width' => '100',

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
                    <div class="w-{width} accordion md-accordion border-0" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true">
                     <div class="card border-0">
                      <div class=" d-flex justify-content-between  border-bottom border-success" role="tab">
                         
                         
                       <a class="text-left row card-header align-items-center w-100" role="button"  data-toggle="collapse"  href="#accordion-{id}" aria-expanded="true" aria-controls="collapseOne">
                              <i class="fas fa-angle-right text-green-main "></i>
                           <h5 class="text-green-main pl-2">
                             {title}
                           </h5>
                                              
                        </a>
                        
                </div>                
                       
                       <div id="accordion-{id}" class="collapse pl-4" role="tabpanel" aria-labelledby="accordion-{id}">
                    <div class="card-body pr-0 border-success" id="accPanelBody">
                        {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->
        </div>
HTML,


        'js' => <<<JS
$(document).ready(function() {
        $('.card').prev('.card-header').addClass('active');
            $('#accordion, #bs-collapse')
            $('.card-header').click(function() {
                
                $(this).find('i').toggleClass('fa fa-angle-right');
               
                $(this).find('i').toggleClass('fa fa-angle-down');
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
        ]);


    }
}

