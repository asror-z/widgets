<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\former;


use zetsoft\system\kernels\ZWidget;

class ZExpandableSearchWidget extends ZWidget
{

    public $config = [];

    public $_config = [
        'grapes' => true,
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <form class="kr js-expandable-search searching">
        <label class="sr-only" for="searchInputX">Поиск</label>
        <input class="border-search ki  js-expandable-search__input" type="search" name="search" value="{value}" id="searchInputTop" placeholder="Поиск..."  >
        <button class="reset ko nn">
            <svg class="icon" viewBox="1 2 22 22">
                <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="2">
                    <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
                    <circle cx="10" cy="10" r="7"></circle>
                </g>
            </svg>
        </button>
    </form>
HTML,

        'css' => <<<CSS
         
CSS,

        'js' => <<<JS
            $(document).on('click', '.nn', function ()  {
            var search = $('#searchInputTop').val();
            location.href = "?search=" + search; 
         });
JS,

    ];

    public function asset()
    {
        $this->fileCss("/render/former/ZExpandableSearchWidget/asset/css/style.css");
    }

    public function codes()
    {
        $value = $this->httpGet('search');

        $this->js = strtr($this->_layout["js"], []);

        $this->css = strtr($this->_layout["css"], []);

        $this->htm = strtr($this->_layout["main"], [
            '{value}' => $value,

        ]);
    }
}


