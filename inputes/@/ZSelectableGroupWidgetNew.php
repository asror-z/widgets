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
use function Spatie\SslCertificate\length;

class ZSelectableGroupWidgetNew extends ZWidget
{

    public $config = [];
    public $_config = [

        'contentText' => 'Hello',
        'menuBar' => self::devMenu['hide'],
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const devMenu = [
        'hide' => 'none',
        'show' => 'block'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   
     <div id="wrapper">
            <div id="contain">
            
            <input type="hidden" class="hInput" name="{name}" value="{value}">
             
                     {content}

                <div id="threshold">
                    <div class="threshold"></div>
                    <div class="threshold"></div>
            </div>
        </div>
        </div>
        
        <script src="/render/inputes/ZSelectableGroupWidget/assets/index.js"></script>

HTML,

        'items' => <<<HTML
        
                <div class="box">
                    <!--<input type="hidden" >-->
                    <input type="hidden" data-value="{key}">
                     {item}
                </div>  
        
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
         
         
         /*const selectable = new Selectable({
         toggle: true
});*/
         

         var items = [{selectedItems}];
         
        selectable.select(items);

         var mainInput = $('.hInput');
         
         var array = [];
         
         //var isSelected = 
        
        selectable.on("selecteditem", function(item) {
        
        var selectedKey = item.node.firstElementChild.getAttribute('data-value');
        
        array.push(selectedKey);
        
        mainInput.val(array);

        /*console.log(array)
        
        console.log(mainInput.val())
        */
        
        });
        
        
        selectable.on("deselecteditem", function(item) {
        
       // $(item.node.firstElementChild).removeAttr("value");
       
       array.length = 0;
        mainInput.val("");
        
        /*console.log(item.node.firstElementChild);
        console.log(mainInput);*/
        
        });
         
      })

JS,
    ];

    public function asset()
    {

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.5/dat.gui.min.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/selectable.js@latest/selectable.min.js');
        $this->fileCss('/render/inputes/ZSelectableGroupWidget/assets/main.css');

    }

    public function codes()
    {

        $content = '';

        foreach ($this->data as $key => $value) {
            $content .= strtr($this->_layout['items'], [
                '{item}' => $value,
                //'{value}' => $this->value,

                '{key}' => $key,
            ]);


        }

        $this->htm = strtr($this->_layout['main'], [


            '{value}' => $this->value,
            '{content}' => $content,
            '{name}' => $this->name,
        ]);


        $this->js = strtr($this->_layout['js'], [

            //vdd($this->value),

            '{selectedItems}' => $this->value


        ]);

        $this->css = strtr($this->_layout['css'], [

            '{contentText}' => $this->_config['contentText'],

            '{menuBar}' => $this->_config['menuBar'],

        ]);


    }
}
