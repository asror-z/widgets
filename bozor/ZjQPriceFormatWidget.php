<?php

/*
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;

class ZjQPriceFormatWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'id' => 'example1',
        'prefix' => 'RS$',
        'centsSeparator' => ',',
        'thousandsSeparator' => '.'

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
   <div class="form-group">
  <input type="text" id="{id}" class="form-control" id="usr">
</div>
         




HTML,
        'jsCode' => <<<JS
         $(function () {

            $('#{id}').priceFormat({
                prefix: '{prefix} ',
                centsSeparator: '{centsSeparator}',
                thousandsSeparator: '{thousandsSeparator}'
            });

        });
JS,
    ];

    public function asset()
    {
        $this->fileJs("https://cdn.jsdelivr.net/npm/jquery-price-format@0.0.1/jquery.priceformat.min.js");
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{id}' => $this->_config['id']

        ]);
        $this->js = strtr($this->_layout['jsCode'], [
            '{id}' => $this->_config['id'],
            '{prefix}' => $this->_config['prefix'],
            '{centsSeparator}' => $this->_config['centsSeparator'],
            '{thousandsSeparator}' => $this->_config['thousandsSeparator']

        ]);
    }
}
