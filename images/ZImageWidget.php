<?php
/*
 * Author: DIlshodjon Olimov
 * Date: 23.05.2020
 * 
 */

namespace zetsoft\widgets\images;


use zetsoft\system\kernels\ZWidget;


class ZImageWidget extends ZWidget
{


    /**
     * Configuration
     */

    public $config = [];
    public $_config = [
          'url' => '',
          'class' => '',
          'width' => '',
          'height' => '',
          'style' => '',
    ];





    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
      <img src="{url}"  class="{class} hoverable-img marketImg" style="{style}">
HTML,

        'css' => <<<CSS
.marketImg{
width: {width};
height: {height};
}
CSS,

    ];

    public function codes()
    {
        $value =  $this->_config['url'];
        if (!empty($this->value))
            $value = $this->value;

        $this->htm = strtr($this->_layout['main'], [
             '{url}' => $value,
             '{class}' => $this->_config['class'],
             '{style}' => $this->_config['style']
        ]);

        $this->css = strtr($this->_layout['css'],[
           '{width}' => $this->_config['width'],
           '{height}' => $this->_config['height'],
        ]);
        

    }

}
