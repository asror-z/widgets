<?php

/**
 *
 *
 * Author: Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 * created By Xakimjon Ergashov
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\service\utility\Views;
use zetsoft\system\kernels\ZWidget;

class ZSelectableSingleWidget extends ZWidget
{
    
    public $config = [];
    public $_config = [
    
        'contentText' => 'Hello',
        'menuBar'=> self::devMenu['hide'],
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const devMenu =[
        'hide' => 'none',
        'show' => 'block'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   
     <div id="wrapper">
            <div id="contain">
             
                <div class="box">
                    <input type="hidden" name="{name}" value="{value}">
                     {content}
                </div>

                <div id="threshold">
                    <div class="threshold"></div>
                    <div class="threshold"></div>
            </div>
        </div>
        </div>
        
        <script src="/render/inputes/ZSelectableSingleWidget/assets/index.js"></script>

HTML,



        'css' => <<<CSS
    .dg {
    display:{menuBar};
    }
     
          .ui-selected::after {
    content: "{contentText}";
}
.ui-selectable::after {
    content: "{contentText}";
}

.box.ui-selected {
    /*border: 3px solid green;*/
    background-color: green!important;
}

.box.ui-selecting {
    background-color: red;
}

.box.ui-deselecting {
    background-color: #e91e63;
}
     
CSS,

        'js' => <<<JS
        
         $(document).ready(function() {
         var selectedItem = $('.box.ui-selectable').hasClass('ui-selected');

         var items = [{selectedItems}];
        selectable.select(items);
        
        selectable.getSelectedItems();
        

        selectable.on("selecteditem", function(item) {
        
            $(item.node.firstElementChild).val(1);
        
        console.log(item.node.firstElementChild)
        
        });
        
        selectable.on("deselecteditem", function(item) {
        
        $(item.node.firstElementChild).val(0);
        
           console.log(item.node.firstElementChild)
        });
         
      })

JS,
    ];

    public function asset()
    {

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.5/dat.gui.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@latest/selectable.min.js');
        $this->fileCss('/render/inputes/ZSelectableSingleWidget/assets/main.css');
        //$this->fileJs('/render/inputes/ZMobiusSelectableWidget/assets/index.js', Views::position['begin']);

    }

    public function codes()
    {

        


        $this->htm = strtr($this->_layout['main'], [
            //vdd($this->data),
            '{value}' => $this->value,
            '{name}' =>$this->name,
            '{content}' => json_encode($this->data) ,


        ]);

        $this->value--;

        //vdd($this->value);
        $this->js = strtr($this->_layout['js'], [

            '{selectedItems}' => $this->value

        ]);

        $this->css = strtr($this->_layout['css'], [

            '{contentText}' => $this->_config['contentText'],

            '{menuBar}'=>$this->_config['menuBar'],

        ]);

    }
}
