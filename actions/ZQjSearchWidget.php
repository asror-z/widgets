<?php

namespace zetsoft\widgets\actions;

use zetsoft\system\kernels\ZWidget;

/**
 *
 * Class ZKSelect2Widget
 * http://demos.krajee.com/widget-details/select2
 *
 * Created By: SherzodMangliyev
 * Refactored: 
 */
class ZQjSearchWidget extends ZWidget
{

  /**
   * Configuration
   */
  public $config = [];
  public $_config = [
      'grapes' => true,
  ];

  public const type = [
      
  ];

  /**
   *
   * Plugin Events
   * https://select2.org/programmatic-control/events
   */
  public $event = [];
  public $_event = [

  ];

  public $layout = [];
  public $_layout = [

      'main' => <<<HTML

    <div class="main"  '>
    <h2>Search on block's</h2>
    <div class="w100">
    <input type="text" id="search_field" placeholder="city" data-qjs="#cities .city_block" data-qjs-0="#emptyresult" data-qjs-1="#resultcountry" data-qjs-res="#qjlenres" autofocus="" />
    </div>
    <div class="w100" id="cities">
        <div id="emptyresult" class="eres dn">Results not found.</div>
        <div id="resultcountry" class="sres">Results: <span id="qjlenres"></span></div>
        <div class="city_block" data-cnt="USA">New York</div>
        <div class="city_block" data-cnt="Great Britain">London</div>
        <div class="city_block" data-cnt="Russian">Moscow</div>
        <div class="city_block" data-cnt="Thailand">Bangkok</div>
        <div class="city_block" data-cnt="Japan">Tokyo</div>
        <div class="city_block" data-cnt="Ukraine">Kiev</div>
        <div class="city_block" data-cnt="Uzbekistan">Tashkent</div>
      
    </div>
</div>

<hr>

<div class="main">
    <h2>Search on table</h2>
    <div class="w100"><input type="text" id="search_field2" placeholder="city" data-qjs=".table tbody tr" autofocus="" /></div>
    <table class="table">
        <thead>
        <tr><td>ID</td><td>Name</td><td>Country</td></tr>
        </thead>
        <tbody>
        <tr><td>1</td><td>New York</td><td>USA</td></tr>
        <tr><td>2</td><td>London</td><td>Great Britain</td></tr>
        <tr><td>3</td><td>Moscow</td><td>Russia</td></tr>
        <tr><td>4</td><td>Bagkok</td><td>Thailand</td></tr>
        <tr><td>5</td><td>Tokyo</td><td>Japan</td></tr>
        <tr><td>6</td><td>Kiev</td><td>Ukraine</td></tr>
        <tr><td>7</td><td>Tashkent</td><td>Uzbekistan</td></tr>
        <tr><td>8</td><td>Samarkand</td><td>Uzbekistan</td></tr>
        <tr><td>9</td><td>Bukhara</td><td>Uzbekistan</td></tr>

        </tbody>
    </table>
</div>

HTML,
      'js' => <<<JS
        $("#search_field").qjsearch();
        $("#search_field2").qjsearch();
JS,
      'css' => <<<CSS
       .w100 {
            display:block;
            width:100%;
        }
        .dn {
            display:none;
        }
        .eres {
            color:#f00;
            padding:5px;
        }
        .sres {
            color:#168c00;
            padding:5px;
        }
        .city_block {
            padding:5px;
            border:1px solid #ccc;
            margin:5px;
            display:inline-block;
        }

        
CSS,
  ];


  public function asset()
  {

    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js');
    $this->fileJs('https://cdn.statically.io/gh/yumadilowadim/QjSearch/test/qjsearch.min.js');


  }


  public function codes()
  {

    $this->htm .= strtr($this->_layout['main'], [
        
        '{readonly}' => $this->_config['readonly'] ? 'readonly' : ''

    ]);

    $this->js = strtr($this->_layout['js'], []);
    $this->css = strtr($this->_layout['css'], []);


  }

}
