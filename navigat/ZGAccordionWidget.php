<?php

/**
 *
 *
 * @author:  Obidov Yasin
 * @license: MurodovMirbosit
 *
 */

namespace zetsoft\widgets\navigat;


use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\kernels\ZWidget;

class ZGAccordionWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'show' => true,
        'class' => 'accordion',
        'width' => '100',
        'up' => 'fa fa-angle-right',
        'down' => 'fa fa-angle-down',
        'theme' => ZGAccordionWidget::themes['classic']

    ];

    const themes = [
        'classic' => 'classic',
        'dark' => 'dark'
    ];

    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZGAccordionWidget/image/icon.png',
        'name' => Azl . 'ZGAccordionWidget',
        'title' => Azl . 'ZGAccordionWidget',

    ];

    public function asset()
    {
        $this->fileJs('/render/asrorz/js/jquery.slimscroll.min.js');
        $this->fileJs('https://cdn.statically.io/gh/mfarid/readmore-readless/master/js/jquery.readmore-readless.js');
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
                       
                           <div id="accordion-{id}" class="collapse pl-0 {show}" role="tabpanel" aria-labelledby="accordion-{id}">
                           
                                <div class="card-body p-0 accPanelBody" id="accPanelBody">
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
        $show = $this->_config['show'] ? 'show' : '';
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{title}' => $this->_config['title'],
            '{width}' => $this->_config['width'],
            '{id}' => $this->id,
            '{show}' => $show
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

