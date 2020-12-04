<?php

namespace zetsoft\widgets\yandex;

use zetsoft\system\kernels\ZWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
class ZFeatureWidget extends ZWidget
{


    public $config = [

    ];
    public $_config = [
      'data' => [],
    ];


    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
      <div class="container">
    <div class="row pt-5 pb-4 pl-2 ">
        <div class="col-md-12">
            <h3>Подробные характеристики</h3>
        </div>
    </div>
    <hr class="w-75 pl-0 ml-0">
    <div class="row pt-4">
        <div class="col-md-12">
            <table class="table table-borderless ">
                <tbody>
                     {items}
                </tbody>
            </table>
        </div>
      
               
     
    </div>
</div>
HTML,
        'css' => <<<CSS
         .tabs:after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            z-index: -1;
            margin-top: 0;
            bottom: 12px;
            height: 1px;
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAABCAAAAAA+i0toAAAAAnRSTlMA/1uRIrUAAAAMSURBVHheY7j1/z8ABY8C2UtBe8oAAAAASUVORK5CYII=) 0 0 repeat-x;
        }

        .lineh{
            line-height: 10px !important;
        }
CSS,
        'jscode' => <<<JS

JS,

        'tabval' => <<<HTML
                <tr class="lineh">
                    <td class="pl-0 ml-0 pb-0 tabs position-relative"><span class="bg-white pr-2">{item1}</span></td>
                    <td class="pl-0 ml-0 pl-2">{item2}</td>
                </tr>
               
HTML,





    ];

    public function asset()
    {

    }

    public function codes()
    {
        $items = '';
        foreach ($this->_config['data'] as $key => $val) {
              $items .= strtr($this->_layout['tabval'], [
                  '{item1}' => $key,
                  '{item2}' => $val
              ]);

        }

        $this->htm = strtr($this->_layout['main'], [
            '{items}' => $items,
        ]);
        $this->css = strtr($this->_layout['css'], [

        ]);

    }
}
