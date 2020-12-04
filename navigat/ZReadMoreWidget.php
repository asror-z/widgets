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

use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZReadMoreWidget extends ZWidget     
{
    public $config = [];
    public $_config = [
        'parentclass'=>'',
        'itemInSummary' => 0,
        'itemClass' => 'itemClass',
        'more' => 'Показать больше...',
        'les' => 'Показать меньше...',
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/mfarid/readmore-readless/master/js/jquery.readmore-readless.js');
    }

    public $layout = [];
    public $_layout = [
        'Js' => <<<JS
            if (($(".{parent}").length > 0)){
              $(".{parent}").each(function(index){ $(this).readMoreReadLess({
                    itemInSummary: '{itemInSummary}',
                    itemClass: '{itemClass}',
                    readMoreText:  '{readMoreText}',
                    readLessText: '{readLessText}',
                    readMoreClass: 'button',
                    readLessClass: 'button'
                });    
                console.log(index+'{parent}')
              });  }
   
JS,
];

    public function codes()
    {

        $more = Az::l($this->_config['more']);
        $less = Az::l($this->_config['les']);

        $more = str_replace("'", '', $more);
        $less = str_replace("'", '', $less);

        $this->js = strtr($this->_layout['Js'], [
            '{parent}' => $this->_config['parentclass'],
            '{itemInSummary}' => $this->_config['itemInSummary'],
            '{itemClass}' => $this -> _config['itemClass'],
            '{readMoreText}' => $more,
            '{readLessText}' => $less
        ]);

        $this->css = <<<CSS
            /*width yuz foiz turishi uchun*/
            .rmrl-read-less {
            font-weight: normal;
                margin-left: 3%;
                width: 100%;
                text-align: left;
                font-size: 1rem;
                display: block;                
            }

            .rmrl-read-more{
            font-weight: normal;
               margin-left: 3%;
               width: 100%;
               text-align: left;
               font-size: 1rem;
               display: block;
} 
           .rmrl-read-less > a, .rmrl-read-more > a{           
            color:#939699;       
        }           
CSS;
    }
}
