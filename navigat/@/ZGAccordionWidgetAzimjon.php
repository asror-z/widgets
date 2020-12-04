<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZIconPickerWidget;

class ZGAccordionWidgetAzimjon extends ZWidget
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
        'theme' => ZGAccordionWidgetAzimjon::themes['classic']

    ];

    const themes = [
        'classic' => 'classic',
        'dark' => 'dark'
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
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.shorten@1.0.0/src/jquery.shorten.js');
    }

    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                    
             <div class="w-{width} {class} accordion md-accordion" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true">
                 <div class="card pb-2">
                      <div class="d-flex justify-content-between darkTheme" role="tab">
                      
                      
                          <!-- item nameOn -->
                          
                           <a class="align-items-center w-100 collapsed" role="button"  data-toggle="collapse"  href="#accordion-{id}" aria-expanded="false" aria-controls="accordion-{id}">
                                <div class="row align-items-center card-header p-2 w-100">
                                    <div class="col-md-10">
                                        <div class="text-dark">
                                             {title}
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-0 text-right">
                                        <i class="fas fa-angle-down green-text-color"></i>
                                    </div>
                                     
                                </div>      
                            </a>
                            
                            <!-- item nameOn end -->
                            
                            
                      </div>                
                        <!-- content -->
                       
                           <div id="accordion-{id}" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-{id}">

                                <div class="card-body p-0" id="accPanelBody">
                                    {content}
                                </div>

                           </div>
                       
                       <!-- end content -->
                </div>
            <!-- end of panel -->
        </div>
HTML,


        'js' => <<<JS
        $(document).ready(function() {
            $('.card-header').click(function() {
                
                $(this).find('i').toggleClass('{up}');
               
                $(this).find('i').toggleClass('{down}');
                
                
            });
        });
        
        $("#accPanelBody").shorten({
            "showChars": "100",
            "moreText"	: "See More",
            "lessText"	: "Less",
            "ellipsesText": "<div>asdasd</div>"
        });
JS,

        'dark' => <<<CSS
         .darkTheme {
            background-color: #dcdcdc;
            color: white;
         }
       
CSS,

    ];


    public function codes()
    {

        $this->htm = strtr($this->_layout['item'], [
            '{id}' => $this->id,
            '{class}' => $this->_config['class'],
            '{title}' => $this->_config['title'],
            '{width}' => $this->_config['width'],
            '{content}' => $this->_config['content'],
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
            '{id}' => $this->id,
            '{up}' => $this->_config['up'],
            '{down}' => $this->_config['down'],
        ]);


        
            if ($this->_config['theme'] == self::themes['dark']){
                $this->css = strtr($this->_layout['dark'], [

                ]);
            }else {
                $this->css = '';
            }

    }
}

