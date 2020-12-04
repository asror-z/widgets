<?php

namespace zetsoft\widgets\images;

use zetsoft\system\kernels\ZWidget;




class ZLazyImageWidget extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [

        'class'=>'lazy',
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
   <div align = "center">
<div id="results1" class="results">
    <ul>
        <li>
            <a href="#">
            <img alt="https://image.shutterstock.com/image-photo/mountains-during-sunset-beautiful-natural-260nw-407021107.jpg" width="640" height="480"/>
            </a>
        </li>
        <li>
            <a href="#">
            <img alt="Open toe" loading="eager" src="https://image.shutterstock.com/image-photo/mountains-during-sunset-beautiful-natural-260nw-407021107.jpg" width="640" height="480"/>
            </a>
        </li>
        <li>
            <a href="#">
                <img alt="Open toe" loading="eager" src="https://media.gettyimages.com/photos/wazir-khan-mosque-lahore-punjab-pakistan-picture-id637623678?s=612x612" width="640" height="480"/>
            </a>
        </li>
        <li>
            <a href="#">
                <img alt="Open toe" loading="eager" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTg2QGNzZQraiwoWraK-8RZYCbmwqEOQn9fLxzoLiSXw0443PNU&usqp=CAU" width="640" height="480"/>
            </a>
        </li>
    </ul>
</div>
</div>
HTML,
    'js' => <<<JS
    (function () {
        function logElementEvent(eventName, element) {
            console.log(Date.now(), eventName, element.getAttribute("data-src"));
        }

        var callback_enter = function (element) {
            logElementEvent("🔑 ENTERED", element);
        };
        var callback_exit = function (element) {
            logElementEvent("🚪 EXITED", element);
        };
        var callback_loading = function (element) {
            logElementEvent("⌚️ LOADING", element);
        };
        var callback_loaded = function (element) {
            logElementEvent("👍 LOADED", element);
        };
        var callback_error = function (element) {
            logElementEvent("💀 ERROR", element);
            element.src = "https://source.unsplash.com/random/440x560/?text=Error+Placeholder";
        };
        var callback_finish = function () {
            logElementEvent("✔️ FINISHED", document.documentElement);
        };

    })();
JS,
    'style'=><<<Css
    ul,
        li {
            list-style-type: none;
            margin: 8px;
            padding: 0;
        }
        img {
            display: block;
        }

        img {
            border: 0;
            width: 640px;
            height: 480px;
        }

        img:not([src]) {
            visibility: hidden;
        }

        .warning {
            padding: 1em;
            color: black;
            background: lightyellow;
            border-radius: 1em;
            border: 1px solid gray;
        }

        /* Fixes Firefox anomaly during image load */
        @-moz-document url-prefix() {
            img:-moz-loading {
                visibility: hidden;
            }
        }
Css,

];



    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.0.0/dist/lazyload.min.js');
    }

    public function codes()
    {
        //  $this->htm = \kartik\select2\Select2::widget($this->options);

        foreach ($this->data as $key => $src){



            $this->htm .= strtr($this->_layout['main'],[

                '{image}' => $src,

            ]);
        }
        $this->js = strtr($this->_layout['js'],[
            '{class}'=>$this->_config['class'],


        ]);
    }

}
