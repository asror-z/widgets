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


use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZDynaSearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'dyna' => 'true'
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="d-flex main p-0 m-0">
        <form class="kr js-expandable-search searching p-0 m-0">
            <label class="sr-only" for="searchInputX">Поиск</label>
            <input class="searchInput" type="text" name="search"  id="searchInputTop-{id}" placeholder="Поиск..."  value="{value}">
            <a id="{id}" class="reset px-2 m-0">
           <i class="fal fa-search searchIcon text-muted"></i>
        </a>
        </form>
    </div>
   
HTML,

        'css' => <<<CSS
        
        .main {
            padding: 0;
        }
        
        .searchInput {
            padding: 10px;
            border: 1px solid #eee;
        }
        
        .searchInput:focus {
            border: 1px solid limegreen !important;
        }
            
        .reset {
            padding: 10px;
            border: 1px solid #eee;
        } 
        
        .searchIcon {
            font-size: 20px;
        }
CSS,

        'js' => <<<JS
            var searchBtn = $(document).find('.reset');
            
            $('#{id}').on('click', function ()  {
                console.log('adsasdasd');
                $('#searchInputTop').trigger("change");
                var search = $('#searchInputTop-{id}').val();
                location.href = "?search=" + search;
            });
JS,

    ];

    public function asset()
    {
        $this->fileCss("/render/former/ZDynaSearchWidget/asset/css/style.css");
    }

    public function codes()
    {

        $this->js = strtr($this->_layout["js"], [
            '{id}' => $this->id
        ]);

        $this->css = strtr($this->_layout["css"], []);

        $this->htm = strtr($this->_layout["main"], [
            '{id}' => $this->id,
            '{value}' => ZArrayHelper::getValue($this->httpGet(), 'search')
            
        ]);
    }
}
