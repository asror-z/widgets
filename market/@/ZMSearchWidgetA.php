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

class ZMSearchWidgetA extends ZWidget
{

    public $config = [];
    public $_config = [
    ];
    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
   
               <div class="container" id="ZMSearchButton">
                    <div class="row mt-4">
                        <div class="col-md-6 offset-3"> 
                             <div class="form form-css">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-secondary" >search</button>
                                  </div>
                                  <input type="search" value="{value}" id="searchInputTop">
                             </div>
                        </div>
                    </div>
               </div>
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
