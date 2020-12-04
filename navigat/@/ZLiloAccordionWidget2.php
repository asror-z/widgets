<?php

namespace zetsoft\widgets\navigat;


use zetsoft\models\drag\DragForm;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */
class ZLiloAccordionWidget2 extends ZWidget
{
    public $dbType = dbTypeJsonb;


    public $config = [];
    public $_config = [
        'title' => 'ZLiloAccordion',
        'text' => '',
        'content' => '',

    ];

    public $layout = [];
    public $_layout = [

    'main' => <<<HTML
 <div class="how-to-use-accordion">
 <div class="in-space-lg lilo-accordion-control">
            <img src="/render/navigat/ZLiloAccordionWidget/assets/arrow.svg" class="icon-arrow" alt="icon-arrow">
            </div>
         <div class="in-space-h-lg in-space-b-lg lilo-accordion-content"></div>
         </div>
HTML,

    'js' => <<<JS
     $('.lilo-accordion-control').liloAccordion();
 $('.zlilo').liloAccordion({
      onlyOneActive: false,
      initFirstActive: false,
      hideControl: false,
      openNextOnClose: false,
    });

JS,

    'css' => <<<CSS
.lilo-accordion-control {
 background-color: #42a5f5;
  cursor: pointer;
}
.lilo-accordion-content {
  display: none;
}
.icon-arrow{
float: left;
}
CSS,

    ];

    public function asset()
    {
        $this->fileCss("https://ghcdn.rawgit.org/ricioli/lilo-accordion/master/dist/css/lilo-accordion.min.css");
        $this->fileCss("/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/material.css");
        $this->fileJs('https://ghcdn.rawgit.org/ricioli/lilo-accordion/master/dist/js/jquery.lilo.accordion.min.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'],[
            '{title}' => $this->_config['title'],
            '{content}' => $this->_config['content'],
        ]);

        $this->js = strtr($this->_layout['js'],[

        ]);

        $this->css = strtr($this->_layout['css'],[

        ]);
    }
}
