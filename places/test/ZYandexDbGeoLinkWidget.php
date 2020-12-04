<?php


namespace zetsoft\widgets\places;


use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\places\ZYandexDbWidget;
/**
 * create by Khojiakbar Kodirov
 */

class ZYandexDbGeoLinkWidget extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
       'geolinks'=>[
            [
                'id'=>'',
                'span'=>'Moscow, Lva Tolstogo Street, 16',
                'data-type'=>'',
                'text'=>'is the address of our office.',
                'data-bounds'=>'',
            ],
            [
                'id'=>'whiteText',
                'span'=>'Cafes',
                'data-type'=>'biz',
                'text'=>'near our office.',
                'data-bounds'=>'[55.73333783240489,37.586741441564136],
        [55.73433517114847,37.59017466910319]'
            ],
            [
                'id'=>'',
                'span'=>'Lva Tolstogo, 18B',
                'data-type'=>'geo',
                'text'=>'If you are going to Yandex.Money, go to',
                'data-bounds'=>'[55.63333783240489,37.486741441564136],
        [55.75433517114847,37.69017466910319]',
            ],

       ]
    ];

    /**
     *
     * Constants
     */

    public $event = [];
    public $_event = [

    ];

    

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
       <div id="box">
        {content}
</div>

HTML,

        'js' => <<<JS
          
JS,

        'style' => <<<CSS
        #whiteText {
            background-color: #110;
            color: white;
            padding: 5px 0px 5px 8px;
        }

        #box {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 22px;
        }
         
CSS,

    ];


    public function asset()
    {
        $this->fileJs('https://api-maps.yandex.ru/2.1/?load=Geolink&lang=en_US&apikey=5fb7da25-bc18-4612-b304-83ea2266c510');

    }


    public function codes()
    {
        $content = '';
        foreach ($this->_config['geolinks'] as $geolink) {
            $id = $geolink['id'];
            $span=$geolink['span'];
            $dataType=$geolink['data-type'];
            $text=$geolink['text'];
            $dataBounds=$geolink['data-bounds'];

            $content .= "
                <p id='$id'>
                   <span class='ymaps-geolink' data-bounds='[$dataBounds]' data-type='$dataType'>$span</span> $text
                </p>         
            ";

        }

        $this->htm = strtr($this->_layout['main'], [
            '{content}'=>$content,
        ]);

        
        $this->css = strtr($this->_layout['style'], []);
    }
}
