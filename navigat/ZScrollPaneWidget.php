<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\navigat;


use zetsoft\system\kernels\ZWidget;

class ZScrollPaneWidget extends ZWidget
{
    public $config = [];
    public $_config = [
        'content' => 'dskjfhsdkjfhsdmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh dmfnbsdmnbsduh dcbjsghdcbm sddjcfhsd uichsdcmndcuisdhcmnbsduhcsdjkcbh ',
        'grapes' => true,

    ];

    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div style="width: 30%;"  '><span class="" {readonly}>
        <div class="scroll-pane">
            <div id="forms">
                <form>
                    <h1>
                       {content}
                    </h1>
                </form>
            </div>
        </div>
    </div>
HTML,

        'js' => <<<JS
    $( document ).ready(function() {
        $(function(){
            var pane = $('.scroll-pane');
            pane.jScrollPane({
                    showArrows: true,
                    animateScroll: true
                }
            );
            var api = pane.data('jsp');
        
            $('#but-scroll-to').bind(
                'click',
                function(){
                    api.scrollTo(parseInt($('#toX').val()), parseInt($('#toY').val()));
                    return false;
                }
            );
        
            $('#but-scroll-by').bind(
                'click',
                function(){
                    api.scrollBy(parseInt($('#byX').val()), parseInt($('#byY').val()));
                    return false;
                }
            );
    });
});
JS,

    ];

    public function asset()
    {
      /*  $this->fileCss("/publish/yarner/jscrollpane/style/jquery.jscrollpane.css");
        $this->fileJs('/publish/yarner/jscrollpane/script/jquery.mousewheel.js');
        $this->fileJs('/publish/yarner/jscrollpane/script/jquery.jscrollpane.min.js');    */

        $this->fileCss("https://cdn.jsdelivr.net/npm/jscrollpane@2.2.1/style/jquery.jscrollpane.css");
        $this->fileJs('https://cdn.jsdelivr.net/npm/jscrollpane@2.2.1/script/jquery.mousewheel.js');
        $this->fileJs('https://cdn.jsdelivr.net/npm/jscrollpane@2.2.1/script/jquery.jscrollpane.min.js');
    }



    public function codes()
    {




        $this->htm = strtr($this->_layout['main'], [
            '{content}' => $this->_config['content'],
            
            '{readonly}' => $this->_config['readonly'] ? 'readonly' : '',
        ]);

        $this->js = $this ->_layout['js'] ;
        $this->css = <<<Css
    .scroll-pane{
	width: 100% !important;
	height: 200px;
	overflow: auto;
}

    div#forms{
	overflow: hidden;
	
}

    form{
	float: left;
	width: 100%;
	padding: 0 0 1em;
}
    .jspContainer{
        width: 100% !important;
    }
    .jspPane{
    width: 100% !important;
  
    }
Css;
    }
}
