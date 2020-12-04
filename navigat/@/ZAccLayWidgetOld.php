<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\kernels\ZWidget;

class ZAccLayWidgetOld extends ZWidget
{
    public $config = [];
    public $_config = [
        'bgColor' => ZAccLayWidgetOld::bgColor['bg-primary-dark'],
        'textColor' => '',
        'text' => '',
        'name' => '',
        'icon' => ''
    ];
    public const bgColor = [
        'bg-primary' => 'bg-primary',
        'bg-primary-dark' => 'bg-primary-dark',
        'bg-secondary' => 'bg-secondary',
        'bg-success' => 'bg-success',
        'bg-danger' => 'bg-danger',
        'bg-warning' => 'bg-warning',
        'bg-info' => 'bg-info',
        'bg-light' => 'bg-light',
        'bg-dark' => 'bg-dark',
        'bg-white' => 'bg-white'
    ];

    public const textColor = [
        'text-primary' => 'text-primary',
        'text-secondary' => 'text-secondary',
        'text-success' => 'text-success',
        'text-danger' => 'text-danger',
        'text-warning' => 'text-warning',
        'text-info' => 'text-info',
        'text-light' => 'text-light',
        'text-dark' => 'text-dark',
        'text-white' => 'text-white'
    ];

    public function codes()
    {
        $this->layout = [
            'item' => <<<HTML
             <div class="accordionItem closed "> 
                <div class="accordionItemHeading {bgColor} ">
                    <span class="mr-2 "><i class="{icon}"></i></span>
                    {name}
                    <i class="fas fa-plus float-right"></i>
                </div>
                <div class="accordionItemContent">
                    <div class="{textColor}">
                        {text}  
                    </div>
                </div>
            </div>
HTML,
        ];

        $this->htm = strtr($this->layout['item'], [
            '{text}' => $this->_config['text'],
            '{name}' => $this->_config['name'],
            '{icon}' => $this->_config['icon'],
            '{bgColor}' => $this->_config['bgColor'],
            '{textColor}' => $this->_config['textColor'],
        ]);

        $this->css = <<<CSS
    .accordionWrapper{
        padding: 30px;
        background: #fff;
        float: left;
        width: 80%;
        box-sizing: border-box;
        margin: 10%;    
    }
    .accordionItem{
        float: left;
        display: block;
        width: 100%;
        box-sizing: border-box;
    }
    .accordionItemHeading{
        cursor: pointer;
        margin: 0 0 10px 0;
        padding: 10px;
        background: #125188;
        color: #fff;
        width: 100%;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .closed .accordionItemContent{
        height:0px;
        transition:height 1s ease-out;
        -webkit-transform: scaleY(0);
        -o-transform: scaleY(0);
        -ms-transform: scaleY(0);
        transform: scaleY(0);
        float: left;
        display: block;
    }
    .opened .accordionItemContent{
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        width: 100%;
        margin: 0px 0px 10px 0px;
        display:block;
        -webkit-transform: scaleY(1);
        -o-transform: scaleY(1);
        -ms-transform: scaleY(1);
        transform: scaleY(1);
        -webkit-transform-origin: top;
        -o-transform-origin: top;
        -ms-transform-origin: top;
        transform-origin: top;

        -webkit-transition: -webkit-transform 0.4s ease-out;
        -o-transition: -o-transform 0.4s ease;
        -ms-transition: -ms-transform 0.4s ease;
        transition: transform 0.4s ease;
        box-sizing: border-box;
    }
    .opened .accordionItemHeading{
        margin: 0;
        -webkit-border-radius: 3px 3px 0px 0px;
        -moz-border-radius: 3px 3px 0px 0px;
        border-radius: 3px 3px 0px 0px;
    }
   
    /*.accordionItemHeading.active:after {
        content: "-";
    }
    .accordionItemHeading:after {
        content: "+";
        color: #fff;
        float: right;
        margin-left: 5px;
        font-size: 17px;
    }*/
CSS;
        $this->js = <<<JS
        var accItem = document.getElementsByClassName('accordionItem');
        var accHD = document.getElementsByClassName('accordionItemHeading');
        var plus = document.getElementsByClassName('fas');
        
        for (i = 0; i < accHD.length; i++) {
            accHD[i].addEventListener('click', toggleItem, false,);
        }
        /*$(".accordionItem").click(function(){
               $(".fas").removeClass("fa-minus");
  	            $(this).toggleClass('fa-minus');
        };
        */
        function toggleItem() {
            var itemClass = this.parentNode.className;
            for (i = 0; i < accItem.length; i++) {
                accItem[i].className = 'accordionItem closed';
            }
            if (itemClass === 'accordionItem closed') {
                this.parentNode.className = 'accordionItem opened';
            }
        }
        
  

       
JS;
    }
}
