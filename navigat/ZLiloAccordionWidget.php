<?php

namespace zetsoft\widgets\navigat;


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

/**
 *
 * Created By: Nigoraxon G'aniyeva
 * Refactored: Daho
 */
class ZLiloAccordionWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'accordion' => true,
        'openNextOnClose' => false,
        'initFirstActive' => true,
    ];

    public function asset()
    {
        /* $this->fileCss('https://ghcdn.rawgit.org/ricioli/lilo-accordion/master/dist/css/lilo-accordion.min.css');
         $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/material.css');
         $this->fileJs('https://ghcdn.rawgit.org/ricioli/lilo-accordion/master/dist/js/jquery.lilo.accordion.min.js');
         $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/lilo.css');*/


        $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/lilo-accordion.min.css');
        $this->fileCss('/render/navigat/ZLiloAccordionWidget/assets/lilo.css');
        $this->fileJs('/render/navigat/ZLiloAccordionWidget/assets/Accordion/lilo-accordion/jquery.lilo.accordion.min.js');
    }

    public $_layout = [
        'main' => <<<HTML
        <div id="{id}">
            {items}
        </div>
HTML,
        'items' => <<<HTML
        <div class="in-space-lg lilo-accordion-control">
            <span class="text-sm text-secundary in-space-r-md">{stepNumber}</span>{title}
        </div>
        <div class="in-space-h-lg in-space-b-lg lilo-accordion-content">{content}</div>
HTML,

        'js' => <<<JS
    $('#{id}').liloAccordion({
        onlyOneActive: {onlyOneActive},
        initFirstActive: {initFirstActive},
        hideControl: false,
        openNextOnClose: {openNextOnClose},
    });
JS,
    ];

    public function codes()
    {
        $items = '';
        foreach ($this->data as $item) {
            $items .= strtr($this->_layout['items'], [
                '{stepNumber}' => ZArrayHelper::getValue($item, 'stepNumber'),
                '{title}' => ZArrayHelper::getValue($item, 'title'),
                '{content}' => ZArrayHelper::getValue($item, 'content'),
            ]);
        }

        $this->htm = strtr($this->_layout['main'], [
            '{items}' => $items,
            '{id}' => $this->id
        ]);

        $this->js = strtr($this->_layout['js'], [
            '{id}' => $this->id,
            '{onlyOneActive}' => $this->jscode($this->_config['accordion']),
            '{openNextOnClose}' => $this->jscode($this->_config['openNextOnClose']),
            '{initFirstActive}' => $this->jscode($this->_config['initFirstActive']),
        ]);
    }
}
