<?php

/**
 *
 *
 * Author:  Obidov Yasin
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZMDBAccordionWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'class' => 'accordion',
        'width' => '100%',

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZCollapsesWidget/image/icon.png',
        'name' => Azl . 'Collapses',
        'title' => Azl . '<b>safasfsa</b><img src="/render/navigat/ZCollapsesWidget/image/icon.png"/>',

    ];
    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                    <div class="panel-group wrap" id="accordion-wrap-{id}" role="tablist" aria-multiselectable="true" {width}>
                     <div class="panel">
                      <div class="panel-heading panel-title" role="tab">
                       <a class="parent text-left" role="button" data-toggle="collapse" data-parent=".panel-group" href="#accordion-{id}" aria-expanded="true" aria-controls="collapseOne">
                        {title}
                          
                          <i id="gjs-sm-caret" class="fa fa-angle-right arrowfa"></i>
                          
                        </a>
                </div>
                <div id="accordion-{id}" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="accordion-{id}">
                    <div class="panel-body" id="accPanelBody">
                        {content}
                    </div>
                </div>
            </div>
            <!-- end of panel -->
        </div>
HTML,
    ];


    public function codes()
    {
        $this->htm = strtr($this->_layout['item'], [
            '{class}' => $this->_config['class'],
            '{content}' => $this->_config['content'],
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

