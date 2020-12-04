<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://codyhouse.co/ds/components/app/expandable-search
 *
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
    <form class="js-expandable-search">
        <label class="sr-only" for="searchInputX"></label>
        <input class="reset border-bg js-expandable-search__input" type="search" name="searchInputX" id="searchInputX" placeholder="Поиск...">
<i class="fa fa-search expandable-search-icon"></i>

    </form>
HTML,
        'css' => <<<CSS

.expandable-search-icon{
    position: absolute;
    top: 8px;
    left: 10px;
    color: #0D47A1 !important;
}
.border-bg{
            border: 2px solid #0D47A1 !important;
        }

.js-expandable-search {
    position: relative;
    display: inline-block;
    width: 230px;
}
.js-expandable-search__input {
width: 230px;
height: 35px;
border-radius: 10px;
padding-left: 30px;
color: #0D47A1 !important;
}
.js-expandable-search__input::placeholder {
color: #0b72b8 !important;
}

CSS,

    ];

    public function codes()
    {

        $this->htm = strtr($this ->_layout['main'],[
            

        ]);

        $this->css = strtr($this ->_layout['css'],[]);

    }
}


