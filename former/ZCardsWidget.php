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


use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

class ZCardsWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'ubunarsa' => ''
    ];
    public $event = [];
    public $_event = [


    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
        <li data-v-605d1001="" class="flex flex-col justify-start text-ink leading-snug lg:px-3 xl:px-5 lg:mt-0 lg:mb-5 mr-6 lg:mr-0 my-3 lg:w-1/2 xl:w-1/2 font-medium cursor-pointer hover:text-fuscia" is-side="true"><a data-v-605d1001="" href="/tidbits/78-iterables-to-array-using-spread/" class="relative items-center  w-40 lg:w-full" aria-label="Read the article for Convert Iterable to Array using Spread in JavaScript"><div data-v-605d1001="" class="shadow-md-dark"><img data-v-067b84ea="" src="https://samanthaming.gumlet.io/tidbits/78-iterables-to-array-using-spread.jpg.gz?format=auto&amp;width=190" alt="Convert Iterable to Array using Spread in JavaScript" class="border border-gray-light w-full"></div></a> <h3 data-v-605d1001="" class="head pt-3">
    {text}
  </h3></li>
HTML,

    ];

    public function codes()
    {

        $code = '';
        foreach ($this->data as $item) {
            $main = strtr($this->_layout['main'], [
                '{text}' => $item
            ]);
            $code .= $main;
        }
        $this->htm = $code;

    }
}
