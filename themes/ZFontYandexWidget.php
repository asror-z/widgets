<?php

namespace zetsoft\widgets\themes;

use zetsoft\system\kernels\ZWidget;


/**
 *
 * Fonts Yandex Markent and Sibirix Markent
 *
 * Created By: Jasur Shukurov
 *
 */
class ZFontYandexWidget extends ZWidget
{


    public $config = [];
    public $_config = [
        'fonts' => ZFontYandexWidget::fonts['sibirix'],
        //'font-family' => 'Yandex Sans Text',
        //'font-weight'=> 900,
        //'font-style'=> 'normal'
    ];

    public const fonts = [
        'yandex' => 'yandex/stylesheet',
        'sibirix' => 'sibirix/stylesheet_01'
    ];

    public function asset()
    {
        $this->fileCss('/render/theme/ZFontYandexWidget/assets/fonts/' .$fonts = $this->_config['fonts'] . '.css');
       /*$this->fileCss('/render/theme/ZFontYandexWidget/assets/fonts/yandex/' .$fonts = $this->_config['fonts'] . '.css');*/
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
                 
HTML,
    ];


    public function codes()
    {
        $this->htm .= strtr($this->_layout['main'], []);

    }
}
