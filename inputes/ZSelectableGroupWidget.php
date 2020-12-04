<?php

/**
 * created By Xakimjon Ergashov
 * https://codepen.io/Mobius1/pen/qRxaqQ/
 * https://mobius1.github.io/Selectable/
 */

namespace zetsoft\widgets\inputes;

use zetsoft\service\utility\Views;
use zetsoft\system\assets\ZColor;
use zetsoft\system\kernels\ZWidget;
use function Spatie\SslCertificate\length;

class ZSelectableGroupWidget extends ZWidget
{

    public $config = [];
    public $_config = [

        'contentText' => 'Hello',
        'menuBar' => self::devMenu['hide'],
        'boxColor' => ZColor::color['white'],
        'selectedColor' => ZColor::color['white'],
        'borderColor' => ZColor::color['main-green']
        
    ];
    /*public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];*/

    public const devMenu = [
        'hide' => 'none',
        'show' => 'block'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   
     <!--<div id="wrapper">-->
            <div id="contain">

                     {content}

                <!--<div id="threshold">
                    <div class="threshold"></div>
                    <div class="threshold"></div>
                </div>-->
        </div>
        <!--</div>-->
        
        <script src="/render/inputes/ZSelectableGroupWidget/assets/index.js"></script>

HTML,

        'items' => <<<HTML
        
                <div class="box">
                    <input type="hidden" name="{name}[]" data-value="{key}">
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
    border: 3px solid {borderColor};
    background-color: {selectedColor}!important;
}

.box.ui-selecting {
    background-color: red;
}

.box.ui-deselecting {
    background-color: #e91e63;
}

.box{
    background-color: {boxColor}!important;
}
     
CSS,



        'js' => <<<JS
        
     $(document).ready(function() {
     
     
     /*const selectable = new Selectable({
     
     autoScroll: {
        increment: null,
        threshold: null
    }
    })*/
             
         var items = [{selectedItems}];
         
         selectable.select(items);

         selectable.on("selecteditem", function(item) {

            var mySelectable = item.node.firstElementChild;
            //console.log(mySelectable)
            
            var selectedKey = mySelectable.getAttribute('data-value');
            
            $(mySelectable).val(selectedKey);
        
            //console.log($(mySelectable).val())

        });
        
        
        selectable.on("deselecteditem", function(item) {
            $(item.node.firstElementChild).val('')
            
            //console.log( $(item.node.firstElementChild).val())

        });
        
     });
        

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
                '{name}' => $this->name,
                '{key}' => $key,
            ]);


        }

        $this->htm = strtr($this->_layout['main'], [

            '{content}' => $content,

        ]);

        if (!empty($this->value) || $this->value !== null){
            $myVal = $this->value;
        }else{
            $myVal = [""];
        }

        //vdd($myVal);





        foreach ($myVal as $key => $val) {

            if ($val == "")
                $val = null;

            $this->js .= strtr($this->_layout['js'], [

                '{selectedItems}' => $val
            ]);

        }


        $this->css = strtr($this->_layout['css'], [

            '{contentText}' => $this->_config['contentText'],

            '{menuBar}' => $this->_config['menuBar'],

            '{selectedColor}' => $this->_config['selectedColor'],
            '{borderColor}' => $this->_config['borderColor'],
            '{boxColor}' => $this->_config['boxColor']

        ]);


    }
}
