<?php

/**
 *
 *
 * @author:  Obidov Yasin
 * @license: MurodovMirbosit
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZOnlyForGrapes extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'class' => 'accordion',
        'width' => '100%',
        'bodyClass' => '',

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZCollapsesWidget/image/icon.png',
        'name' => Azl . 'ZOnlyForGrapes',
        'title' => Azl . 'ZOnlyForGrapes',

    ];

    public function asset()
    {
        //$this->fileCss('render/navigat/ZOnlyForGrapes/asset/main.css');
    }
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                    <div class="panel-group wrap" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true" {width}>
                     <div class="panel">
                      <div class="panel-heading panel-title" role="tab">
                       <a class="parent p-2" role="button" data-toggle="collapse" data-parent=".panel-group" href="#accordion-{id}" aria-expanded="true" aria-controls="collapseOne">
                       <i id="gjs-sm-caret" class="fas fa-caret-right">
                        </i>
                           {title}
                        </a>
                </div>
                <div id="accordion-{id}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="accordion-{id}">
                    <div class="panel-body {bodyClass}">
                        {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->
        </div>
HTML,

        'css' => <<<CSS
.fa-caret-right{
    color: #005ecb;
}
.fa-caret-down{
    color: #005ecb;
}

.icon-arrow{
    float: left;
}

.parent:focus,
.parent:hover,
.parent:active {
    outline: 0;
    text-decoration: none;
}

.panel{
    background-color: #f0f0fa;
    transition: 0.4s ease-in-out all;
    font-weight: 400;
    width: 100%;
}

.panel-group .panel + .panel {
    margin-top: 0;
}

.parent{
    background-color: #f0f0fa;
    border-bottom: 0.5px solid #005ecbd6;
}

.parent:hover{
    background-color: #dedef7;
}

.panel-heading {
    background-color: #f0f0fa;
    border: none;
    color: #081F62;
    padding: 0;
}

.panel-title .parent {
    display: block;
    color: #081F62;
    padding: 15px;
    position: relative;
    font-size: 16px;
    font-weight: 400;
}

.panel-body {
    background-color: #FFFFFF;
    font-size: .75rem;
    padding: 10px 5px;
    /*display: flex;*/
    flex-wrap: wrap;
    align-items: flex-end;
    box-sizing: border-box;
    width: 100%;
    transition: all 0.3s ease;
}

.panel-heading .parent:before {

    position: absolute;
    font-family: 'Material Icons',sans-serif;
    right: 5px;
    top: 10px;
    font-size: 24px;
    transition: all 0.5s;
    transform: scale(1);
}

.panel-heading.active .parent:before {

    transition: all 0.5s;
    transform: scale(0);
}

#bs-collapse .panel-heading .parent:after {

    font-size: 24px;
    position: absolute;
    font-family: 'Material Icons',sans-serif;
    right: 5px;
    top: 10px;
    transform: scale(0);
    transition: all 0.5s;
}

#bs-collapse .panel-heading.active .parent:after {

    transform: scale(1);
    transition: all 0.5s;
}

.panel-heading.active .parent:before {
    transform: rotate(2deg);
    transition: all 0.5s;

}

CSS,


        'js' => <<<JS
                   $(document).ready(function() {
                  $('.panel').prev('.panel-heading').addClass('active');
                 $('#accordion, #bs-collapse')
                $('.panel-heading').click(function() {
               $(this).find('i').toggleClass('fas fa-caret-right');
              $(this).find('i').toggleClass('fas fa-caret-down');
        });

});
         
           
          
           
JS,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
            '{bodyClass}' => $this->_config['bodyClass'],
            '{title}' => $this->_config['title'],
            '{width}' => $this->_config['width'],
            '{id}' => $this->id,
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->jscode($this->_config['class']),
            '{id}' => $this->id,
        ]);


    }
}

