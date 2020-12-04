<?php

/**
 *
 *
 * Author:  Shahzod Gulomqodirov
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZCompareTableWidget extends ZWidget
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
      <div class="comparison-table d-flex">
        <table class="table table-bordered" >
            <thead class="bg-light">
            <tr>
                <td class="align-middle w-25">
                    <select id="compare-criteria" class="browser-default custom-select">
                        <option value="all">Comparison criteria *</option>
                        <option value="summary">Summary</option>
                        <option value="general">General</option>
                        <option value="multimedia">Multimedia</option>
                        <option value="performance">Performance</option>
                        <option value="design">Design</option>
                        <option value="display">Display</option>
                        <option value="storage">Storage</option>
                        <option value="camera">Camera</option>
                        <option value="battery">Battery</option>
                        <option value="price">Price &amp; rating</option>
                    </select>
                    <select id="compare-criteria" class="browser-default custom-select mt-2">
                        <option value="all">Comparison criteria *</option>
                        <option value="summary">Summary</option>
                        <option value="general">General</option>
                        <option value="multimedia">Multimedia</option>
                        <option value="performance">Performance</option>
                        <option value="design">Design</option>
                        <option value="display">Display</option>
                        <option value="storage">Storage</option>
                        <option value="camera">Camera</option>
                        <option value="battery">Battery</option>
                        <option value="price">Price &amp; rating</option>
                    </select>
                    <div class="pt-3">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="differences">
                            <label class="custom-control-label" for="differences">Show differences only</label>
                        </div>
                    </div>
                </td>
                
            </tr>
            </thead>
            <tbody id="summary">
            <tr class="bg-secondary">
                <th class="text-uppercase">Summary</th>
                
                
            </tr>
            <tr>
                <th>Performance</th>
                
            </tr>
            <tr>
                <th>Display</th>
               
            </tr>
            <tr>
                <th>Storage</th>
            </tr>
            <tr>
                <th>Camera</th>
               
            </tr>
            <tr>
                <th>Battery</th>
            </tr>
           
        </table>
        <table class="table table-bordered">
            <thead class="bg-light">
            <tr>

                <td>
                    <div class="comparison-item d-flex flex-column">
                        <div class="d-flex justify-content-center">
                            <a class="comparison-item-thumb" href="shop-single.html"><img src="https://via.placeholder.com/160x160/FF0000/000000" alt="Apple iPhone Xs Max"></a>
                            <span class="remove-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                        </div>
                        <a class="comparison-item-title text-center" href="shop-single.html">Apple iPhone Xs Max</a>
                        <button class="btn btn-pill btn-outline-primary btn-sm" type="button" data-toggle="toast" data-target="#cart-toast">Add to Cart</button>
                    </div>
                </td>
                
            </tr>
            </thead>
            <tbody id="summary">
            <tr class="bg-secondary">

                <td><span class="text-dark font-weight-semibold">Apple iPhone Xs Max</span></td>
                
            </tr>
            <tr>

                <td>Hexa Core</td>
                
            </tr>
            <tr>

                <td>6.5-inch</td>
               
            </tr>
            <tr>

                <td>64 GB</td>
            </tr>
            <tr>

                <td>Dual 12-megapixel</td>
               
            </tr>
            <tr>

                <td>3,174 mAh</td>
            </tr>
           
        </table>
    </div>
</div>
          
HTML,

        'tr' => <<<HTML
            <tr>
                <td></td>
</tr>
HTML,


        'js' => <<<JS
            $(function(){
        $('#compare-criteria').on("change", function() {
            var t = $(this).find("option:selected").val().toLowerCase();

            $('#summary').css("display", "none");
            $('#general').css("display", "none");
            $('#multimedia').css("display", "none");
            $('#performance').css("display", "none");
            $('#design').css("display", "none");
            $('#display').css("display", "none");
            $('#storage').css("display", "none");
            $('#camera').css("display", "none");
            $('#battery').css("display", "none");
            $('#price').css("display", "none");

            $("#" + t).css("display", "table-row-group");
            if(t == "all") {
                $('#summary').css("display", "table-row-group");
                $('#general').css("display", "table-row-group");
                $('#multimedia').css("display", "table-row-group");
                $('#performance').css("display", "table-row-group");
                $('#design').css("display", "table-row-group");
                $('#display').css("display", "table-row-group");
                $('#storage').css("display", "table-row-group");
                $('#camera').css("display", "table-row-group");
                $('#battery').css("display", "table-row-group");
                $('#price').css("display", "table-row-group");
            }
            $(this).css("display", "block");
        });
    })
JS,

        'item' => <<<Js
              
Js,


    ];

 public function asset()
    {

    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [

        ]);

        $this->js .= strtr($this->_layout['js'], [

        ]);
    }

}

