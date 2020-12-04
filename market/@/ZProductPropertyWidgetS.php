<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\market;


use zetsoft\system\kernels\ZWidget;

class ZProductPropertyWidgetS extends ZWidget
{
     public $config = [];
     public $_config = [
        'header_color'=>'#10b410'
     ];

     public $data = [];

     public $layout = [];
     public $_layout = [
        'main' => <<<HTML
    <!--<table class="table table-striped table-hover">
            {cont}
     </table>-->
     <div class="p-4">
      {cont}
     </div>
     
HTML,

     ];


     /*private function item(){

         $code = '<table>';
         foreach ($this->data as $property){
             $code .= "<tr><td>{$property->name}</td>";
             foreach ($property->items as $item)
                 $code .= "<td>$item</td>";
             $code .= "<tr>";
         }
         $code .= "</table>";
         // vdd($code);



         return $code;
     } */


     public function codes()
     {
         $code = '';
         foreach ($this->data as $property){
             $code .= "<span class='text-black-50 fp-21'>{$property->name}: </span>";

             foreach ($property->items as $item)
                 $code .= "<span class='fp-20'>$item</span>";


             $code .= "<br>";
         }



         $this->htm = strtr($this->_layout['main'],[
            '{cont}' => $code
     ]);;
         /*$this->css = <<<CSS

table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	cursor: pointer;
}

table td {
    padding: 5px;
    font-size: 20px;
    font-weight: 300; 
    }
table td:hover {
    padding: 5px;
    font-size: 20px;
    font-weight: 300; 
    cursor: pointer;
    color: blue;
    }
    table tr{
        border-bottom: 1px solid #eee;
    }
table > tbody > tr > td:first-child {
    font-weight: bold;
    color: #0b71a6;
}
CSS;*/

     }
}
