<?php

/**
 *
 *
 * Author:  Abdurakhmonov Umid
 *
 * ModifyedBy:  Abl / Javohir
 *
 */

namespace zetsoft\widgets\inputes;

use zetsoft\system\kernels\ZWidget;


class ZHorizontalTouchSpinWidget extends ZWidget
{
    public $config = [];
    public $_config = [
         'amount' => 0,
         'locked'=> false,
          'id'=> null
    ];

    public $event = [];
    public $_event = [
        'change' => ' console.log("ZKTouchSpinWidget | $eventChange")',
        'startspin' => ' console.log("ZKTouchSpinWidget | $eventStartspin")',
        'startupspin' => ' console.log("ZKTouchSpinWidget | $eventStartupspin")',
        'startdownspin' => ' console.log("ZKTouchSpinWidget | $eventStartdownspin")',
        'stopspin' => ' console.log("ZKTouchSpinWidget | $eventStopspin")',
        'stopupspin' => ' console.log("ZKTouchSpinWidget | $eventStopupspin")',
        'stopdownspin' => ' console.log("ZKTouchSpinWidget | $eventStopdownspin")',
        'min' => ' console.log("ZKTouchSpinWidget | $eventMin")',
        'max' => ' console.log("ZKTouchSpinWidget | $eventMax")',
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
<div class="text-center d-flex flex-column justify-content-center align-items-center">
        <div class="counts-up-{id}{lock}" role="button">
            <i class="fas fa-sort-up  fr-13 text-muted"></i>
        </div>
        
            <div class="">
                <input type="text" value="{amount}" id="id{id}" class="w-75 border-0 text-center count-{id} cartsvalue" {lock}>
                <input type="hidden" value="{value}" name="{name}" id="hidden-{id}{lock}">
            </div>
            
        <div class="counts-down-{id}{lock}" role="button">
            <i class="fas fa-sort-down fr-13 text-muted"></i>
        </div>
</div>
HTML,
        'js' =><<<JS
        var check = true; 
            $('.counts-up-{id} ').on("click",function () {
                if (check){
                    check = false;
                   
                    
                     $.ajax({
                        method: 'GET',
                        url: '/core/product/addVote.aspx',
                        data: { id:{id}},
                        success: function (data) {
                           check = true; 
                            console.log(data);
                            if (data !=='done'){
                            var main = $('#id{id}');
                            var hidden = $('#hidden-{id}');
                            var value = $('#id{id}').val();
                            var valInt = parseInt(value);
                            value++;
                            value = String(value);
                            main.val(value);
                            hidden.val(value);
                            }
                        }
                    });
                }
            });
        $('.counts-down-{id} ').on("click",function () {
            if (check){
                check = false;
               
                
                 $.ajax({
                    method: 'GET',
                    url: '/core/product/disVote.aspx',
                    data: { id:{id}},
                    success: function (data) {
                        check = true;
                        console.log(data);
                        if (data !=='done'){
                         var main = $('.count-{id}');
                         var value = $('.count-{id}').val();
                         var hidden = $('#id{id}');
                         var valInt = parseInt(value);
                         if (value>0) value--;
                         else value = 0;
                         value = String(value);
                         main.val(value);
                         hidden.val(value); 
                        }
                    }
                });
            }
    });
    
   
JS,

    'css' => <<<CSS
        .counts-up-{id} {
         cursor: pointer;
        }
        
        .counts-down-{id} {
         cursor: pointer;
        }
CSS,

    ];

    public function asset()
    {
       
    }

    public function codes() {
        $lock='';
        $id = $this->_config['id'];
        if($id===null)
            $id = $this->id;

        if($this->_config['locked'])
            $lock= 'readonly';
        $this->htm = strtr($this->_layout['main'], [
           '{id}' => $id,
           '{name}'=> $this->name,
           '{value}' => $this->value,
           '{amount}' => $this->_config['amount'],
           '{lock}' => $lock,
        ]);

        $this->js = strtr($this->_layout['js'], [
           '{id}' => $this->_config['id'],
        ]);

        $this->css = strtr($this->_layout['css'], [
            '{id}' => $this->_config['id'],
        ]);
    }
}
