<?php

/**
 *
 *
 * Author:  AzimjonToirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\images;

use zetsoft\system\kernels\ZWidget;


/**
 * Class    ZIconPickerWidget
 * @package zetsoft\widgets\inputes
 *
 *
 */
class ZLazyloadImgWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'class' => 'branwdo',
    ];


    /**
     *
     * Constants
     */
    public const type = [

    ];


    public $event = [];
    public $_event = [

    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                <ul class="ul-block {class}">
                             <li>
                                    <img class="lazyload" data-src="{image}" width="355" height="280"/>
                            </li>
       
                 </ul>
                 
                
HTML,


        'js' => <<<JS
            lazyload();
        let images = document.querySelectorAll(".{class}");
        new LazyLoad(images, {
            root: null,
            rootMargin: "0px",
            threshold: 0
        });
                
        
JS,

        'style' => <<<CSS
          .ul-block li {
                display: block;
            }
            
          

CSS,

    ];

    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js');
    }

    public function codes()
    {

        foreach ($this->data as $key => $src) {

            $this->htm .= strtr($this->_layout['main'], [

                '{image}' => $src,

            ]);
        }
        $this->js = strtr($this->_layout['js'], [
            '{class}' => $this->_config['class'],


        ]);
        $this->css = strtr($this->_layout['style'], []);

    }


}
