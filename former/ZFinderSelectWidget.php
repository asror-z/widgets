<?php

namespace zetsoft\widgets\former;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use yii\web\JsExpression;


class
ZFinderSelectWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
          'model' => null,
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
         
HTML,

        'js' => <<<JS
        
        var selector = $(document).find('.kv-grid-table tbody');
        var demo5 = $(selector).finderSelect({enableDesktopCtrlDefault:true});

        // Add a hook to the highlight function so that checkboxes in the selection are also checked.
        demo5.finderSelect('addHook','highlight:before', function (event) {
            console.log()
        
            el.find('input').prop('checked', true);
            $(el).closest('.tr-dynawidget').addClass('table-danger');
            
        });

        // Add a hook to the unHighlight function so that checkboxes in the selection are also unchecked.
        demo5.finderSelect('addHook','unHighlight:before', function (event) {
            el.find('input').prop('checked', false);
            $(el).closest('.tr-dynawidget').removeClass('table-danger');
               
        });

        // Prevent Checkboxes from being triggered twice when click on directly.
        demo5.on("click", ":checkbox", function (event){
            e.preventDefault();
        });

        $('.kv-grid-table').find("input[type='radio']");
        // Add Select All functionality to the checkbox in the table header row.
       /* $('.kv-grid-table').find("thead input[type='radio']").change(function () {
            if ($(this).is(':checked')) {
                demo5.finderSelect('highlightAll');
            } else {
                demo5.finderSelect('unHighlightAll');

            }
        }); */
                
        // Add a Safe Zone to show not all child elements have to be active.
        $(".safezone").on("mousedown", function (event){
            return false;
        });






  
JS,

        'css' => <<<CSS
           /*tr.selected {
            background-color: #31f14b;
            color: #FFF;
        }*/
CSS,


    ];
    public function asset()
    {

        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.finderselect/0.6.0/jquery.finderselect.min.js');

    }


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

            ]
        );

        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class']
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);


    }
}
