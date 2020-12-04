<?php

/**
 *
 *
 * Author:Abdumalikov Otabek
 * Refactored BY Xakimjon Ergashov
 * http://library.zettest.uz/render/Actions/Filtering/CSSJS/Archakov06%20Jquery-Easysearch/clean.htm
 * https://github.com/Archakov06/jQuery-easySearch
 *
 */

namespace zetsoft\widgets\actions;


use zetsoft\system\kernels\ZWidget;

class ZJqueryEasysearchWidget extends ZWidget
{

    public $config = [];
    public $_config = [
        'minValLength' => 0,
    ];

     public $layout = [];
     public $_layout = [
         'csscode' => <<<CSS
           .container {
        width: 50%;
        margin: 150px auto;
    }
    ul{
        list-style: none;
    }
    .column {
        margin-bottom: 20px;
    }
    div.input {
        width: 100%;
    }
    li:before {display: none;}
    ul.ui.list {margin-left: 0}
CSS,
    'main' => <<<HTML
         <div class="ui container">
    <div class="column">
        <div class="ui input focus"><INPUT type="text" placeholder="Search..." value="">
        </div></div>
    <div class="column">
        <ul class="ui middle aligned selection list">
            {data}
        </ul>
    </div>
</div>
HTML,
    'jscode' => <<<JS
        $(document).ready(function (){
        $('input').jSearch({
            selector  : 'ul.ui',
            child : 'li div.header',
            minValLength: {minValLength},
            Found : function(elem, event){
                $(elem).parent().parent().show();
            },
            NotFound : function(elem, event){
                $(elem).parent().parent().hide();
            },
            After : function(t){
                if (!t.val().length) $('ul li').show();
            }
        });
    });
JS,




     ];

    public function asset()
    {
          /*
           * <script src="https://cdn.statically.io/gh/Archakov06/jQuery-easySearch/master/jquery.easysearch.js"></script>
           */
           $this->fileJs('https://cdn.statically.io/gh/Archakov06/jQuery-easySearch/master/jquery.easysearch.js');
    }

    private function gen(){
        $code = '';
        foreach ($this->data as $key => $value){
             $code .= <<<HTML
<li class="item"><img class="ui avatar image" src="">
                <div class="content">
                    <div class="header">{$value}</div></div></li>
            <li class="item"><img class="ui avatar image" src="">
HTML;

        }

        return $code;
    }

    public function codes()
    {
          $this->htm = strtr($this->_layout['main'], [
                '{data}' => $this->gen(),
          ]);

          $this->js = strtr($this->_layout['jscode'],[
               '{minValLength}' => $this->_config['minValLength']
          ]);

          $this->css = $this->_layout['csscode'];


    }
}
