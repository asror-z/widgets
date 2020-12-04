<?php

namespace zetsoft\widgets\animo;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZJoerezWoahWidget
 * http://demos.krajee.com/widget-details/select2
 * https://github.com/joerez/Woah.css
 * http://www.joerezendes.com/projects/Woah.css/
 * Created By: Asror Zakirov
 * Refactored: Asror Zakirov
 */

class ZZoomWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        
    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [
       
    ];
     public  $layout=[];
     public  $_layout=[

           'main'=><<<HTML
        
<!-- demo start -->
<div class="large-12 column" id="zoomId">
    <div class="tabs-content">
      <div class="content active" id="default">
        <div class="row">
          <div class="large-5 column">
            <div class="xzoom-container">
              <img class="xzoom" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pv.uz%2Fru%2Fnews%2Fprodukty-pitanija-vnov-oblagajutsja-nds&psig=AOvVaw1fUHngYLq6cE5yo8HsrrS3&ust=1589620436977000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIjZ4N3DtekCFQAAAAAdAAAAABAI" xoriginal="images/gallery/original/01_b_car.jpg" style="width: 387px;">
              <div class="xzoom-thumbs">
<!--              <a href="https://payalord.github.io/xZoom/images/gallery/original/01_b_car.jpg"><img class="xzoom-gallery xactive" width="80" src="./demo_files/01_b_car(1).jpg" xpreview="images/gallery/preview/01_b_car.jpg" title="The title goes here"></a>-->
              <a href="https://payalord.github.io/xZoom/images/gallery/original/02_o_car.jpg"><img class="xzoom-gallery" width="80" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pv.uz%2Fru%2Fnews%2Fprodukty-pitanija-vnov-oblagajutsja-nds&psig=AOvVaw1fUHngYLq6cE5yo8HsrrS3&ust=1589620436977000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIjZ4N3DtekCFQAAAAAdAAAAABAI" title="The title goes here"></a>
              <a href="https://payalord.github.io/xZoom/images/gallery/original/03_r_car.jpg"><img class="xzoom-gallery" width="80" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pv.uz%2Fru%2Fnews%2Fprodukty-pitanija-vnov-oblagajutsja-nds&psig=AOvVaw1fUHngYLq6cE5yo8HsrrS3&ust=1589620436977000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIjZ4N3DtekCFQAAAAAdAAAAABAI" title="The title goes here"></a>
              <a href="https://payalord.github.io/xZoom/images/gallery/original/04_g_car.jpg"><img class="xzoom-gallery" width="80" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pv.uz%2Fru%2Fnews%2Fprodukty-pitanija-vnov-oblagajutsja-nds&psig=AOvVaw1fUHngYLq6cE5yo8HsrrS3&ust=1589620436977000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIjZ4N3DtekCFQAAAAAdAAAAABAI" title="The title goes here"></a>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>    
  </div> 
<!-- demo end -->
HTML



     ];

    /**
     *
     * Constants
     */
    

    public function asset()
    {
        $this->fileCss('/D:\Develop\Projects\ALL\asrorz\zetsoft\render\animo\ZZoomJamWidget\assets\css\foundation.css');
        $this->fileCss('https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.css');
        $this->fileJs("https://cdn.jsdelivr.net/npm/xzoom@1.0.14/dist/xzoom.min.js");
        $this->fileJs("https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.js");
        $this->fileJs("/D:\Develop\Projects\ALL\asrorz\zetsoft\render\animo\ZZoomJamWidget\assets\js\setup.js.download");
    }


   


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        $this->htm= strtr($this->_layout["main"],[]);

        $this->js = <<<JS
           
JS;


        $this->css = <<<CSS
         
CSS;


    }

}


