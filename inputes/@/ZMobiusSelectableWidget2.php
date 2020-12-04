<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\service\utility\Views;
use zetsoft\system\kernels\ZWidget;

class ZMobiusSelectableWidget2 extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
<div id="wrapper">
  <div id="container">
       <div class="box"></div>
       <div id="threshold"></div>
  </div>
    <!-- <input type="hidden" value="{value}" name="{name}" id="{id}">-->
</div>

        <script src="/render/inputes/ZMobiusSelectableWidget/assets/index.js"></script>
HTML,

        'css' => <<<CSS
     
CSS,

        'js' => <<<JS

/*const selectable = new Selectable();

            selectable.on('end', function() {
            
                console.log('alksjdkljaskljdaklsjdkljsakldklj')
              
            });*/
        
         $(document).ready(function() {
         
         
            $('.box').select(function (event) {
                
            if ($(e.currentTarget.lastElementChild).val() ==0){
            
             $(e.currentTarget.lastElementChild).val(1);
            
                console.log('alksjdasdjh')
            } else {
                $(e.currentTarget.lastElementChild).val(0);
            }

               
                
                console.log(event.currentTarget.firstElementChild)
                console.log($(e.currentTarget.lastElementChild).val())
               
            } 

                  );
           
         })

JS,
    ];

    public function asset()
    {

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.5/dat.gui.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@latest/selectable.min.js');
        $this->fileCss('/render/inputes/ZMobiusSelectableWidget/assets/main.css');
        //$this->fileJs('/render/inputes/ZMobiusSelectableWidget/assets/index.js', Views::position['begin']);

    }

    public function codes()
    {


        $this->htm = strtr($this->_layout['main'], [
            /*'{value}' => $this->value,
            '{name}' => $this->name,
            '{id}' => $this->id,*/
        ]);
        $this->js = strtr($this->_layout['js'], []);

    }
}
