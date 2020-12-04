<?php

namespace zetsoft\widgets\navigat;


use zetsoft\models\drag\DragForm;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;

/**
 * @author MurodovMirbosit
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 */
class ZMarketDropdownWidget extends ZWidget
{
    public $dbType = dbTypeJsonb;


    public $config = [];
    public $_config = [
        'title' => 'ZMarketDropdowns',
        'text' => '',
        'content' => '',
        'onlyOneActive' => false,
        'initFirstActive' => false,
        'hideControl' => true,
        'openNextOnClose' => true
    ];

    public $layout = [];
    public $_layout = [

    'main' => <<<HTML
    <div class="zlilo" id="{id}">
    
        <div class="lilo-accordion-control active">
                {title}
        </div>
            
        <div class="lilo-accordion-content col-md-12">
            <div class="{class}">
                {content}
            </div>
        </div>
        
    </div>
HTML,

    'js' => <<<JS
        $('#{id}').liloAccordion({
          onlyOneActive: '{onlyOneActive}',
          initFirstActive: '{initFirstActive}',
          hideControl: '{hideControl}',
          openNextOnClose: '{openNextOnClose}',
        });

JS,

    ];

    public function asset()
    {
        $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/lilo-accordion.min.css');
        $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/lilo.css');
        $this->fileJs('/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/jquery.lilo.accordion.min.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'],[
            '{title}' => $this->_config['title'],
            '{content}' => $this->_config['content'],
            '{id}' => $this->id,
            '{class}' => $this->_config['class'],
        ]);

        $this->js = strtr($this->_layout['js'],[
           '{id}' => $this->id,
           '{onlyOneActive}' => $this->_config['onlyOneActive'],
           '{initFirstActive}' => $this->_config['initFirstActive'],
           '{hideControl}' => $this->_config['hideControl'],
           '{openNextOnClose}' => $this->_config['openNextOnClose']
        ]);

    }
}
