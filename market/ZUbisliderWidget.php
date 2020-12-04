<?php
/*
 * Created By: Shahzod Gulomqodirov
 * */

namespace zetsoft\widgets\market;

use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZWidget;

class ZUbisliderWidget extends ZWidget
{

    public $data = [
        'https://s1.1zoom.me/big0/683/301601-alexfas01.jpg',
        'https://s1.1zoom.ru/big0/104/419263-Kycb.jpg',
        'https://www.nicepng.com/png/full/786-7869941_800-x-1021-1-assassin-and-archer-dragon.png',
        'https://www.noao.edu/image_gallery/images/d5/dumba.jpg',
        'https://i2.wp.com/7sisters.ru/wp-content/uploads/2018/10/p054k8mk.jpg?resize=800%2C400',
        'https://spp.com.au/wp-content/uploads/2017/08/Heliograph-image-400x400.png',
        'https://pictureofday.files.wordpress.com/2009/01/nasar3107_1000x1000.jpg',
    ];

    public $config = [];
    public $_config = [

    ];

    /*
     * Events
     * */
    public $event = [];
    public $_event = [

    ];

    /*
     * Layouts
     * */
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML

            <div class="clearfix">
                <div class="ubislider-image-container" data-ubislider="#slider4" id="imageSlider4" data-image="0"><img src="{mainfoto}"></div>
                <div id="slider4" class="ubislider ecommerce" data-slidetime="0">
                    <a class="arrow prev" style="display: none;"></a>
                    <a class="arrow next pasive" style="display: none;"></a>
                    <ul id="gal1" class="ubislider-inner" style="width: 516px;">
                          {fotos}
                    </ul>
                </div>
            </div>
            <div class="zoomContainer" style="transform: translateZ(0px); position: absolute; left: 60.75px; top: 1373px; height: 326px; width: 245px;"><div class="zoomLens" style="background-position: 0px 0px; float: right; overflow: hidden; z-index: 999; transform: translateZ(0px); opacity: 0.4; zoom: 1; width: 163.333px; height: 163px; background-color: white; cursor: default; border: 1px solid rgb(0, 0, 0); background-repeat: no-repeat; position: absolute; left: 82px; top: 77.5px; display: none;">&nbsp;</div><div class="zoomWindowContainer" style="width: 400px;"><div style="overflow: hidden; background-position: -208px -191.73px; text-align: center; background-color: rgb(255, 255, 255); width: 400px; height: 400px; float: left; background-size: 600px 800px; z-index: 100; border: 4px solid rgb(136, 136, 136); background-repeat: no-repeat; position: absolute; background-image: url(&quot;{mainfoto}&quot;); top: 0px; left: 245px; display: none;" class="zoomWindow">&nbsp;</div></div></div>
HTML,

        'js' => <<<JS
           $('#slider4').ubislider({
        arrowsToggle: true,
        type: 'ecommerce',
        hideArrows: true,
        autoSlideOnLastClick: true,
        modalOnClick: true,
        onTopImageChange: function () {
            $('#imageSlider4 img').elevateZoom();
        }
    });
JS,

        'item' => <<<HTML
          <li>
                <a>
                    <img src="{item}">
                </a>
          </li>
HTML,


    ];


    public function asset()
    {
        $this->fileCss('/render/market/ZUbisliderWidget/asset/ubislider.css');
        $this->fileJs('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js');
        $this->fileJs('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');
        $this->fileJs('/render/market/ZUbisliderWidget/asset/ubislider.js');
        $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js');
    }

    public function codes()
    {
        $fotos = '';
        foreach ($this->data as $val) {
            $fotos .= strtr($this->_layout['item'], [
                '{item}' => $val
            ]);
        }

        $this->htm .= strtr($this->_layout['main'], [
            '{mainfoto}' => ZArrayHelper::getValue($this->data, 0),
            '{fotos}' => $fotos,
        ]);
        $this->js .= strtr($this->_layout['js'], []);
    }
}
