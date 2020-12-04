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

class ZTopSearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <form class="kr js-expandable-search searching">
        <label class="sr-only" for="searchInputX">Поиск</label>
        <input class="border-search ki  js-expandable-search__input" type="search" name="search" value="{value}" id="searchInputTop" placeholder="Поиск..."  >
        <button class="reset-ko ko nn">
            <!--<svg class="icon" viewBox="1 2 22 22">
                <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="2">
                    <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
                    <circle cx="10" cy="10" r="7"></circle>
                </g>
            </svg>-->
            <i class="fal fa-search fa-1x mb-1"></i>
        </button>
    </form>
HTML,

        'css' => <<<CSS
         .searching{

float: left !important;

}
:root {
    --space-unit: 1em;
}
.icon{
    color: #669BF3 !important;
    
}
.border-search{
 border: 2px solid #669BF3 !important;
}

.border-search{
border-radius: 20px;
height: 60px;
padding-left: 8px;
width: 60%;

}
.kr {
    
    position: relative;
    display: inline-block;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-top: 0;
    margin-right: 6px !important;
    background-color: white !important; 
}

.ki {
    width: 2.2em !important;
    height: 2.2em!important;
    padding: 0;
    border: none;
    color: transparent;
     
    border-radius: 50em;
    transition: width .3s cubic-bezier(.215, .61, .355, 1), box-shadow .3s, background-color .3s;
}

.ki::-webkit-input-placeholder {
    color: transparent
}

.ki::-moz-placeholder {
    opacity: 0;
    color: transparent
}

.ki:-ms-input-placeholder {
    color: transparent
}

.ki:-moz-placeholder {
    color: transparent
}

.ki:hover {
    background-color: #f2f2f2;
    cursor: pointer
}

.ki:focus, .ki.ks {
    background-color: #fff;
    width: 20em !important;
    padding: 0 2.4em 0 0.75em;
    outline: none;
    color: #c0c0c0;
    cursor: auto;
    -webkit-user-select: auto;
    -moz-user-select: auto;
    -ms-user-select: auto;
    user-select: auto
}

.ki:focus::-webkit-input-placeholder, .ki.ks::-webkit-input-placeholder {
    color: #79797c;
}

.ki:focus::-moz-placeholder, .ki.ks::-moz-placeholder {
    opacity: 1;
    color: #79797c;
}

.ki:focus:-ms-input-placeholder, .ki.ks:-ms-input-placeholder {
    color: #79797c;
}

.ki:focus:-moz-placeholder, .ki.ks:-moz-placeholder {
    color: #79797c;
}

.ki:focus + .ko {
    pointer-events: auto;
}

.ki::-webkit-search-decoration, .ki::-webkit-search-cancel-button, .ki::-webkit-search-results-button, .ki::-webkit-search-results-decoration {
    display: none;
}

.ko {
    position: absolute;
    top: 2px;
    right: 2px;                    
    height: calc(2.2em - 4px);
    width: calc(2.2em - 4px);
    border-radius: 50%;
    border: none;
    z-index: 1;
    pointer-events: none;
    transition: background-color .3s;
    background-color: #fff;
}

CSS,

        'js' => <<<JS
            $(document).on('click', '.nn', function ()  {
            var search = $('#searchInputTop').val();
            location.href = "?search=" + search; 
         });
JS,

    ];

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
