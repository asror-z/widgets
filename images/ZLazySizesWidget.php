<?php

namespace zetsoft\widgets\images;

use zetsoft\system\Az;
use zetsoft\widgets\notifier\ZJspanelWidget;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;

class ZLazySizesWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];

    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

    <img data-srcset="{image} 2048w" class="lazyload" />
   
HTML,

'js' => <<<JS
    window.lazySizesConfig = window.lazySizesConfig || {};
    window.lazySizesConfig.srcAttr = 'data-original';
    window.lazySizesConfig.loadMode = 2;  // 1-3   
    window.lazySizesConfig.lazyClass = 'lazyload';
    window.lazySizesConfig.preloadAfterLoad = 'lazypreload';
    window.lazySizesConfig.loadingClass = 'lazyloading';
    window.lazySizesConfig.customMedia = {
    '--small': '(max-width: 480px)',
    '--medium': '(max-width: 900px)',
    '--large': '(max-width: 1400px)',
};
    window.lazySizesConfig.loadedClass = "lazyloaded";
    window.lazySizesConfig.expand = 300-350;  // 300 - 1000
    window.lazySizesConfig.minSize  = 10; 
    window.lazySizesConfig.srcAttr = "data-src";
    window.lazySizesConfig.srcsetAttr = "data-srcset";
    window.lazySizesConfig.sizesAttr = "data-sizes";
    window.lazySizesConfig.loadHidden = false;
    window.lazySizesConfig.ricTimeout = 0; // 0, 100-1000 
    window.lazySizesConfig.throttleDelay = 125;
    window.lazySizesConfig.expFactor = 4; // 1.5 - 4
    window.lazySizesConfig.hFac = 0.8; // 0.8 - 1.4
    window.lazySizesConfig.loadMode = 2; // 0, 1, 2, 3
    window.lazySizesConfig.init = false;


JS,

];

    public function asset()
    {
        /* <script src="https://cdn.jsdelivr.net/npm/lazysizes@5.2.1-rc1/lazysizes.min.js"></script> */
        $this->fileJs('https://cdn.jsdelivr.net/npm/lazysizes@5.2.1-rc1/lazysizes.min.js');

    }

    public function codes()
    {
        foreach ($this->data as $key => $src){
            $this->htm .= strtr($this->_layout['main'],[
            '{image}' => $src,
            ]);
        }
    }
}
