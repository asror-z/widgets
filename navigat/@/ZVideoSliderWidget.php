<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZVideoSliderWidget extends ZWidget
{

    public $data = [

    ];

    public $config = [];
    public $_config = [

    ];

    public function asset()
    {
        $this->fileCss('');
        $this->fileJs('');
    }

    public function codes()
    {

        $this->htm = strtr(
            $this->_layout['item'], [
            '{item}' => $this->_config['cssClass'],

        ]);


        $this->css = strtr($this->_layout['css'], [

        ]);

        $this->js = strtr($this->_layout['js'], [
            '{pointer}' => $this->_config['pointer'],

        ]);


    }

}
