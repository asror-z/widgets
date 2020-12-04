<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZCompareTableWidget2 extends ZWidget
{
    /**
     * Configuration
     */
    public $config = [];
    public $_config = [


    ];



    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
    <div class="container pb-5 mb-2">
      <div class="comparison-table">
        <table class="table table-bordered">
        
          <thead class="bg-light">
            <tr>
                
                 <td class="align-middle w-25">
                
                    <select id="compare-criteria" class="browser-default custom-select">
                        <option value="all">{CategoryMobail}</option>
                    </select>
                    
                    <select id="compare-criteria" class="browser-default custom-select mt-2">
                        <option value="all">{CategoryKomputer}</option>
                    </select>
                    
                    <div class="pt-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="differences">
                            <label class="custom-control-label" for="differences">{Showdiffer}</label>
                        </div>
                    </div>
                    
                </td> 
                               
                <td>
                    <div class="comparison-item d-flex flex-column">
                        <div class="d-flex justify-content-center">
                            <a class="comparison-item-thumb" href="shop-single.html">
                             <img src="{images}" alt="{name}">
                            </a>
                            <span class="remove-item">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                           </span>
                         </div>
                        <a class="comparison-item-title text-center" href="shop-single.html">{name}</a>
                        <button class="btn btn-pill btn-outline-primary btn-sm" type="button" data-toggle="toast" data-target="#cart-toast">{AddCart}</button>
                    </div>
                </td>                
           </tr>
        </thead>
        
        <tbody id="summary">
        
            <tr class="bg-secondary">
                <th class="text-uppercase">{title}</th>
                <td><span class="text-dark font-weight-semibold">{name}</span></td>
            </tr>
            
            <tr>
                <th>Performance</th>
                <td>Hexa Core</td>
            </tr>
            
             <tr>
                <th></th>
                <td>
                    <button class="btn btn-outline-primary btn-block" type="button" data-toggle="toast" data-target="#cart-toast">{AddCart}</button>
                </td>
            </tr>
                        
        </tbody>
       
      </table>
    </div>
</div>
          
HTML,


        'js' => <<<JS
            $(function(){
          $('#compare-criteria').on("change", function() {
             var t = $(this).find("option:selected").val().toLowerCase();

                $('#summary').css("display", "none");
            
                $("#" + t).css("display", "table-row-group");
                
            if(t == "all") {
                $('#summary').css("display", "table-row-group");
             }
            $(this).css("display", "block");
        });
    })
JS,


    ];

 public function asset()
    {

    }

        public function codes()
     {
        $item = '';
        foreach ( $this->data as $value ) {
            $text ='';
            foreach ($value as $val) {
                $text .= strtr($this->_layout['text'], [
                    '{text}' => $val,
                ]);
            }

            $item .= strtr($this->_layout['item'], [
                '{item}' => $text,

            ]);
        }


        $this->htm = strtr($this->_layout['main'], [
            '{name}'=> $name,
            '{title}' => $title,
            '{CategoryMobail}' => $item,
            '{CategoryKomputer}' => $direction,
            '{Showdiffer}' => $study,
            '{images}' => $passedTraining,
            '{total}' => $total,
            '{AddCart}' => $AddCard,
        ],
        );
    }

}

