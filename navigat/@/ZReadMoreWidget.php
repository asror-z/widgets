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

class ZReadMoreWidget1 extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' => '',
        'begin' => false,
        'itemInSummary' => 'itemInSummary',
        'itemClass' => 'itemClass',
    ];


    public function asset()
    {
        $this->fileJs('https://cdn.statically.io/gh/mfarid/readmore-readless/master/js/jquery.readmore-readless.js');
    }

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
            <div id="{id}">
                {content}
            </div>
                       
HTML,

        'css' => <<<CSS

CSS,



        'Js' => <<<js
            if (($("#{id}").length > 0)){
                $("#{id}").readMoreReadLess({
                    itemInSummary: '{itemInSummary}',
                    itemClass: '{itemClass}',
                    readMoreText:  '{readMoreText}',
                    readLessText: '{readLessText}',
                    readMoreClass: 'button',
                    readLessClass: 'button'
                });      
             }
            
             $(document).on('pjax:end',function() {
                if (($("#{id}").length > 0)){
                    $("#{id}").readMoreReadLess({
                        itemInSummary: '{itemInSummary}',
                        itemClass: '{itemClass}',
                        readMoreText:  '{readMoreText}',
                        readLessText: '{readLessText}',
                        readMoreClass: 'button',
                        readLessClass: 'button'
                    });      
                } 
             })
             
            if (($(".{id}").length > 0)){
          /* $(".{id}").each(function(index){ $(this).readMoreReadLess({
                itemInSummary: '2',
                itemClass: 'optionCheckBoxes',
                readMoreText:  'Показать больше...',
                readLessText: 'Показать меньше...',
                readMoreClass: 'button',
                readLessClass: 'button'
            });    
            console.log(index)
            });  */}
   
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
            '{id}' => $this ->id,
            '{content}' => $this->_config['begin'] ? ob_get_clean() : $this->_config['content']
        ]);

        $this->css = strtr($this->_layout['css'], []);

        $more = Az::l('Показать больше...');
        $less = Az::l('Показать меньше...');

        $more = str_replace("'", '', $more);
        $less = str_replace("'", '', $less);

        $this->js = strtr($this->_layout['Js'], [
            '{id}' => $this->id,
            '{itemInSummary}' => $this->_config['itemInSummary'],
            '{itemClass}' => $this -> _config['itemClass'],
            '{readMoreText}' => $more,
            '{readLessText}' => $less
        ]);

    }


}

