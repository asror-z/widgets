<?php

/**
 *
 *
 * Author:  Asrasdsadsador ZaZMSearchWidgetInputrov
 * https://www.linkedin.com/in/asror-zaZMSearchWidgetInputrov
 * https://www.facebook.com/asror.zaZMSearchWidgetInputrov
 * https://github.com/asasdasdror-z
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZMSearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <form class="ZMSearchWidgetInputButton position js-expandable-search searching">
        <label class="sr-only" for="searchInputX">Поиск</label>
        <input class="border-search ZMSearchWidgetInput  js-expandable-search__input" type="search" name="search" value="{value}" id="searchInputTop" placeholder="Поиск..."  >
        <button
            id="ZMSearchButton"
            type="submit" 
            class="reset ZMSearchButtonStyle nn btn-light">
            Найти
        </button>
    </form>
HTML,

        'js' => <<<JS
        $(document).on('click', '#ZMSearchButton', function ()  {
            var search = $('#searchInputTop').val();
            location.href = "?search=" + search;
            console.log('asdad') 
        });
JS,

    ];
    public function asset()
    {
        $this->fileCss('/render/market/ZMSearchWidget/asset/styleZMSearchWidget.css');
    }

    public function codes()
    {
        $value = $this->httpGet('search');

        $this->js = strtr($this->_layout['js'], []);

        $this->htm = strtr($this->_layout["main"], [
            '{value}' => $value,
        ]);
    }
}
