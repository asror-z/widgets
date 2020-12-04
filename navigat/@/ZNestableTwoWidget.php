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

class ZNestableTwoWidget extends ZWidget
{
    public $config = [];
    public $_config = [

    ];


    public $layout = [];
    public $_layout = [
        'item' => <<<HTML

HTML,
'css'=><<<CSS

CSS,
'js'=><<<JS

JS,


    ];

  /*  public function jscode($value)
    {
    }*/

    public function asset()
    {
        parent::asset();
        $this->fileCss('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css
');


        $this->fileJs('https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js
');
    }

    public function codes()
    {
        /*$this->htm = <<<HTML

HTML;  */

    }

}
