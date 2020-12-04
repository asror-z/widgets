<?php

/**
 *
 *
 * @author: SherzodMangliyev
 * @license:
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZOnlyForVveb extends ZWidget
{
    public $config = [];
    public $_config = [
        'textColor' => '',
        'content' => '',
        'title' => '',
        'class' => 'accordion',
        'width' => '100%',
        'bodyClass' => '',
        'dataSection' => ''

    ];
    public static $grapes = [
        'enable' => true,
        'icon' => '',
        'image' => '/render/navigat/ZCollapsesWidget/image/icon.png',
        'name' => Azl . 'ZOnlyForGrapes',
        'title' => Azl . 'ZOnlyForGrapes',

    ];


    public $layout = [];
    public $_layout = [
        'item' => <<<HTML
                    
                <li class="header clearfix" data-section="{dataSection}"  data-search="">
           <label class="header" for="leftpanel_comphead_{id}">
              {title}  
              <div class="header-arrow"></div>
           </label>
           <input class="header_check" type="checkbox" checked="true" id="leftpanel_comphead_{id}">  
           <ol>
           {content}
           </ol>
        </li>
HTML,


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
            '{dataSection}' => $this->_config['dataSection']
        ]);


    }
}

