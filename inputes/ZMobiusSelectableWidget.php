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

use phpDocumentor\Reflection\Types\Self_;
use zetsoft\service\utility\Views;
use zetsoft\system\kernels\ZWidget;

class ZMobiusSelectableWidget extends ZWidget
{
    /**
     * https://iqbalfn.github.io/bootstrap-image-checkbox/#
     * https://github.com/iqbalfn/bootstrap-image-checkbox
     * /core/tester/asror/main.aspx?path=render/inputes/ZBootstrapImgCheckboxWidget/active.php
     */
    public $config = [];
    public $_config = [
        'imgSize' => ZBootstrapImgCheckboxGroupWidgetM::size['4'],
        'ImgClass' => '',
        'InputClass' => '',
        'classContent' => '',
        'content' => '',
        'label' => '',
        'src' => '<img src="/render/inputes/ZBootstrapImgCheckboxWidget/demo/img/annie-spratt.jpg" alt="#" class="img-fluid imgClass">',
        'width' => '100px',
        'height' => '100px',
        'menuBar'=> self::content['show'],
    ];
    public const type = [
        'checkbox' => 'checkbox',
        'radio' => 'radio'
    ];

    public const content =[
             'hide' => 'none',
             'show' => 'block'
    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
   
     <div id="wrapper">
            <div id="container">
             
                <div class="box">
                    <input type="hidden" name="{name}" value="{value}">
                     <!--<p>kl;aksdjkaklsdj</p>-->
                </div>

                <div id="threshold">
                    <div class="threshold"></div>
                    <div class="threshold"></div>
            </div>
        </div>
        
        <script src="/render/inputes/ZMobiusSelectableWidget/assets/index.js"></script>

HTML,

'items' => <<<HTML

        

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
    background-color: gray!important;
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
         

         var items = [{selectedItems}];
        selectable.select(items);
        
        
        $('.box').on('click',function (e){
           
            if ($(e.currentTarget.firstElementChild).val() ==0){
            
             $(e.currentTarget.firstElementChild).val(1);
            
                console.log('alksjdasdjh')
                
            } else {
                $(e.currentTarget.lastElementChild).val(0);
                $(e.currentTarget).removeClass('ui-selected')
               console.log( $(e.currentTarget))
            }

                /*console.log(event.currentTarget.firstElementChild)
                console.log($(e.currentTarget.lastElementChild).val())
               */
            } 

                  );
         
         
         /*const selectable = new Selectable();
         
         selectable.on('end', function (event) {
            
                 if ($(e.currentTarget.lastElementChild).val() ==0){
            
                $(e.currentTarget.lastElementChild).val(1);
            
                console.log(e)
                
               console.log($(e.currentTarget.lastElementChild))
            } else {
                $(e.currentTarget.lastElementChild).val(0);
                
                console.log('value 0 bo`ldi')
            }

                /!*console.log(e)
                console.log($(e.currentTarget.lastElementChild).val())
            
                console.log('alksjdkljaskljdaklsjdkljsakldklj')*!/
              
            });*/
         
         
           /* $('.box').selectable('end',function (e){
           
            if ($(e.currentTarget.lastElementChild).val() ==0){
            
             $(e.currentTarget.lastElementChild).val(1);
            
                console.log('alksjdasdjh')
            } else {
                $(e.currentTarget.lastElementChild).val(0);
            }

               
                
                console.log(event.currentTarget.firstElementChild)
                console.log($(e.currentTarget.lastElementChild).val())
               
            } 

                  );*/
           
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

            '{value}' => $this->value,
            '{name}' =>$this->name

        ]);

        $this->value--;

        //vdd($this->value);
        $this->js = strtr($this->_layout['js'], [

            '{selectedItems}' => $this->value

        ]);

        $this->css = strtr($this->_layout['css'], [

            '{contentText}' => 'lkajsdkljaskjdkljaskjd',
            '{menuBar}'=>$this->_config['menuBar'],

        ]);

    }
}
