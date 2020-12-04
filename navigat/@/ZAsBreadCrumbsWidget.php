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


use Codeception\PHPUnit\ResultPrinter\HTML;
use zetsoft\system\kernels\ZWidget;

class ZAsBreadCrumbsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'grapes' => true,

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <ul class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Document</a></li>
                <li class="breadcrumb-item active"><a href="#">Document</a></li>
                
            </ul>
HTML,

        'js' => <<<JS
            $('.breadcrumb').asBreadcrumbs({
                namespace: 'breadcrumb',
                overflow: "right",
                responsive: true,
                ellipsisText: "&#8230;",
                ellipsisClass: null,
                hiddenClass: 'is-hidden',
                dropdownClass: 'drop',
                dropdownMenuClass: null,
                dropdownItemClass: 'drop',
                dropdownItemDisableClass: 'block',
                toggleClass: null,
                toggleIconClass: 'caret',
                onInit: null,
                onReady: null
            });
JS,
];


        


    public function asset()
    {
        $this->fileCss('https://cdn.jsdelivr.net/npm/jquery-asBreadcrumbs@0.2.3/dist/css/asBreadcrumbs.css');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-asBreadcrumbs@0.2.3/dist/jquery-asBreadcrumbs.js');
    }

    public function codes()
    {
        $this->js .= strtr($this->_layout['js'], [

        ]);
        $this->htm .= strtr($this->_layout['main'], [

        ]);
        
    }
}
//            <li class="breadcrumb-item"><a href="#">{title}</a></li>
//                <li class="breadcrumb-item"><a href="#">Getting Started</a></li>
//                <li class="breadcrumb-item"><a href="#">Library</a></li>
//
//                <li class="breadcrumb-item"><a href="#">Components</a></li>
//                <li class="breadcrumb-item"><a href="#">JavaScript</a></li>
//                <li class="breadcrumb-item"><a href="#">Customize</a></li>
