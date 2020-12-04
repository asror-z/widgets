<?php

namespace zetsoft\widgets\incores;

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use function GuzzleHttp\Psr7\str;
use zetsoft\system\kernels\ZWidget;
use kartik\widgets\Select2;
use yii\web\JsExpression;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: Sunnat Ermatov
 * Refactored: Sunnat Ermatov
 */

class ZLazyLoadingWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

    ];


    /**
     *
     * Plugin Events
     * https://select2.org/programmatic-control/events
     */
    public $event = [];
    public $_event = [

    ];


    /**
     *
     * Constants
     */
    public const theme = [
        'default' => 'default',
        'classic' => 'classic',
        'bootstrap' => 'bootstrap',
        'krajee' => 'krajee',
        'krajee-bs4' => 'krajee-bs4',
    ];

    public const size = [
        'lg' => 'lg',
        'md' => 'md',
        'sm' => 'sm'
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanilla-lazyload@13.0.1/dist/lazyload.js');
    }


    public $layout = [];
    public $_layout = [

     'htm'=>  <<<HTML
        <div class="container">
<div id="results1" class="results">
    <ul>
        <li>
            <p>1. Visible and eagerly loaded</p>
            <a href="#1"
            ><img
                    alt="Stivaletti"
                    src="https://via.placeholder.com/440x560?text=Img+01"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>2. Visible and eagerly loaded</p>
            <a href="#2"
            ><img
                    alt="Open toe"
                    src="https://via.placeholder.com/440x560?text=Img+02"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>3. Visible and lazily loaded</p>
            <a href="#3"
            ><img
                    alt="Sneakers &amp; Tennis"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+03"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>
                4. Hidden with <code>display: none</code> on the image
            </p>
            <a href="#4"
            ><img
                    alt="Sneakers &amp; Tennis shoes basse"
                    class="lazy dnone"
                    data-src="https://via.placeholder.com/440x560?text=Img+04"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>5. Hidden with <code>display: none</code> on the link</p>
            <a href="#5" class="dnone"
            ><img
                    alt="Sneakers &amp; Tennis shoes alte"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+05"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>
                6. Hidden with <code>visibility: hidden</code> on the
                image
            </p>
            <a href="#6"
            ><img
                    alt="Sneakers &amp; Tennis shoes alte"
                    class="lazy vhidden"
                    data-src="https://via.placeholder.com/440x560?text=Img+06"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>
                7. Hidden with <code>visibility: hidden</code> on the
                link
            </p>
            <a href="#7" class="vhidden"
            ><img
                    alt="Sneakers &amp; Tennis shoes basse"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+07"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>8. Hidden with <code>opacity: 0</code> on the image</p>
            <a href="#8"
            ><img
                    alt="Sneakers &amp; Tennis shoes basse"
                    class="lazy o0"
                    data-src="https://via.placeholder.com/440x560?text=Img+08"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>9. Hidden with <code>opacity: 0</code> on the link</p>
            <a href="#9" class="o0"
            ><img
                    alt="Stivali"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+09"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>10. Visible and lazily loaded, again</p>
            <a href="#10"
            ><img
                    alt="Stivali"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+10"
                    width="220"
                    height="280"
            /></a>
        </li>
        <li>
            <p>11. Visible and lazily loaded, again</p>
            <a href="#11"
            ><img
                    alt="Stivali"
                    class="lazy"
                    data-src="https://via.placeholder.com/440x560?text=Img+11"
                    width="220"
                    height="280"
            /></a>
        </li>
    </ul>
</div>
</div>
HTML,

     'js' =>  <<<JS
           (function() {
        function logElementEvent(eventName, element) {
            console.log(
                Date.now(),
                eventName,
                element.getAttribute("data-src")
            );
        }

        var callback_enter = function(element) {
            logElementEvent("🔑 ENTERED", element);
        };
        var callback_exit = function(element) {
            logElementEvent("🚪 EXITED", element);
        };
        var callback_reveal = function(element) {
            logElementEvent("👁️ REVEALED", element);
        };
        var callback_loaded = function(element) {
            logElementEvent("👍 LOADED", element);
        };
        var callback_error = function(element) {
            logElementEvent("💀 ERROR", element);
            element.src =
                "https://via.placeholder.com/440x560/?text=Error+Placeholder";
        };
        var callback_finish = function() {
            logElementEvent("✔️ FINISHED", document.documentElement);
        };

        var ll = new LazyLoad({
            container: document,// ex: document.querySelector('.scrollPanel'),
            elements_selector: ".lazy", // ex: ".images img.lazy"
            threshold: 0, // default val: 300
            thresholds: null, // "500px 10%"
            data_src: "src", // "lazy-src"
            data_srcset: "srcset", // "lazy-srcset"
            data_sizes: "sizes", // "lazy-sizes"
            data_bg: "bg", // "lazy-bg"
            data_poster: "poster", // "lazy-poster"
            class_loading: "loading", // ex: "lazy-loading"
            class_loaded: "loaded", // ex: "lazy-loaded"
            class_error: "error",  // ex: "lazy-error"
            load_delay: 0,  // ex: 300
            auto_unobserve: true, // ex: false
            callback_set: null, // ex: (el)=>{console.log("Loading", el)}    
            use_native: false, // ex: true
            // Assign the callbacks defined above
            callback_enter: callback_enter,
            callback_exit: callback_exit,
            callback_reveal: callback_reveal,
            callback_loaded: callback_loaded,
            callback_error: callback_error,
            callback_finish: callback_finish
        });
    })();
JS,

    ];


    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

            $this->htm = $this->_layout['htm'];
            $this->js = $this->_layout['js'];


    }

}
