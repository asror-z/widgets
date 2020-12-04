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

use phpDocumentor\Reflection\Types\Self_;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;

class ZReadMoreWidget2 extends ZWidget
{
    public $config = [];
    public $_config = [

        'color'=>self::colorType['grey'],
        'parentclass'=>'',
        'itemInSummary' => 0,
        'itemClass' => 'itemClass',
        'more' => 'Показать больше...',
        'les' => 'Показать меньше...',

        'content' => 'lorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdas lorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdaslorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdaslorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdaslorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdaslorasdasdasdlm a
        sdasdasdasdaasd asdasdasd asdas da sdas',
    ];

    public const colorType = [
        'grey' => '#b3b3b3',
        'pink' => '#e60026',
        'vpink' => '#d6bddf',
        'cgreen' => '#d595eb',
        'cPINK' => '#d595eb',
        'sgreen' => '#caea7e',
        'epink' => '#fec6c6',
        'dbrown' => '#fca10d',
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

        'Js' => <<<js
           
            
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
   
js,

        'css' =><<<CSS
               /*width yuz foiz turishi uchun*/
            .rmrl-read-less {
            font-weight: normal;
                margin-left: 3%;
                width: 100%;
                text-align: left;
                font-size: 1rem;
                display: block;
                
            }
        
        .rmrl-read-less > a, .rmrl-read-more > a{  
            
            color:{color}; /*#dee0e0*/
        
        }
        
            .rmrl-read-more{
            font-weight: normal;
               margin-left: 3%;
               width: 100%;
               text-align: left;
               font-size: 1rem;
               display: block;
               
                
            }
          
CSS


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
            '{readLessText}' => $less,
            '{id}'=>$this->id,
        ]);


       $this->css =strtr($this->_layout['css'],[
         '{color}'=>$this->_config['color'],
         
       ]);

        $this->htm =strtr($this->_layout['main'],[
           '{content}'=>$this->_config['content'],
           '{id}'=>$this->id,
        ]);

    }
}

