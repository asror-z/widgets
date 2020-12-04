<?php
/**
 *
 *
 * Author:  Jasur Sh.
 *
 */

namespace zetsoft\widgets\ajaxify;


use phpDocumentor\Reflection\Type;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\actions\crud\ZIndexAjaxAction;
use zetsoft\system\Az;
use zetsoft\system\helpers\Zicon;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZKStarRatingOnlyWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZIconCardWidget;
use zetsoft\widgets\market\ZSingleProductWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


class ZInfinityScrollAjaxWidget_1 extends ZWidget
{

    /**
     * Configuration
     */
    public $config = [];
    public $_config = [
        'appendTo' => 'appendTo',
        'item' => null,
        'pageAttribute' => 'page',
        'limitAttribute' => 'limit',
        'url' => '',
        'limit'=> 3,
        'requireUrl'=>'/render/cards/ZListViewWidget/demo/vertical_horizontal.php',
        'defaultItem'=>'item',
        'grid'=>'row',
        'cols'=>3,
        'items'=>[],
        'type'=> 'type',
        'step'=>0,
    ];


    public $event = [];
    public $_event = [
    ];

    public const type=[
        'type'=>'type',
        'ajax'=>'ajax'
    ];
    public $layout = [];
    public $_layout = [

        'main' => <<<HTML
    <div class="{appendTo} {grid}">
         {content}
    </div>
    
    <div class="d-flex justify-content-center" >
        {loader}
    </div>
        
    <div class="row" style="display: none" id="no_content">
        <div class="col-md-4 offset-md-4  text-dark text-center">
             <h4 class="border-primary  p-3">
                {no-content}
            </h4>
        </div>
    </div>
HTML,

        'js' => <<<JS
let page = 0;
let loader = $('#loader_infinity');
let no_content_text = $('#no_content');
let isSend = false;
loader.hide()

$(document).ready(function () {
        if ('{type}'==='ajax'){
            if (page===0){
                $.ajax({
                    url: '{url}',
                    method: 'POST',
                    data: {
                        'page':page,
                        'limit':'{limit}',
                        'requireUrl':'{requireUrl}',
                        'itemAttribute':'{itemAttribute}',
                    },
                    beforeSend: function (data) {
                        loader.show();
                    },
                    success: function (data) {
                    
                        page ++;
                        loader.hide();
                        if (!data){
                            no_content_text.show();
                        }else{
                            $('.{appendTo}').append(data);
                        }
                        
                console.log($('body').height())
                        checkTabs()
                    },
                    error: function () {
                        console.log('error')
                    }
                })
                
        }
            $('body').scroll(function() {
            
            console.log($('body').scrollTop(),$('body').height(),$(document).height(), $('body').scrollTop()+$('body').height())
        
            if($('body').scrollTop()+$('body').height() >= $(document).height()) {
                $.ajax({
                    url: '{url}',
                    method: 'POST',
                    data: {
                        'page':page,
                        'limit':'{limit}',
                        'requireUrl':'{requireUrl}',
                        'itemAttribute':'{itemAttribute}',
                    },
                    beforeSend: function (data) {
                        loader.show();
                    },
                    success: function (data) {
                        console.log(data)
                        page ++;
                        loader.hide();
                        if (!data){
                            no_content_text.show();
                        }else{
                            $('.{appendTo}').append(data);
                        }
                        checkTabs()
                    },
                    error: function () {
                        console.log('error')
                    }
                })
            }
        });
        }else{
           $('.{appendTo}').append('{items}');
           console.log('{items}')
        }
    })
JS,

    ];


    public function asset()
    {
    }


    public function codes()
    {

        //vdd($this->_config['items']);

        $code='';

        $step=$this->_config['step'];

        $size = $this->_config['limit'];

        if ($this->_config['type']==="ajax"){
            $code = $this->require( $this->_config['requireUrl'], [
                'item' => $this->_config['item'],
                'col'=> $this->_config['cols']

            ]);
        }else{

            for ($i=$step;$i<$step+$size;$i++){
                
                $code .= $this->require( $this->_config['requireUrl'],[
                        'item'=>$this->_config['items'][$i]
                    ]
                );

            }
            $this->_config['step']=$step+$size;
        }


        $this->htm = strtr($this->_layout['main'], [
            '{appendTo}' => $this->_config['appendTo'],
            '{grid}'=>$this->_config['grid'],
            '{loader}'=>$this->require('/render/market/ZCategoryCardWidget/demo/clean_loader_3.php'),
            '{content}'=> !$this->_config['type']==='ajax'?$code:'',
            '{no-content}'=>Az::l('Нет контента'),
        ]);

        $this->js = strtr($this->_layout['js'], [
                '{appendTo}' => $this->_config['appendTo'],
                '{item}' => $code,
                '{url}'=>$this->_config['url'],
                '{pageAttribute}'=>$this->_config['pageAttribute'],
                '{limitAttribute}'=>$this->_config['limitAttribute'],
                '{limit}'=>$this->_config['limit'],
                '{requireUrl}'=>$this->_config['requireUrl'],
                '{items}'=>$code
            ]);

    }

}

