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

class ZShowMoreWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'comment' => 'comment',
        'begin' => false
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.jsdelivr.net/npm/jquery.shorten@1.0.0/src/jquery.shorten.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div class="comment">
                {comment}
            </div>
                       
HTML,

        'css' => <<<CSS
        
CSS,


        'Js' => <<<js
        $(document).ready(function() {

            $(".comment").shorten();

            $(".comment-small").shorten({
                "showChars": "50",
                "moreText"	: "Читать далее",
                "lessText"	: "Меньше",
                "ellipsesText": ""
            });

    });
js,


    ];

    public function init()
    {
        parent::init();
        if ($this->_config['begin'])
            ob_start();
    }


    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
            '{comment}' => $this->_config['begin'] ? ob_get_clean() : $this->_config['comment']
        ]);

        $this->css = strtr($this->_layout['css'], []);

        $this->js = strtr($this->_layout['Js'], []);
    }


}

