<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\bozor;


use zetsoft\system\kernels\ZWidget;

class ZCheckboxTableWidget extends ZWidget
{
    public $config = [];
    public $_config = [
    ];

    public $event = [];
    public $_event = [
    ];

    public $layout = [];
    public $_layout = [
        'main' => <<<HTML
             <table id="demo" class="table table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox"></th>
                  <th>Name</th>
                  <th>e-mail</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox"></td>
                  <td>hoge</td>
                  <td><button type="button" class="btn btn-outline-success">Success</button></td>
                </tr>
              </tbody>
            </table> 
HTML,

        'css' => <<<CSS
            
CSS,

        'js' => <<<JS
             $(document).ready(function(){
       $("table#demo").simpleCheckboxTable();
     });
JS,

    ];

    public function asset()
    {
        $this->fileJs('https://code.jquery.com/jquery-3.3.1.slim.min.js');
        $this->fileJs('https://cdn.statically.io/gh/toshiyukihina/jquery-simple-checkbox-table-rails/master/vendor/assets/javascripts/jquery.simple-checkbox-table.min.js');
    }

    public function codes()
    {
        $this->htm = strtr($this->_layout['main'], [
           
        ]);

        $this->js = $this->_layout['js'];
        $this->css = $this->_layout['css'];

    }


}
